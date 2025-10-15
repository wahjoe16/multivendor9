<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductAttribute;
use App\Models\ProductImage;
use App\Models\Section;
use App\Models\Vendor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    public function viewProducts()
    {
        // Logic to retrieve and display products
        $data = Product::with(['section', 'category', 'brand', 'vendor', 'admin'])->get();
        return view('admin.products.view_products', compact('data'));
    }

    public function createEditProduct(Request $request, $id = null)
    {
        if ($id == null) {
            // Logic for creating a new product
            $title = "Create New Product";
            $product = new Product;
            $message = "Product created successfully!";
        } else {
            // Logic for editing an existing product
            $title = "Edit Product";
            $product = Product::find($id);
            $message = "Product updated successfully!";
        }

        if ($request->isMethod('post')) {
            $data = $request->all();

            $this->validate($request, [
                'category_id' => 'required',
                'product_name' => 'required', "regex:/^([^\"!'\*\\]*)$/",
                'product_code' => 'required|regex:/^\w+$/',
                'product_price' => 'required|numeric',
                'product_color' => 'required|regex:/^[\pL\s\-]+$/u',
            ], [
                'category_id.required' => 'Category is required',
                'product_name.required' => 'Product name is required',
                'product_name.regex' => 'Valid product name is required',
                'product_code.required' => 'Product code is required',
                'product_code.regex' => 'Valid product code is required',
                'product_price.required' => 'Product price is required',
                'product_price.regex' => 'Valid product price is required',
                'product_color.required' => 'Product color is required',
                'product_color.regex' => 'Valid product color is required',
            ]);

            // upload product image
            if($request->hasFile('product_image')){
                $image_tmp = $request->file('product_image');
                if (!is_null($image_tmp)) {
                    File::delete(public_path('/images/product_images/' . $product['product_image']));
                    $imageName = 'product_' . date('Y-m-dHis') . '.' . $image_tmp->getClientOriginalExtension();
                    $path = public_path('/images/product_images/');
                    $image_tmp->move($path, $imageName);
                    $product['product_image'] = $imageName;
                } elseif (!empty($data['current_product_image'])) {
                    $imageName = $data['current_product_image'];
                } else {
                    $imageName = "";
                }
            }
            
            // upload product video
            if ($request->hasFile('product_video')) {
                $video_tmp = $request->file('product_video');
                if (!is_null($video_tmp)) {
                    File::delete(public_path('/videos/product_videos/' . $product['product_video']));
                    $videoName = 'product_' . date('Y-m-dHis') . '.' . $video_tmp->getClientOriginalExtension();
                    $path = public_path('/videos/product_videos/');
                    $video_tmp->move($path, $videoName);
                    $product['product_video'] = $videoName;
                } elseif (!empty($data['current_video_image'])) {
                    $videoName = $data['current_video_image'];
                } else {
                    $videoName = "";
                }
            }

            // declare user product
            $adminType = Auth::guard('admin')->user()->type;
            $vendorId = Auth::guard('admin')->user()->vendor_id;
            $adminId = Auth::guard('admin')->user()->id;

            // Validate and save product data
            $catDetails = Category::find($data['category_id']);

            $product->section_id = $catDetails['section_id'];
            $product->category_id = $data['category_id'];
            $product->brand_id = $data['brand_id'];
            $product->vendor_id = $vendorId;
            $product->admin_type = $adminType;
            $product->product_name = $data['product_name'];
            $product->product_code = $data['product_code'];
            $product->product_price = $data['product_price'];
            $product->product_color = $data['product_color'];
            $product->product_discount = $data['product_discount'];
            $product->product_weight = $data['product_weight'];
            $product->description = $data['description'];
            $product->meta_title = $data['meta_title'];
            $product->meta_keywords = $data['meta_keywords'];
            $product->meta_description = $data['meta_description'];

            if (!empty($data['is_featured'])) {
                $product->is_featured = $data['is_featured'];
            } else {
                $product->is_featured = "No";
            }

            $product->status = 1;
            // Add other fields as necessary
            $product->save();

            return redirect()->route('products.view')->with('success_message', $message);
        }

        $categories = Section::with('categories')->get()->toArray();
        $brands = Brand::where('status', 1)->get()->toArray();

        return view('admin.products.create_edit_product', compact('title', 'product', 'categories', 'brands'));
    }

    public function addAttributesProduct(Request $request, $id)
    {
        $product = Product::select(
            'id', 'product_name', 'product_code', 'product_color',
            'product_price', 'product_image'
        )->with('attributes')->find($id);

        if ($request->isMethod('post')) {
            $data = $request->all();

            foreach ($data['sku'] as $key => $value) {
                if (!empty($value)) {
                    // SKU duplicate check
                    $skuCheck = ProductAttribute::where('sku', $value)->count();
                    if ($skuCheck > 0) {
                        return redirect()->back()->with('error_message', 'SKU is already exists');
                    }

                    // size duplicate check
                    $sizeCheck = ProductAttribute::where([
                        'product_id' => $id,
                        'size' => $data['size'][$key]
                    ])->count();
                    if ($sizeCheck > 0) {
                        return redirect()->back()->with('error_message', 'Size is already exixts, please enter another size!');
                    }

                    $attribute = new ProductAttribute();
                    $attribute->product_id = $id;
                    $attribute->size = $data['size'][$key];
                    $attribute->price = $data['price'][$key];
                    $attribute->stock = $data['stock'][$key];
                    $attribute->sku = $value;
                    $attribute->status = 1;
                    $attribute->save();
                }
            }

            return redirect()->route('products.view')->with('success_message', 'Product attributes successfull added!');
        }

        return view('admin.products.add_attributes_product', compact('product'));
    }

    public function editAttributesProduct(Request $request)
    {
        if ($request->isMethod('post')) {
            $data = $request->all();

            foreach ($data['attributeId'] as $key => $value) {
                if (!empty($value)) {
                    ProductAttribute::where([
                        'id' => $data['attributeId'][$key]
                    ])->update([
                        'stock' => $data['stock'][$key],
                        'price' => $data['price'][$key]
                    ]);
                }
            }

            return redirect()->back()->with('success_message', 'Product attribute successfullu updated');
        }
    }

    public function updateAttributeStatus(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            if ($data['status'] == 'Active') {
                $status = 0;
            } else {
                $status = 1;
            }
        }

        ProductAttribute::where('id', $data['attribute_id'])->update(['status' => $status]);
        return response()->json(['status' => $status, 'products_id' => $data['attribute_id']]);
    }

    public function updateProductStatus(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();

            if ($data['status'] == 'Active') {
                $status = 0;
            } else {
                $status = 1;
            }

            Product::where('id', $data['product_id'])->update(['status' => $status]);
            return response()->json([
                'status' => $status,
                'product_id' => $data['product_id']
            ]);
        }
    }

    public function showProduct($id)
    {
        $data = Product::with(['section', 'category', 'brand', 'admin', 'vendor'])->where('id', $id)->first();
        $productImage = ProductImage::where('product_id', $id)->get();
        // dd($data);
        return view('admin.products.show_product', compact('data', 'productImage'));
    }

    public function showVendorProduct($id)
    {
        $dataVendor = Vendor::where('id', $id)->first();
        
        return view('admin.vendors.show_vendor', compact('dataVendor'));
    }

    public function addImagesProduct(Request $request, $id)
    {
        $product = Product::select(
            'id', 'product_name', 'product_code', 'product_color',
            'product_price', 'product_image'
        )->with('images')->find($id);
        // dd($product);

        $productImage = ProductImage::where('product_id', $id)->get();

        if ($request->isMethod('post')) {
            $data = $request->all();
            if ($request->hasFile('image')) {
                $image_tmp = $request->file('image');
                // echo "<pre>"; print_r($image_tmp); die;

                foreach ($image_tmp as $key => $value) {
                    $imageName = 'product_' . date('Y-m-dHis') . '_' . $value->getClientOriginalName();
                    $imagePath = public_path('/images/product_images/multiple');
                    $value->move($imagePath, $imageName);
                    $imageProduct = new ProductImage();
                    $imageProduct->image = $imageName;
                    $imageProduct->product_id = $id;
                    $imageProduct->status = 1;
                    $imageProduct->save();
                }
            }

            return redirect()->back()->with('success_message', 'Multiple product images successfully added');
        }

        return view('admin.products.add_images_product', compact('product', 'productImage'));
    }

    public function deleteProduct($id)
    {
        $data = Product::find($id);
        if (File::exists(public_path('/images/product_images/' . $data['product_image'])) || 
            File::exists(public_path('/videos/product_videos/' . $data['product_video']))) {
                
            File::delete(public_path('/images/product_images/' . $data['product_image']));
            File::delete(public_path('/videos/product_videos/' . $data['product_video']));

        }

        $data->delete();
        return redirect()->back()->with('success_message', 'Product deleted successfully');
    }
}

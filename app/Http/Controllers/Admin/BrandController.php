<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function viewBrands()
    {
        $data = Brand::get()->toArray();
        return view('admin.brands.view_brands', compact('data'));
    }

    public function createEditBrand(Request $request, $id = null)
    {
        if ($id == "") {
            $title = "Create New Brand";
            $brand = new Brand;
            $message = "Brand added successfully!";
        } else {
            $title = "Edit Brand";
            $brand = Brand::find($id);
            $message = "Brand updated successfully!";
        }

        if ($request->isMethod('post')) {
            $data = $request->all();
            $rules = [
                'name' => 'required|regex:/^[\pL\s\-]+$/u',
            ];
            $customMessages = [
                'name.required' => 'Brand Name is required',
                'name.regex' => 'Valid Brand Name is required',
            ];
            $this->validate($request, $rules, $customMessages);

            $brand->name = $data['name'];
            $brand->status = 1;
            $brand->save();
            return redirect()->route('brands.view')->with('success_message', $message);
        }

        return view('admin.brands.create_edit_brand', compact('title', 'brand'));
    }

    public function updateBrandStatus(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            if ($data['status'] == 'Active') {
                $status = 0;
            } else {
                $status = 1;
            }
        }

        Brand::where('id', $data['brand_id'])->update(['status' => $status]);
        return response()->json(['status' => $status, 'brand_id' => $data['brand_id']]);
    }

    public function deleteBrand($id)
    {
        Brand::where('id', $id)->delete();
        return redirect()->back()->with('success_message', 'Brand deleted successfully!');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{
    public function viewCategories()
    {
        $data = Category::get();
        return view('admin.categories.view_categories', compact('data'));
    }

    public function updateCategoryStatus(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;
            if ($data['status'] == 'Active') {
                $status = 0;
            } else {
                $status = 1;
            }
            Category::where('id', $data['category_id'])->update(['status' => $status]);
            return response()->json(['status' => $status, 'category_id' => $data['category_id']]);
        }
    }

    public function createEditCategory(Request $request, $id = null)
    {
        if ($id == "") {
            // Add Category
            $title = "Create New Category";
            $category = new Category;
            $getCategories = array();
            $message = "Category created successfully!";
        } else {
            // Edit Category
            $title = "Edit Category";
            $category = Category::find($id);
            $getCategories = Category::with('subcategories')->where([
                'parent_id' => 0,
                'section_id' => $category->section_id
            ])->get();
            
            $message = "Category updated successfully!";
        }

        if ($request->isMethod('post')) {
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;

            // Category Validation
            $this->validate($request, [
                'category_name' => 'required|regex:/^[\pL\s\-]+$/u',
                'parent_id' => 'required',
                'section_id' => 'required',
            ], [
                'category_name.required' => 'Category Name is required',
                'category_name.regex' => 'Valid Category Name is required',
                'parent_id.required' => 'Parent Category is required',
                'section_id.required' => 'Section is required',
            ]);

            // upload category image
            if ($request->hasFile('category_image')) {
                $image_tmp = $request->file('category_image');
                if (!is_null($image_tmp)) {
                    File::delete(public_path('/images/category_images/' . $category->category_image));
                    $imageName = 'category_' . date('Y-m-dHis') . '.' . $image_tmp->getClientOriginalExtension();
                    $image_tmp->move(public_path('images/category_images/'), $imageName);
                    $category->category_image = $imageName;
                } elseif (!empty($data['current_image'])) {
                    $imageName = $data['current_image'];
                } else {
                    $imageName = "";
                }
            }

            $category->parent_id = $data['parent_id'];
            $category->section_id = $data['section_id'];
            $category->category_name = $data['category_name'];
            $category->category_discount = $data['category_discount'];
            $category->description = $data['description'];
            $category->url = $data['url'];
            $category->meta_title = $data['meta_title'];
            $category->meta_description = $data['meta_description'];
            $category->meta_keywords = $data['meta_keywords'];
            $category->status = 1;
            $category->save();

            return redirect()->route('categories.view')->with('success_message', $message);
        }

        // get sections
        $sections = Section::where('status', 1)->get();

        return view('admin.categories.create_edit_category', compact('title', 'category', 'sections', 'getCategories'));
    }

    public function appendCategoriesLevel(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            // echo "<pre>"; print_r($data); die;
            $getCategories = Category::with('subcategories')->where([
                'parent_id' => 0,
                'section_id' => $data['section_id']
            ])->get();
            return view('admin.categories.append_category_level', compact('getCategories'));
        }
    }

    public function deleteCategory($id)
    {
        $data = Category::find($id);
        if (File::exists(public_path('/images/category_images/' . $data->category_image))) {
            File::delete(public_path('/images/category_images/' . $data->category_image));
        }
        $data->delete();
        return redirect()->back()->with('success_message', 'Category deleted successfully!');

    }
}

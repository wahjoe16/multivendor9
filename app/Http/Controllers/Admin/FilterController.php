<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ProductFilterValues;
use App\Models\ProductsFilter;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FilterController extends Controller
{
    public function filters()
    {
        $filters = ProductsFilter::get()->toArray();

        return view('admin.filters.index')->with(compact('filters'));
    }

    public function createEditFilter(Request $request, $id = null)
    {
        if ($id == "") {
            // Create Filter
            $title = "Add Filter";
            $filter = new ProductsFilter();
            $message = "Filter added successfully!";
        } else {
            // Edit Filter
            $title = "Edit Filter";
            $filter = ProductsFilter::find($id);
            $message = "Filter updated successfully!";
        }

        $categories = Section::with('categories')->get()->toArray();

        if ($request->isMethod('post')) {
            $data = $request->all();
            // dd($data);
            $rules = [
                'filter_name' => 'required|regex:/^[\pL\s\-]+$/u',
            ];
            $customMessages = [
                'filter_name.required' => 'Filter Name is required',
                'filter_name.regex' => 'Valid Filter Name is required',
            ];

            $this->validate($request, $rules, $customMessages);


            // Save to DB
            $filter->filter_name = $data['filter_name'];
            $filter->filter_column = $data['filter_column'];
            $filter->cat_ids = implode(',', $data['cat_ids']); // Mengubah array menjadi string dengan koma sebagai pemisah
            $filter->status = 1;
            $filter->save();

            DB::statement('ALTER TABLE products ADD '.$data['filter_column'].' VARCHAR(255) AFTER description'); // Menambahkan kolom baru ke tabel products

            return redirect()->route('filters.index')->with('success_message', $message);
        }

        return view('admin.filters.create_edit')->with(compact('title', 'filter', 'categories'));
    }

    public function filterValues()
    {
        $filterValues = ProductFilterValues::get()->toArray();

        return view('admin.filter_values.index')->with(compact('filterValues'));
    }

    public function updateFilterStatus(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            if ($data['status'] == 'Active') {
                $status = 0;
            } else {
                $status = 1;
            }
            ProductsFilter::where('id', $data['filter_id'])->update(['status' => $status]);

            return response()->json(['status' => $status, 'filter_id' => $data['filter_id']]);
        }
    }

    public function updateFilterValueStatus(Request $request)
    {
        if ($request->ajax()) {
            $data = $request->all();
            if ($data['status'] == 'Active') {
                $status = 0;
            } else {
                $status = 1;
            }
            ProductFilterValues::where('id', $data['filter_id'])->update(['status' => $status]);

            return response()->json(['status' => $status, 'filter_id' => $data['filter_id']]);
        }
    }

    public function createEditFilterValue()
    {
        
    }
}

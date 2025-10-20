<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function viewBanners()
    {
        // Logic to retrieve and display products
        $data = Banner::get();
        return view('admin.banners.view_banners', compact('data'));
    }

    public function createEditBanner(Request $request, $id = null)
    {
        if ($id == '') {
            $title = 'Create new banner';
            $banner = new Banner();
            $message = "Banner created successfully";
        } else {
            $title = 'Edit banner';
            $banner = Banner::find($id);
            $message = "Banner updated successfully";
        }

        if ($request->isMethod('post')) {
            $data = $request->all();

            if ($request->hasFile('image')) {
                $image_tmp = $request->file('image');
                $imageName = 'banner_' . date('Y-m-dHis') . '.' . $image_tmp->getClientOriginalExtension();
                $path = public_path('/images/banners/');
                $image_tmp->move($path, $imageName);
                $banner->image = $imageName; 
            }

            $banner->link = $data['link'];
            $banner->title = $data['title'];
            $banner->subtitle = $data['subtitle'];
            $banner->alt = $data['alt'];
            $banner->status = 1;
            $banner->save();

            return redirect()->route('banners.view')->with('success_message', $message);
        }

        return view('admin.banners.create_edit_banner', compact('title', 'banner'));
    }
}

<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    public function index()
    {
        $banner = Banner::where('status', 1)->get()->toArray();
        // dd($banner);
        return view('front.index', compact('banner'));
    }
}

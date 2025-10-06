<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\SectionController;
use App\Http\Controllers\ProfileController;
use App\Models\Admin;
use App\Models\Country;
use App\Models\Vendor;
use App\Models\VendorsBankDetail;
use App\Models\VendorsBusinessDetail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::group(['prefix'=>'/admin'], function () {
    Route::match(['get', 'post'], '/login', [AdminController::class, 'login'])->name('login.admin');

    Route::group(['middleware'=>['admin']], function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard.admin');
        Route::get('/logout', [AdminController::class, 'logout'])->name('logout.admin');

        Route::get('/settings', function () {
            $dataAdmin = Admin::where('id', Auth::guard('admin')->user()->id)->first();
            // dd($dataAdmin);
            return view('admin.settings', compact('dataAdmin'));
        })->name('settings.admin');
        Route::post('/update-admin-password', [AdminController::class, 'updateAdminPassword'])->name('update.admin.password');
        Route::post('/update-admin-profile', [AdminController::class, 'updateAdminProfile'])->name('update.admin.profile');
        Route::get('admins/{type?}', [AdminController::class, 'viewAdmins'])->name('view.admins');

        Route::get('/personal-business-bank-settings', function () {
            $dataAdmin = Admin::where('id', Auth::guard('admin')->user()->id)->first();
            $dataVendor = Vendor::where('id', Auth::guard('admin')->user()->vendor_id)->first();
            $dataVendorBusiness = VendorsBusinessDetail::where('id', Auth::guard('admin')->user()->vendor_id)->first();
            $dataVendorBank = VendorsBankDetail::where('id', Auth::guard('admin')->user()->vendor_id)->first();
            $countries = Country::where('status', 1)->get();
            // dd($dataVendor);
            return view('admin.business_bank_details', compact('dataAdmin', 'dataVendor', 'dataVendorBusiness', 'dataVendorBank', 'countries'));
        })->name('business.bank.details.vendor');
        Route::post('/update-vendor-profile', [AdminController::class, 'updateVendorProfile'])->name('update.vendor.profile');
        Route::post('/update-vendor-business', [AdminController::class, 'updateVendorBusiness'])->name('update.vendor.business');
        Route::post('/update-vendor-bank', [AdminController::class, 'updateVendorBank'])->name('update.vendor.bank');
        Route::get('/show-vendor/{id}', [AdminController::class, 'showVendor'])->name('show.vendor');

        Route::post('/update-admin-status', [AdminController::class, 'updateAdminStatus'])->name('update.admin.status');

        // Sections Management
        Route::get('/sections', [SectionController::class, 'viewSections'])->name('sections.view');
        Route::post('/update-section-status', [SectionController::class, 'updateSectionStatus'])->name('update.section.status');
        Route::match(['get', 'post'], '/create-edit-section/{id?}', [SectionController::class, 'createEditSection'])->name('create.edit.section');
        Route::get('/delete/{id}/section', [SectionController::class, 'deleteSection'])->name('delete.section');

        // Categories Management
        Route::get('/categories', [CategoryController::class, 'viewCategories'])->name('categories.view');
        Route::post('/update-category-status', [CategoryController::class, 'updateCategoryStatus'])->name('update.category.status');
        Route::match(['get', 'post'], '/create-edit-category/{id?}', [CategoryController::class, 'createEditCategory'])->name('create.edit.category');
        Route::get('/append-categories-level', [CategoryController::class, 'appendCategoriesLevel'])->name('append.categories.level');
        Route::get('/delete/{id}/category', [CategoryController::class, 'deleteCategory'])->name('delete.category');

        // Products Management
        Route::get('/products', [AdminController::class, 'viewProducts'])->name('products.view');

    });
    
});


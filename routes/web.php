<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\FilterController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SectionController;
use App\Http\Controllers\Front\IndexController;
use App\Http\Controllers\Front\ProductController as FrontProductController;
use App\Http\Controllers\Front\VendorController;
use App\Http\Controllers\ProfileController;
use App\Models\Admin;
use App\Models\Country;
use App\Models\Vendor;
use App\Models\VendorsBankDetail;
use App\Models\VendorsBusinessDetail;
use App\Models\Category;
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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::namespace('App\Http\Controllers\Front')->group(function () {
    // Frontend Routes can be defined here if needed
    Route::get('/', [IndexController::class, 'index'])->name('front.index');

    // Route untuk menampilkan produk berdasarkan kategori yang user pilih/klik
    $catUrl = Category::select('url')->where('status', 1)->get()->pluck('url')->toArray();
    foreach ($catUrl as $key => $url) {
        Route::match(['get', 'post'], '/'.$url, [FrontProductController::class, 'listing'])->name('front.category.products');
    }

    Route::get('/vendor/login-register', [VendorController::class, 'loginRegister'])->name('vendor.login.register');
    Route::post('/vendor/login', [VendorController::class, 'vendorLogin'])->name('vendor.login');
    Route::post('/vendor/register', [VendorController::class, 'vendorRegister'])->name('vendor.register');

    Route::get('/vendor/confirmation/{code}', [VendorController::class, 'vendorConfirmation'])->name('vendor.confirmation');
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
        Route::get('/view-vendors', [AdminController::class, 'viewVendors'])->name('view.vendors');

        Route::get('/personal-business-bank-settings', function () {
            $dataAdmin = Admin::where('id', Auth::guard('admin')->user()->id)->first();
            $dataVendor = Vendor::where('id', Auth::guard('admin')->user()->vendor_id)->first();
            $dataVendorBusiness = VendorsBusinessDetail::where('vendor_id', Auth::guard('admin')->user()->vendor_id)->first();
            $dataVendorBank = VendorsBankDetail::where('vendor_id', Auth::guard('admin')->user()->vendor_id)->first();
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

        // Brands Management
        Route::get('/brands', [BrandController::class, 'viewBrands'])->name('brands.view');
        Route::match(['get', 'post'], '/create-edit-brand/{id?}', [BrandController::class, 'createEditBrand'])->name('create.edit.brand');
        Route::post('/update-brand-status', [BrandController::class, 'updateBrandStatus'])->name('update.brand.status');
        Route::get('/delete/{id}/brand', [BrandController::class, 'deleteBrand'])->name('delete.brand');

        // Products Management
        Route::get('/products', [ProductController::class, 'viewProducts'])->name('products.view');
        Route::get('/show-product/{id}', [ProductController::class, 'showProduct'])->name('product.show');
        Route::get('/show-vendor-product/{id}', [ProductController::class, 'showVendorProduct'])->name('vendor.product.show');
        Route::match(['get', 'post'], '/create-edit-product/{id?}', [ProductController::class, 'createEditProduct'])->name('create.edit.product');
        Route::post('/update-product-status', [ProductController::class, 'updateProductStatus'])->name('update.product.status');
        Route::match(['get', 'post'], '/add-attributes-product/{id}', [ProductController::class, 'addAttributesProduct'])->name('attributesProduct.add');
        Route::match(['get', 'post'], '/edit-attributes-product/{id}', [ProductController::class, 'editAttributesProduct'])->name('attributesProduct.edit');
        Route::match(['get', 'post'], '/add-images-product/{id}', [ProductController::class, 'addImagesProduct'])->name('imagesProduct.add');
        Route::post('/update-attribute-status', [ProductController::class, 'updateAttributeStatus'])->name('updateAttributeStatus');
        Route::get('/delete/{id}/product', [ProductController::class, 'deleteProduct'])->name('delete.product');

        // Filter management
        Route::get('/filters', [FilterController::class, 'filters'])->name('filters.index');
        Route::match(['get', 'post'], '/create-edit-filter/{id?}', [FilterController::class, 'createEditFilter'])->name('create.edit.filter');
        Route::post('/update-filter-status', [FilterController::class, 'updateFilterStatus'])->name('update.filter.status');
        Route::get('/delete/{id}/filter', [FilterController::class, 'deleteFilter'])->name('delete.filter');

        // Append Filters Level
        Route::post('/append-filters-level', [FilterController::class, 'appendFiltersLevel'])->name('append.filters.level');

        // Filter Values Management
        Route::get('/filter-values', [FilterController::class, 'filterValues'])->name('filter.values.index');
        Route::match(['get', 'post'], '/create-edit-filter-value/{id?}', [FilterController::class, 'createEditFilterValue'])->name('create.edit.filter.value');
        Route::post('/update-filter-value-status', [FilterController::class, 'updateFilterValueStatus'])->name('update.filter.value.status');
        Route::get('/delete/{id}/filter-value', [FilterController::class, 'deleteFilterValue'])->name('delete.filter.value');

        // Banner Management
        Route::get('/banners', [BannerController::class, 'viewBanners'])->name('banners.view');
        Route::match(['get', 'post'], '/create-edit-banner/{id?}', [BannerController::class, 'createEditBanner'])->name('create.edit.banner');
        Route::get('/show-banner/{id}', [BannerController::class, 'showBanner'])->name('banner.show');
        Route::get('/delete/{id}/banner', [BannerController::class, 'deleteBanner'])->name('delete.banner');
        Route::post('/update-banner-status', [BannerController::class, 'updateBannerStatus'])->name('update.banner.status');
    });
    
});


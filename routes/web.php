<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();
/*
|--------------------------------------------------------------------------
| Backend Route
|--------------------------------------------------------------------------
*/
// Route::get('/', [App\Http\Controllers\Backend\HomeController::class, 'index'])->name('dashboard');
Auth::routes();
Route::group(['middleware' => ['admin']], function () {
    Route::get('/', [App\Http\Controllers\Backend\HomeController::class, 'index'])->name('dashboard');
    Route::prefix('employee')->group(function(){
        Route::match(array('GET','POST'),'/add', [App\Http\Controllers\Backend\EmployeeController::class, 'add'])->name('employee-add');
        Route::get('/list', [App\Http\Controllers\Backend\EmployeeController::class, 'list'])->name('employee-list');
        Route::match(array('GET','POST'),'/edit/{id}', [App\Http\Controllers\Backend\EmployeeController::class, 'edit'])->name('employee-edit');
        Route::get('/delete/{id}', [App\Http\Controllers\Backend\EmployeeController::class, 'destroy'])->name('employee-delete');
    });
    Route::prefix('store')->group(function(){
        Route::match(array('GET','POST'),'/add', [App\Http\Controllers\Backend\StoreController::class, 'add'])->name('store-add');
        Route::get('/list', [App\Http\Controllers\Backend\StoreController::class, 'list'])->name('store-list');
        Route::match(array('GET','POST'),'/edit/{id}', [App\Http\Controllers\Backend\StoreController::class, 'edit'])->name('store-edit');
        Route::get('/delete/{id}', [App\Http\Controllers\Backend\StoreController::class, 'destroy'])->name('store-delete');
    });
    Route::prefix('customer')->group(function(){
        Route::match(array('GET','POST'),'/add', [App\Http\Controllers\Backend\CustomerController::class, 'add'])->name('customer-add');
        Route::get('/list', [App\Http\Controllers\Backend\CustomerController::class, 'list'])->name('customer-list');
        Route::match(array('GET','POST'),'/edit/{id}', [App\Http\Controllers\Backend\CustomerController::class, 'edit'])->name('customer-edit');
        Route::get('/delete/{id}', [App\Http\Controllers\Backend\CustomerController::class, 'destroy'])->name('customer-delete');
    });
    Route::prefix('product/category')->group(function(){
        Route::match(array('GET','POST'),'/add', [App\Http\Controllers\Backend\CategoryController::class, 'add'])->name('category-add');
        Route::get('/list', [App\Http\Controllers\Backend\CategoryController::class, 'list'])->name('category-list');
        Route::match(array('GET','POST'),'/edit/{id}', [App\Http\Controllers\Backend\CategoryController::class, 'edit'])->name('category-edit');
        Route::get('/delete/{id}', [App\Http\Controllers\Backend\CategoryController::class, 'destroy'])->name('category-delete');
    });
    Route::prefix('product/brand')->group(function(){
        Route::match(array('GET','POST'),'/add', [App\Http\Controllers\Backend\BrandController::class, 'add'])->name('brand-add');
        Route::get('/list', [App\Http\Controllers\Backend\BrandController::class, 'list'])->name('brand-list');
        Route::match(array('GET','POST'),'/edit/{id}', [App\Http\Controllers\Backend\BrandController::class, 'edit'])->name('brand-edit');
        Route::get('/delete/{id}', [App\Http\Controllers\Backend\BrandController::class, 'destroy'])->name('brand-delete');
    });
    Route::prefix('supplier')->group(function(){
        Route::match(array('GET','POST'),'/add', [App\Http\Controllers\Backend\SupplierController::class, 'add'])->name('supplier-add');
        Route::get('/list', [App\Http\Controllers\Backend\SupplierController::class, 'list'])->name('supplier-list');
        Route::match(array('GET','POST'),'/edit/{id}', [App\Http\Controllers\Backend\SupplierController::class, 'edit'])->name('supplier-edit');
        Route::get('/delete/{id}', [App\Http\Controllers\Backend\SupplierController::class, 'destroy'])->name('supplier-delete');
    });
    Route::prefix('rack')->group(function(){
        Route::match(array('GET','POST'),'/add', [App\Http\Controllers\Backend\RackController::class, 'add'])->name('rack-add');
        Route::get('/list', [App\Http\Controllers\Backend\RackController::class, 'list'])->name('rack-list');
        Route::match(array('GET','POST'),'/edit/{id}', [App\Http\Controllers\Backend\RackController::class, 'edit'])->name('rack-edit');
        Route::get('/delete/{id}', [App\Http\Controllers\Backend\RackController::class, 'destroy'])->name('rack-delete');
    });
    Route::prefix('bank/card')->group(function(){
        Route::match(array('GET','POST'),'/add', [App\Http\Controllers\Backend\CardController::class, 'add'])->name('card-add');
        Route::get('/list', [App\Http\Controllers\Backend\CardController::class, 'list'])->name('card-list');
        Route::match(array('GET','POST'),'/edit/{id}', [App\Http\Controllers\Backend\CardController::class, 'edit'])->name('card-edit');
        Route::get('/delete/{id}', [App\Http\Controllers\Backend\CardController::class, 'destroy'])->name('card-delete');
    });
    Route::prefix('bank/account')->group(function(){
        Route::match(array('GET','POST'),'/add', [App\Http\Controllers\Backend\AccountController::class, 'add'])->name('account-add');
        Route::get('/list', [App\Http\Controllers\Backend\AccountController::class, 'list'])->name('account-list');
        Route::match(array('GET','POST'),'/edit/{id}', [App\Http\Controllers\Backend\AccountController::class, 'edit'])->name('account-edit');
        Route::get('/delete/{id}', [App\Http\Controllers\Backend\AccountController::class, 'destroy'])->name('account-delete');
    });
    Route::prefix('supplier/payment')->group(function(){
        Route::match(array('GET','POST'),'/add', [App\Http\Controllers\Backend\SupplierPaymentController::class, 'add'])->name('supplier-payment-add');
        Route::get('/list', [App\Http\Controllers\Backend\SupplierPaymentController::class, 'list'])->name('supplier-payment-list');
        Route::match(array('GET','POST'),'/edit/{id}', [App\Http\Controllers\Backend\SupplierPaymentController::class, 'edit'])->name('supplier-payment-edit');
        Route::get('/delete/{id}', [App\Http\Controllers\Backend\SupplierPaymentController::class, 'destroy'])->name('supplier-payment-delete');
    });
    Route::prefix('supplier/payment/alert')->group(function(){
        Route::match(array('GET','POST'),'/add', [App\Http\Controllers\Backend\SupplierPaymentAlertController::class, 'add'])->name('supplier-payment-alert-add');
        Route::get('/list', [App\Http\Controllers\Backend\SupplierPaymentAlertController::class, 'list'])->name('supplier-payment-alert-list');
        Route::match(array('GET','POST'),'/edit/{id}', [App\Http\Controllers\Backend\SupplierPaymentAlertController::class, 'edit'])->name('supplier-payment-alert-edit');
        Route::get('/delete/{id}', [App\Http\Controllers\Backend\SupplierPaymentAlertController::class, 'destroy'])->name('supplier-payment-alert-delete');
    });
    Route::prefix('expense')->group(function(){
        Route::match(array('GET','POST'),'/add', [App\Http\Controllers\Backend\ExpenseController::class, 'add'])->name('expense-add');
        Route::get('/list', [App\Http\Controllers\Backend\ExpenseController::class, 'list'])->name('expense-list');
        Route::match(array('GET','POST'),'/edit/{id}', [App\Http\Controllers\Backend\ExpenseController::class, 'edit'])->name('expense-edit');
        Route::get('/delete/{id}', [App\Http\Controllers\Backend\ExpenseController::class, 'destroy'])->name('expense-delete');
    });
    Route::prefix('asset')->group(function(){
        Route::match(array('GET','POST'),'/add', [App\Http\Controllers\Backend\AssetController::class, 'add'])->name('asset-add');
        Route::get('/list', [App\Http\Controllers\Backend\AssetController::class, 'list'])->name('asset-list');
        Route::match(array('GET','POST'),'/edit/{id}', [App\Http\Controllers\Backend\AssetController::class, 'edit'])->name('asset-edit');
        Route::get('/delete/{id}', [App\Http\Controllers\Backend\AssetController::class, 'destroy'])->name('asset-delete');
    });
    Route::prefix('emplyee/salary-pay')->group(function(){
        Route::match(array('GET','POST'),'/add', [App\Http\Controllers\Backend\EmployeeSalaryController::class, 'add'])->name('salary-pay-add');
        Route::get('/list', [App\Http\Controllers\Backend\EmployeeSalaryController::class, 'list'])->name('salary-pay-list');
        Route::match(array('GET','POST'),'/edit/{id}', [App\Http\Controllers\Backend\EmployeeSalaryController::class, 'edit'])->name('salary-pay-edit');
        Route::get('/delete/{id}', [App\Http\Controllers\Backend\EmployeeSalaryController::class, 'destroy'])->name('salary-pay-delete');
    });
    Route::prefix('product')->group(function(){
        Route::match(array('GET','POST'),'/add', [App\Http\Controllers\Backend\ProductController::class, 'add'])->name('product-add');
        Route::get('/list', [App\Http\Controllers\Backend\ProductController::class, 'list'])->name('product-list');
        Route::match(array('GET','POST'),'/edit/{id}', [App\Http\Controllers\Backend\ProductController::class, 'edit'])->name('product-edit');
        Route::get('/delete/{id}', [App\Http\Controllers\Backend\ProductController::class, 'destroy'])->name('product-delete');
        // stock in
        Route::match(array('GET','POST'),'/stock-in', [App\Http\Controllers\Backend\ProductController::class, 'stock_add'])->name('product-stock-in');
        Route::get('/stock-in-list', [App\Http\Controllers\Backend\ProductController::class, 'stock_in_list'])->name('product-stock-in-list');
        Route::get('/stock-in-details/{id}', [App\Http\Controllers\Backend\ProductController::class, 'stock_in_details'])->name('product-stock-in-details');
    });
    // sale
    Route::match(array('GET','POST'),'/sales', [App\Http\Controllers\Backend\ProductController::class, 'product_sale'])->name('product-sale');
    
    // 
   Route::match(array('GET','POST'),'/site-info', [App\Http\Controllers\Backend\SettingsController::class, 'edit'])->name('site-info');


    Route::prefix('api')->group(function(){
        Route::get('/categories', [App\Http\Controllers\Api\CategoryController::class, 'categories']);
        Route::get('/brands', [App\Http\Controllers\Api\BrandController::class, 'brands']);
        Route::get('/subcategories/{id}', [App\Http\Controllers\Api\CategoryController::class, 'subcategories']);
        Route::get('/racks', [App\Http\Controllers\Api\RackController::class, 'racks']);
        Route::get('/product/{id}', [App\Http\Controllers\Api\ProductController::class, 'product_by_id']);
        Route::get('/products', [App\Http\Controllers\Api\ProductController::class, 'products']);
        Route::post('/add-to-cart', [App\Http\Controllers\Api\ProductController::class, 'add_to_cart']);
        Route::get('/supplier/{id}', [App\Http\Controllers\Api\SupplierController::class, 'supplier_by_id']);
    });
});
// Route::get('/home', 'HomeController@index')->name('home');

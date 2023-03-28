<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
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
    return redirect('login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
route::get('/redirect',[HomeController::class, 'redirect']);
route::get('/registration',[HomeController::class, 'registration']);
route::get('/add_product',[HomeController::class, 'add_product']);
route::get('/product',[HomeController::class, 'product']);
route::get('/sale',[HomeController::class, 'sale']);
route::put('/sale_product/',[HomeController::class, 'sale_product']);
route::get('/purchase',[HomeController::class, 'purchase']);
route::get('/purchased',[HomeController::class, 'purchased']);
route::put('/purchase_product',[HomeController::class, 'purchase_product']);
route::get('/category',[HomeController::class, 'category']);
route::post('/add_category',[HomeController::class, 'add_category']);
route::get('/delete_category/{id}',[HomeController::class, 'delete_category']);
route::get('/add_expenses',[HomeController::class, 'add_expenses']);
route::post('/adding_product',[HomeController::class, 'adding_product']);
route::get('/delete_product/{id}',[HomeController::class, 'delete_product']);
route::get('/edit_product/{id}',[HomeController::class, 'edit_product']);
route::post('/update_product/{id}',[HomeController::class, 'update_product']);
route::post('/purchased/{id}/{item_id}',[HomeController::class, 'purchased']);
route::post('/sold/{id}/{item_id}',[HomeController::class, 'sold']);
route::get('/delete_sale/{id}',[HomeController::class, 'delete_sale']);
route::get('/delete_purchase/{id}',[HomeController::class, 'delete_purchase']);
route::get('/inventory',[HomeController::class, 'inventory']);
route::get('/delete_purchase/{id}',[HomeController::class, 'delete_purchase']);
route::get('/delete_purchase/{id}',[HomeController::class, 'delete_purchase']);
route::get('/delete_inventory/{id}',[HomeController::class, 'delete_inventory']);
route::get('/purchased_item',[HomeController::class, 'purchased_item']);
route::get('/sold_item',[HomeController::class, 'sold_item']);
route::get('/add_expenses',[HomeController::class, 'add_expenses']);
route::post('/adding_expenses',[HomeController::class, 'adding_expenses']);
route::get('/add_sales/{id}',[HomeController::class, 'add_sales']);
route::get('/add_purchase/{id}',[HomeController::class, 'add_purchase']);



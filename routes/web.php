<?php

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



use App\Http\Controllers\PizzaController;

Auth::routes();

Route::get('/home', [App\Http\Controllers\FrontendController::class, 'index'])->name('home');

Route::get('/', [App\Http\Controllers\FrontendController::class, 'index'])->name('frontpage');
Route::get('/pizza/{id}', [App\Http\Controllers\FrontendController::class, 'show'])->name('pizza.show');
Route::post('/order/store', [App\Http\Controllers\FrontendController::class, 'store'])->name('order.store');
Route::get('/user/order', [App\Http\Controllers\UserOrderController::class, 'index'])->name('user.order');
Route::delete('/order/{id}/delete', [App\Http\Controllers\UserOrderController::class, 'destroy'])->name('order.destroy');
Route::post('/checkout', [App\Http\Controllers\UserOrderController::class, 'checkout'])->name('checkout');
Route::get('/order/history', [App\Http\Controllers\FrontendController::class, 'history'])->name('order.history');


Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'admin']], function () {
    Route::get('/pizza', [App\Http\Controllers\PizzaController::class, 'index'])->name('pizza.index');
    Route::get('/pizza/create', [App\Http\Controllers\PizzaController::class, 'create'])->name('pizza.create');
    Route::post('/pizza/store', [App\Http\Controllers\PizzaController::class, 'store'])->name('pizza.store');
    Route::get('/pizza/{id}/edit', [App\Http\Controllers\PizzaController::class, 'edit'])->name('pizza.edit');
    Route::put('/pizza/{id}/update', [App\Http\Controllers\PizzaController::class, 'update'])->name('pizza.update');
    Route::delete('/pizza/{id}/delete', [App\Http\Controllers\PizzaController::class, 'destroy'])->name('pizza.destroy');

    // Display customers
    Route::get('/customers', [App\Http\Controllers\UserOrderController::class, 'customers'])->name('customers');
});


<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthenController;
use App\Http\Controllers\CustomerController;

use App\Mail\TestMail;
use Illuminate\Support\Facades\Mail;

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

Route::get('/send-test-email', function () {
    Mail::to('ry44n778@gmail.com')->send(new TestMail());
    return 'Test email sent successfully!';
});


Route::controller(AuthenController::class)->group(function(){
    Route::get('/registration','registration')->middleware('alreadyLoggedIn');
    Route::post('/registration-user','registerUser')->name('register-user');
    Route::get('/','login')->middleware('alreadyLoggedIn')->name('login');
    Route::post('/login-user','loginUser')->name('login-user');
    Route::get('/dashboard','dashboard')->middleware('isLoggedIn'); 
    Route::get('/logout','logout')->name('logout');
});

Route::post('/customers', [CustomerController::class, 'store'])->name('customers.store');
Route::get('/customers', [CustomerController::class, 'index'])->name('customers.index');
    Route::get('/customers/create', [CustomerController::class, 'create'])->name('customers.create');
    Route::get('/customers/{user_id}/edit', [CustomerController::class, 'edit'])->name('customers.edit');
    Route::post('/customers/update', [CustomerController::class, 'update'])->name('customers.update');
    Route::delete('/customers/{id}', [CustomerController::class, 'destroy'])->name('customers.destroy');
    Route::get('/customers/chart', [CustomerController::class, 'showCustomerChart'])->name('customers.chart');

<?php

use App\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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


Route::get('/', function(){
    $user = User::where('nik', session('nik'))->first();
    if($user !== null)
    {
        return redirect('/dashboard');
    }
    return view('body.index', [
        'user' => $user
    ]);
});
Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
Route::post('/checkin', [UserController::class, 'checkIn'])->name('checkin');
Route::post('/checkout', [UserController::class, 'checkOut'])->name('checkout');

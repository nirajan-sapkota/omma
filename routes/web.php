<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use App\Models\Booking;
use Illuminate\Support\Facades\Route;
  use App\Http\Controllers\GoogleController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/


/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

// Migration trigger route
Route::get('/run-migrations', function () {
    try {
        \Illuminate\Support\Facades\Artisan::call('migrate', ['--force' => true]);
        \Illuminate\Support\Facades\Artisan::call('db:seed', ['--class' => 'DatabaseSeeder', '--force' => true]);
        return response()->json([
            'status' => 'success',
            'message' => 'Database migrations and seeders executed successfully!',
            'output' => \Illuminate\Support\Facades\Artisan::output(),
        ]);
    } catch (\Throwable $e) {
        return response()->json([
            'status' => 'error',
            'message' => $e->getMessage(),
        ], 500);
    }
});

// Home page
Route::get('/', function () {
    return view('home');
})->name('home');


/*
|--------------------------------------------------------------------------
| Guest Routes
|--------------------------------------------------------------------------
|
| Only users who are NOT logged in can access these.
|
*/

Route::middleware('guest')->group(function () {

    // Login
    Route::get('/login', [
        AuthController::class,
        'showLogin'
    ])->name('login');

    Route::post('/login', [
        AuthController::class,
        'login'
    ])->name('login.attempt');


    // Registration
    Route::get('/register', [
        AuthController::class,
        'showRegister'
    ])->name('register');

    Route::post('/register', [
        AuthController::class,
        'register'
    ])->name('register.store');

});


/*
|--------------------------------------------------------------------------
| Authenticated Patient Routes
|--------------------------------------------------------------------------
|
| These are routes for users logged into the normal
| Laravel/Blade side of the application.
|
*/

Route::middleware('auth')->group(function () {

    /*
    |--------------------------------------------------------------------------
    | Logout
    |--------------------------------------------------------------------------
    */

    Route::post('/logout', [
        AuthController::class,
        'logout'
    ])->name('logout');


    /*
    |--------------------------------------------------------------------------
    | Patient Dashboard
    |--------------------------------------------------------------------------
    */

    Route::get('/dashboard', function () {

        $upcoming = Booking::where(
            'user_id',
            auth()->id()
        )
        ->upcoming()
        ->get();


        return view('dashboard', [
            'upcoming' => $upcoming,
        ]);

    })->name('dashboard');


    Route::get('/book',[BookingController::class,'create'])->name('booking.create');
    Route::post('/book', [BookingController::class,'store'])->name('booking.store');
    Route::get('/book/payment', [BookingController::class, 'payment'])->name('booking.payment');
    Route::post('/book/confirm', [BookingController::class, 'confirm'])->name('booking.confirm');


    Route::get('/google/connect', [GoogleController::class, 'connect'])
        ->name('google.connect');

    Route::get('/google/callback', [GoogleController::class, 'callback'])
        ->name('google.callback');
});
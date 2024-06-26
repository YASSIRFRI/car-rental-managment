<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\GoogleController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\VehicleModelController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\RentalsController;
use App\Http\Controllers\Auth\LoginController;

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
require __DIR__.'/auth.php';

Route::get('/', function () {
    //if (Auth::check()) {
        //return redirect('/dashboard');
    //}
    return redirect('/login');
});


Route::get('auth/google', [GoogleController::class, 'redirectToGoogle'])->name('auth.google');
Route::get('auth/google/callback', [GoogleController::class, 'handleGoogleCallback']);

Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('vehicles', VehicleController::class);
    Route::resource('rentals', RentalsController::class);
    Route::get('/clients/search', [ClientController::class, 'search'])->name('clients.search');
    
    // Define individual routes for client resource
    Route::get('/clients', [ClientController::class, 'index'])->name('clients.index');
    Route::get('/clients/create', [ClientController::class, 'create'])->name('clients.create');
    Route::post('/clients', [ClientController::class, 'store'])->name('clients.store');
    Route::get('/clients/{client}/edit', [ClientController::class, 'edit'])->name('clients.edit');
    Route::put('/clients/{client}', [ClientController::class, 'update'])->name('clients.update');
    Route::delete('/clients/{client}', [ClientController::class, 'destroy'])->name('clients.destroy');
    Route::get('/clients/{client}', [ClientController::class, 'show'])->name('clients.show');




    Route::get('/rentals/{rental}/edit', [RentalsController::class, 'edit'])->name('rentals.edit');
    Route::put('/rentals/{rental}', [RentalsController::class, 'update'])->name('rentals.update');

    Route::get('/vehicle-models/search', [VehicleModelController::class, 'index']);








    
    

});


//Api routes

use App\Http\Controllers\ApiController;

Route::get('/api/agencies', [ApiController::class, 'getAgencies']);
Route::get('/api/agencies/{agency}/cars', [ApiController::class, 'getCarsForAgency']);




use App\Http\Controllers\Auth\AdditionalInformationController;

Route::middleware(['auth'])->group(function () {
    Route::get('/additional-information', [AdditionalInformationController::class, 'show'])->name('additional-information.show');
    Route::post('/additional-information', [AdditionalInformationController::class, 'store'])->name('additional-information.store');
});




use App\Http\Controllers\InvoiceController;

Route::middleware(['auth'])->group(function () {
    Route::post('/invoices/generate', [InvoiceController::class, 'generate'])->name('invoices.generate');
    Route::post('/invoices', [InvoiceController::class, 'index'])->name('invoices.create');
});




use App\Http\Controllers\ContractController;

Route::middleware(['auth'])->group(function () {
    Route::post('/contracts/generate', [ContractController::class, 'generate'])->name('contracts.generate');
});







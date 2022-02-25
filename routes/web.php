<?php

use App\Http\Livewire\Treatments;
use App\Http\Livewire\Locations;
use App\Http\Livewire\ShowCalendar;
use App\Http\Livewire\ShowEquipment;
use App\Http\Livewire\Customers;
use App\Http\Livewire\Operators;
use App\Http\Livewire\AssignEquipmentTreatment;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});

Route::middleware(['auth:sanctum'])->group(function() {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('/calendar', ShowCalendar::class)->name('calendar');
    Route::get('/equipment', ShowEquipment::class)->name('equipment');
    Route::get('/locations', Locations::class)->name('locations');
    Route::get('/treatments', Treatments::class)->name('treatments');
    Route::get('/customers', Customers::class)->name('customers');
    Route::get('/operators', Operators::class)->name('operators');
    Route::get('/assign-eqpmt-trtmt', AssignEquipmentTreatment::class)->name('assign-eqpmt-trtmt');

});




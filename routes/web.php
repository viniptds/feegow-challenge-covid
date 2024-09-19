<?php

use App\Http\Controllers\VaccineController;
use App\Http\Controllers\WorkerController;
use App\Http\Controllers\WorkerReportController;
use App\Http\Controllers\WorkerVaccineController;
use Illuminate\Support\Facades\Route;

Route::prefix('workers')->group(function () {
    Route::get('', [WorkerController::class, 'index'])->name('workers');
    Route::get('/create', [WorkerController::class, 'create'])->name('workers.create');
    Route::post('', [WorkerController::class, 'store'])->name('workers.store');
    
    // Report
    Route::post('make-report', [WorkerReportController::class, 'makeReport'])->name('workers.make-report');
    Route::get('reports/non-vaccinated-report', [WorkerReportController::class, 'reportView'])->name('workers.non-vaccinated-report');
    Route::get('reports/{type}/{file}', [WorkerReportController::class, 'getReport'])->name('workers.get-report');
 
    // Vaccine
    Route::post('{worker}/apply-vaccine', [WorkerVaccineController::class, 'applyVaccine'])->name('workers.apply-vaccine');
   
    Route::get('{worker}', [WorkerController::class, 'show'])->name('workers.show');
    Route::delete('{worker}', [WorkerController::class, 'destroy'])->name('workers.delete');
});

Route::prefix('vaccines')->group(function () {
    Route::get('/', [VaccineController::class, 'index'])->name('vaccines');
    Route::get('/create', [VaccineController::class, 'create'])->name('vaccines.create');
    Route::post('/', [VaccineController::class, 'store'])->name('vaccines.store');
    Route::get('{vaccine}', [VaccineController::class, 'show'])->name('vaccines.show');
    Route::delete('{vaccine}', [VaccineController::class, 'destroy'])->name('vaccine.delete');
});

Route::get('/', function () {
    return view('welcome');
})->name('welcome');
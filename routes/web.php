<?php

use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\PracticeController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\FieldController;

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
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/practices',[PracticeController::class, 'index'])->name('practices.index');
Route::get('/practices/create',[PracticeController::class, 'create'])->name('practices.create');
Route::get('/practices/{practice}',[PracticeController::class, 'show'])->name('practices.show');
Route::post('/practices',[PracticeController::class, 'store'])->name('practices.store');
Route::put('/practices/{practice}',[PracticeController::class, 'update'])->name('practices.update');
Route::delete('/practices/{practice}',[PracticeController::class, 'destroy'])->name('practices.destroy');
Route::get('/practices/{practice}/edit',[PracticeController::class, 'edit'])->name('practices.edit');
Route::post('/practices/{practice}/assign',[PracticeController::class, 'assignField'])->name('practices.assign');
Route::post('/practices/{practice}/remove',[PracticeController::class, 'unassignField'])->name('practices.unassign');

Route::get('/employees',[EmployeeController::class, 'index'])->name('employees.index');
Route::post('/employees',[EmployeeController::class, 'store'])->name('employees.store');
Route::put('/employees/{employee}',[EmployeeController::class, 'update'])->name('employees.update');
Route::delete('/employees/{employee}',[EmployeeController::class, 'destroy'])->name('employees.destroy');
Route::get('/employees/create',[EmployeeController::class, 'create'])->name('employees.create');
Route::get('/employees/{employee}/edit',[EmployeeController::class, 'edit'])->name('employees.edit');

Route::get('/fields',[FieldController::class, 'index'])->name('fields.index');
Route::post('/fields',[FieldController::class, 'store'])->name('fields.store');
Route::delete('/fields/{field}',[FieldController::class, 'destroy'])->name('fields.destroy');

require __DIR__.'/auth.php';

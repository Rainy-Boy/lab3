<?php
use App\Http\Controllers\ModelController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CountryController;
use App\Http\Controllers\ManufacturerController;
Route::redirect('/', 'country');
Route::resource('country', CountryController::class);
Route::resource('manufacturer', ManufacturerController::class, ['except' => ['index', 'create']]);
Route::resource('carmodel', ModelController::class, ['except' => ['create']]);
Route::get('{countryslug}/manufacturer', [ManufacturerController::class, 'index']);
Route::get('{countryslug}/manufacturer/create', [ManufacturerController::class, 'create']);
Route::get('manufacturer/{id}/models', [ManufacturerController::class, 'show']);
Route::get('carmodel/{id}/create', [ModelController::class, 'create']);
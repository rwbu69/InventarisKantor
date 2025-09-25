<?php

use App\Http\Controllers\InventoryController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('inventories.index');
});

Route::resource('inventories', InventoryController::class);

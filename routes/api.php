<?php

use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');
// Route::post("/register", [UserController::class, "register"]);

Route::middleware(['auth:sanctum'])->group(function(){
    Route::get('/user', function(Request $request){
        return $request->user();
    });
});

Route::post("/register", [UserController::class, "register"]);
Route::post("/login", [UserController::class, "login"]);
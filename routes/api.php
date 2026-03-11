<?php

use App\Http\Controllers\CommentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->group(function(){
    Route::get('/user', function(Request $request){
        return $request->user();
    });
    Route::get("/postUser/{post}", [PostController::class, "post"]);
    Route::post("/postadd", [PostController::class, "postadd"]);
    Route::post("/postedit/{post}", [PostController::class, "postedit"]);
    Route::post("/comment/{post}", [CommentController::class, "store"]);
});
Route::get("/post/{post}", [PostController::class, "post"]);
Route::get("/postsUser/{user}", [PostController::class, "postsUser"]);
Route::get("/postsHome", [PostController::class, "postsHome"]);
Route::post("/register", [UserController::class, "register"]);
Route::post("/login", [UserController::class, "login"]);
Route::post("/like/{post}", [LikeController::class, "index"]);
<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProjectController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
Route::post("register", [AuthController::class, "register"]);
Route::post("login", [AuthController::class, "login"]);

Route::group(["middleware" => ["auth:sanctum"]], function(){
    Route::get("profile", [AuthController::class, "profile"]);
    Route::get("logout", [AuthController::class, "logout"]);

    Route::post("create-project", [ProjectController::class, "createProject"]);
    Route::get("list-project", [ProjectController::class, "listProject"]);
    Route::get("single-project/{id}", [ProjectController::class, "singleProject"]);
    Route::delete("delete-project/{id}", [ProjectController::class, "deleteProject"]);
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get("/hello", fn() => 'hello from Laravel api!');
Route::get("/about", fn() => 'Приветствую на нашем сайте');

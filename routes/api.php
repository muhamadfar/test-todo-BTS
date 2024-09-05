<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ChecklistController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
Route::get('/checklists', [ChecklistController::class, 'index']);
Route::post('/checklists', [ChecklistController::class, 'store']);
Route::get('/checklists/{checklist}', [ChecklistController::class, 'show']);
Route::delete('/checklists/{checklist}', [ChecklistController::class, 'destroy']);


    Route::post('/checklists/{checklist}/items', [ItemController::class, 'store']);
    Route::get('/items/{item}', [ItemController::class, 'show']);
    Route::put('/items/{item}', [ItemController::class, 'update']);
    Route::patch('/items/{item}/status', [ItemController::class, 'updateStatus']);
    Route::delete('/items/{item}', [ItemController::class, 'destroy']);
});


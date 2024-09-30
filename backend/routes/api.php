<?php

use App\Http\Middleware\TrackVisitor;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware([TrackVisitor::class])->get('/track-visitor', function () {
    return response()->json(['message' => 'Visitor tracked successfully.']);
});

// Route::middleware([TrackVisitor::class])->group(function() {
//     // Route::get('/products', [ProductController::class, 'index']);
//     // Route::get('/orders', [OrderController::class, 'index']);
// });
// Route::get('/products', [ProductController::class, 'index']);

<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SiteSettingController;
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

// Route::middleware([TrackVisitor::class])->get('/track-visitor', function () {
//     return response()->json(['message' => 'Visitor tracked successfully.']);
// });

Route::middleware([TrackVisitor::class])->group(function() {
    Route::post('/post-contact', [ContactController::class, 'postContact']);
    Route::get('/site-setting', [SiteSettingController::class, 'siteSetting']);
    Route::get('/categories', [CategoryController::class,'categories']);

    //products
    Route::get('/products/remark/{remark}', [ProductController::class, 'getProductByRemark']);
    Route::get('/products/category/{slug}' , [ProductController::class , 'getProductByCategory']);
    Route::get('/product/{category_id}/{subcategory_id}',[ProductController::class, 'getProductBySubCategory']);



});

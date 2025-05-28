<?php

use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\ProductDetailsController;
use App\Http\Controllers\Admin\SiteSettingController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\User\AuthController;
use App\Http\Controllers\User\CartController;
use App\Http\Controllers\User\ReviewController;
use App\Http\Controllers\Admin\SiteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::middleware([TrackVisitor::class])->get('/track-visitor', function () {
//     return response()->json(['message' => 'Visitor tracked successfully.']);
// });

//Auth

Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);
// Password Reset Routes
Route::post('/forget-password', [AuthController::class, 'sendResetLinkEmail']);
Route::post('/password-reset', [AuthController::class, 'passwordReset']);
// Email Verification Routes
// Route::get('/email/verify/{id}/{hash}', [AuthController::class, 'verifyEmail'])->name('verification.verify');
// Route::post('/email/resend', [AuthController::class, 'resendVerificationEmail'])->middleware('auth:api')->name('verification.resend');

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return response()->json(['user' => auth()->guard('api')->user()]);
// });

Route::middleware('auth:api')->group(function () {
    Route::get('/user', [AuthController::class, 'userProfile']);

    //reviews
    Route::get('/products/{id}/reviews', [ReviewController::class, 'index']);
    Route::post('/reviews', [ReviewController::class, 'store']);
    Route::patch('/reviews/{id}', [ReviewController::class, 'update']);
    Route::delete('/reviews/{id}', [ReviewController::class, 'destroy']);

    //cart
    Route::post('/cart/add', [CartController::class, 'addToCart']);
    Route::get('/cart', [CartController::class, 'getCart']);
    Route::patch('/cart/update', [CartController::class, 'updateCart']);
    Route::delete('/cart/remove/{id}', [CartController::class, 'removeFromCart']);

});

Route::post('/post-contact', [ContactController::class, 'postContact']);
Route::get('/categories', [CategoryController::class, 'categories']);

//products
Route::get('/products/remark/{remark}', [ProductController::class, 'getProductByRemark']);
Route::get('/products/category/{slug}', [ProductController::class, 'getProductByCategory']);
Route::get('/product/{category_slug}/{subcategory_slug}', [ProductController::class, 'getProductBySubCategory']);
Route::get('/search/{query}', [ProductController::class, 'ProductBySearh']);

//slider
Route::get('/sliders', [SliderController::class, 'sliders']);

//product_details
Route::get('/product-details/{id}', [ProductDetailsController::class, 'productDetails']);
Route::get('/related-product/{product_id}', [ProductDetailsController::class, 'relatedProduct']);

//notifications
Route::get('/notifications', [NotificationController::class, 'index']);
Route::put('/notifications/{id}/read', [NotificationController::class, 'markAsRead']);
Route::delete('/notifications/{id}', [NotificationController::class, 'destroy']);

// Site management routes
Route::get('/content/{type}', [SiteController::class, 'getContent']);
Route::post('/content/{type}', [SiteController::class, 'updateContent'])->middleware('auth:api');
Route::get('/settings', [SiteController::class, 'getSettings']);
Route::post('/settings', [SiteController::class, 'updateSettings'])->middleware('auth:api');

// Track visitor middleware
// Route::middleware([TrackVisitor::class])->group(function () {
//     // Add any routes that need to track visitors here
// });

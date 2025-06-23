<?php

use App\Http\Controllers\Admin\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\ReviewController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\ContentController;
use App\Http\Controllers\Admin\NotificationController;
use App\Http\Controllers\Admin\ReportController;
use App\Http\Controllers\Admin\AuthController;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register admin routes for your application.
| These routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "admin" middleware group. Make something great!
|
*/

// Admin Auth API (public)
Route::post('admin/login', [AuthController::class, 'loginAdmin']);
Route::post('admin/register', [AuthController::class, 'registerAdmin']);

// Admin Login Page (web)
Route::get('admin/login', [AuthController::class , 'loginPage'])->name('admin.login');

Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {

    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/stats', [DashboardController::class, 'stats'])->name('dashboard.stats');

    // Products
    Route::resource('products', ProductController::class);
    Route::post('products/bulk-action', [ProductController::class, 'bulkAction'])->name('products.bulk-action');
    Route::post('products/{product}/toggle-status', [ProductController::class, 'toggleStatus'])->name('products.toggle-status');
    Route::post('products/{product}/duplicate', [ProductController::class, 'duplicate'])->name('products.duplicate');

    // Categories
    Route::resource('categories', CategoryController::class);
    Route::post('categories/update-order', [CategoryController::class, 'updateOrder'])->name('categories.update-order');
    Route::post('categories/{category}/toggle-status', [CategoryController::class, 'toggleStatus'])->name('categories.toggle-status');

    // Orders
    Route::resource('orders', OrderController::class);
    Route::post('orders/{order}/update-status', [OrderController::class, 'updateStatus'])->name('orders.update-status');
    Route::get('orders/{order}/invoice', [OrderController::class, 'invoice'])->name('orders.invoice');
    Route::post('orders/bulk-action', [OrderController::class, 'bulkAction'])->name('orders.bulk-action');

    // Customers
    Route::resource('customers', CustomerController::class);
    Route::post('customers/{customer}/toggle-status', [CustomerController::class, 'toggleStatus'])->name('customers.toggle-status');
    Route::get('customers/{customer}/orders', [CustomerController::class, 'orders'])->name('customers.orders');

    // Reviews
    Route::resource('reviews', ReviewController::class);
    Route::post('reviews/{review}/approve', [ReviewController::class, 'approve'])->name('reviews.approve');
    Route::post('reviews/{review}/reject', [ReviewController::class, 'reject'])->name('reviews.reject');
    Route::post('reviews/bulk-action', [ReviewController::class, 'bulkAction'])->name('reviews.bulk-action');

    // Contact Messages
    Route::resource('contacts', ContactController::class);
    Route::post('contacts/{contact}/mark-read', [ContactController::class, 'markRead'])->name('contacts.mark-read');
    Route::post('contacts/bulk-action', [ContactController::class, 'bulkAction'])->name('contacts.bulk-action');

    // Sliders
    Route::resource('sliders', SliderController::class);
    Route::post('sliders/update-order', [SliderController::class, 'updateOrder'])->name('sliders.update-order');
    Route::post('sliders/{slider}/toggle-status', [SliderController::class, 'toggleStatus'])->name('sliders.toggle-status');

    // Settings
    Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
    Route::post('settings/general', [SettingController::class, 'updateGeneral'])->name('settings.general');
    Route::post('settings/email', [SettingController::class, 'updateEmail'])->name('settings.email');
    Route::post('settings/payment', [SettingController::class, 'updatePayment'])->name('settings.payment');
    Route::post('settings/social', [SettingController::class, 'updateSocial'])->name('settings.social');

    // Content Management
    Route::resource('content', ContentController::class);
    Route::post('content/{content}/toggle-status', [ContentController::class, 'toggleStatus'])->name('content.toggle-status');

    // Notifications
    Route::resource('notifications', NotificationController::class);
    Route::post('notifications/mark-all-read', [NotificationController::class, 'markAllRead'])->name('notifications.mark-all-read');
    Route::post('notifications/{notification}/mark-read', [NotificationController::class, 'markRead'])->name('notifications.mark-read');

    // Reports
    Route::get('reports', [ReportController::class, 'index'])->name('reports.index');
    Route::get('reports/sales', [ReportController::class, 'sales'])->name('reports.sales');
    Route::get('reports/products', [ReportController::class, 'products'])->name('reports.products');
    Route::get('reports/customers', [ReportController::class, 'customers'])->name('reports.customers');
    Route::get('reports/export/{type}', [ReportController::class, 'export'])->name('reports.export');

    // Search
    Route::get('search', [DashboardController::class, 'search'])->name('search');

    // File Upload
    Route::post('upload/image', [DashboardController::class, 'uploadImage'])->name('upload.image');
    Route::post('upload/file', [DashboardController::class, 'uploadFile'])->name('upload.file');

    // Profile
    Route::get('profile', [DashboardController::class, 'profile'])->name('profile');
    Route::post('profile', [DashboardController::class, 'updateProfile'])->name('profile.update');

    // Backup
    Route::get('backup', [DashboardController::class, 'backup'])->name('backup');
    Route::post('backup/create', [DashboardController::class, 'createBackup'])->name('backup.create');
    Route::get('backup/download/{filename}', [DashboardController::class, 'downloadBackup'])->name('backup.download');

    // System
    Route::get('system', [DashboardController::class, 'system'])->name('system');
    Route::post('system/clear-cache', [DashboardController::class, 'clearCache'])->name('system.clear-cache');
    Route::post('system/optimize', [DashboardController::class, 'optimize'])->name('system.optimize');

    // Admin Profile & Password
    Route::post('profile/update', [AuthController::class, 'updateAdminProfile']);
    Route::post('password/change', [AuthController::class, 'changeAdminPassword']);
    Route::get('logout', [AdminController::class, 'logout'])->name('logout');

});

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\NewsletterController;

// ========================
// Public Routes
// ========================
Route::get('/', [HomeController::class, 'index'])->name('home');

// Listings
Route::prefix('listings')->name('listings.')->group(function () {
    Route::get('/', [ListingController::class, 'grid'])->name('index');
    Route::get('/grid', [ListingController::class, 'grid'])->name('grid');
    Route::get('/grid-sidebar', [ListingController::class, 'gridSidebar'])->name('grid-sidebar');
    Route::get('/list-sidebar', [ListingController::class, 'listSidebar'])->name('list-sidebar');
    Route::get('/grid-map', [ListingController::class, 'gridMap'])->name('grid-map');
    Route::get('/list-map', [ListingController::class, 'listMap'])->name('list-map');
    Route::get('/{slug}', [ListingController::class, 'details'])->name('show');
});

// Categories
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/category/{slug}', [CategoryController::class, 'show'])->name('categories.show');

// Blog
Route::prefix('blog')->name('blog.')->group(function () {
    Route::get('/', [BlogController::class, 'index'])->name('index');
    Route::get('/{slug}', [BlogController::class, 'show'])->name('show');
    Route::post('/{id}/comment', [BlogController::class, 'comment'])->name('comment')->middleware('auth');
});

// Static Pages
Route::get('/about', [PageController::class, 'about'])->name('about');
Route::get('/contact', [PageController::class, 'contact'])->name('contact');
Route::post('/contact', [PageController::class, 'contactSubmit'])->name('contact.submit');
Route::get('/pricing', [PageController::class, 'pricing'])->name('pricing');
Route::get('/faq', [PageController::class, 'faq'])->name('faq');
Route::get('/gallery', [PageController::class, 'gallery'])->name('gallery');
Route::get('/how-it-works', [PageController::class, 'howItWorks'])->name('how-it-works');
Route::get('/terms', [PageController::class, 'terms'])->name('terms');
Route::get('/privacy', [PageController::class, 'privacy'])->name('privacy');

// ========================
// Authenticated User Routes
// ========================
Route::middleware(['auth', 'verified'])->prefix('user')->name('user.')->group(function () {
    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('dashboard');
    Route::get('/profile', [UserController::class, 'profile'])->name('profile');
    Route::post('/profile/update', [UserController::class, 'updateProfile'])->name('profile.update');
    Route::get('/my-listings', [UserController::class, 'myListings'])->name('my-listings');
    Route::get('/add-listing', [UserController::class, 'addListing'])->name('add-listing');
    Route::post('/store-listing', [ListingController::class, 'store'])->name('store-listing');
    Route::get('/edit-listing/{id}', [ListingController::class, 'edit'])->name('edit-listing');
    Route::put('/update-listing/{id}', [ListingController::class, 'update'])->name('update-listing');
    Route::delete('/delete-listing/{id}', [ListingController::class, 'destroy'])->name('delete-listing');
    Route::get('/bookmarks', [UserController::class, 'bookmarks'])->name('bookmarks');
    Route::post('/bookmark/{listing}', [UserController::class, 'toggleBookmark'])->name('toggle-bookmark');
    Route::delete('/bookmarks/{bookmark}', [UserController::class, 'removeBookmark'])->name('bookmarks.remove');
    Route::get('/messages', [UserController::class, 'messages'])->name('messages');
    Route::get('/reviews', [UserController::class, 'reviews'])->name('reviews');
    Route::post('/reviews/{review}/reply', [UserController::class, 'replyReview'])->name('reviews.reply');
    Route::delete('/reviews/{review}', [UserController::class, 'deleteReview'])->name('reviews.delete');
});

// Reviews
Route::post('/reviews/{listing}', [ReviewController::class, 'store'])->name('reviews.store')->middleware('auth');

// Messages
Route::post('/messages', [MessageController::class, 'store'])->name('messages.store')->middleware('auth');

// Newsletter
Route::post('/newsletter/subscribe', [NewsletterController::class, 'subscribe'])->name('newsletter.subscribe');

// Breeze Profile Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// ========================
// Admin Routes
// ========================
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/listings', [AdminController::class, 'listings'])->name('listings');
    Route::put('/listings/{id}/status', [AdminController::class, 'updateListingStatus'])->name('listings.status');
    Route::get('/categories', [AdminController::class, 'categories'])->name('categories');
    Route::post('/categories', [AdminController::class, 'storeCategory'])->name('categories.store');
    Route::put('/categories/{id}', [AdminController::class, 'updateCategory'])->name('categories.update');
    Route::delete('/categories/{id}', [AdminController::class, 'deleteCategory'])->name('categories.delete');
    Route::get('/users', [AdminController::class, 'users'])->name('users');
    Route::get('/blog', [AdminController::class, 'blog'])->name('blog');
    Route::get('/blog/create', [AdminController::class, 'createBlog'])->name('blog.create');
    Route::post('/blog', [AdminController::class, 'storeBlog'])->name('blog.store');
    Route::get('/settings', [AdminController::class, 'settings'])->name('settings');
});

// Dashboard redirect (Breeze default)
Route::get('/dashboard', function () {
    return redirect()->route('user.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';
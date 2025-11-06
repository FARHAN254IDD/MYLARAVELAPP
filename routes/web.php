<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactController;

use App\Http\Controllers\Admin\{
    DashboardController as AdminDashboardController,
    PostController,

    UserController,
    CommentController,
    SettingController,
    MediaController,
    ReportController
};

use App\Http\Controllers\Blogger\{
    DashboardController as BloggerDashboardController,
    PostController as BloggerPostController,
    CommentController as BloggerCommentController,
    ProfileController as BloggerProfileController
};
use App\Http\Controllers\Tester\DashboardController as TesterDashboardController;
use App\Http\Controllers\User\DashboardController as UserDashboardController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| All web routes for public and authenticated users.
*/

// 🌍 Public routes
Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [HomeController::class, 'index'])->name('home');
Route::get('/blog', [BlogController::class, 'index'])->name('blog');
Route::get('/blog/{id}', [BlogController::class, 'show'])->name('blog.show');
Route::get('/about', [AboutController::class, 'index'])->name('about');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');

// 🧑‍💻 Authenticated user routes
Route::middleware(['auth', 'verified'])->group(function () {

    // User dashboard
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');

    // 👑 Admin routes
    Route::middleware(['admin'])->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

        // CRUD resources
        Route::resource('posts', PostController::class);

        Route::resource('users', UserController::class);
        Route::resource('comments', CommentController::class);

        // User management
        Route::patch('/users/{user}/block', [UserController::class, 'toggleBlock'])->name('users.block');

        // Comment approval
        Route::patch('/comments/{comment}/approve', [CommentController::class, 'approve'])->name('comments.approve');

        // ⚙️ Settings
        Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
        Route::get('/settings/edit', [SettingController::class, 'edit'])->name('settings.edit');
        Route::post('/settings/update', [SettingController::class, 'update'])->name('settings.update');

        // 🖼️ Media
        Route::get('/media', [MediaController::class, 'index'])->name('media.index');
        Route::post('/media', [MediaController::class, 'store'])->name('media.store');
        Route::delete('/media/{media}', [MediaController::class, 'destroy'])->name('media.destroy');

        // 📊 Reports
        Route::get('/reports', [ReportController::class, 'index'])->name('reports.index');
        Route::get('/reports/download-pdf', [ReportController::class, 'downloadPDF'])->name('reports.download.pdf');
        Route::get('/reports/download-csv', [ReportController::class, 'downloadCSV'])->name('reports.download.csv');
        Route::get('/reports/export/pdf', [ReportController::class, 'exportPDF'])->name('reports.export.pdf');

    // Export CSV
    Route::get('/reports/export/csv', [ReportController::class, 'exportCSV'])->name('reports.export.csv');
    });

    // 📝 Blogger routes
    Route::middleware(['blogger'])->prefix('blogger')->name('blogger.')->group(function () {
        Route::get('/dashboard', [BloggerDashboardController::class, 'index'])->name('dashboard');


        // Blogger posts
        Route::resource('posts', BloggerPostController::class);

        // Comments for blogger's posts
        Route::get('/comments', [BloggerCommentController::class, 'index'])->name('comments.index');

        // profile
        Route::get('/profile', [BloggerProfileController::class, 'index'])->name('profile');
    });

    // 🧪 Tester routes
    Route::middleware(['role:tester'])->prefix('tester')->name('tester.')->group(function () {
        Route::get('/dashboard', [TesterDashboardController::class, 'index'])->name('dashboard');
    });

    // 👤 Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

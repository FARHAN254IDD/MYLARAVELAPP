<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\BlogController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/home',[HomeController::class, 'index'] )->name('home');


Route::get('/', function () {
    return view ('welcome');
});



Route::get('/about',[AboutController::class, 'index'] )->name('about');


Route::get('/contact',[ContactController::class, 'index'] )->name('contact');


// Route::get('/blog', function () {
//     $posts = [
//         (object)[ 'id' => 1, 'title' => 'Welcome to Tailwind', 'content' => 'Tailwind CSS is a utility-first framework...', 'images' => 'code.jpg' ],
//         (object)[ 'id' => 2, 'title' => 'Laravel & Tailwind', 'content' => 'Combining Laravel with Tailwind gives great flexibility...', 'images' => 'laravel.jpg' ],
//         (object)[ 'id' => 3, 'title' => 'Modern UI Design', 'content' => 'With Tailwind, you can quickly create responsive interfaces...', 'images' => 'design soft.jpg' ],
//     ];
//     return view('blog', compact('posts'));
// });




Route::get('/blog',[BlogController::class, 'index'] )->name('blog');

// ✅ Add this route to handle single blog pages
Route::get('/blog/{id}',[BlogController::class, 'show'] )->name('blog.show');

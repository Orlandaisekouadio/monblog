<?php

use App\Http\Controllers\Front\CommentController as FrontCommentController;
use App\Http\Controllers\Front\PostController as FrontPostController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use League\CommonMark\Extension\FrontMatter\FrontMatterParser;
use UniSharp\LaravelFilemanager\Lfm;

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

Route::name('home')->get('/', [FrontPostController::class, 'index']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::prefix('laravel-filemanager')->middleware('auth')->group(function () {
    Lfm::routes();
});

Route::prefix('posts')->group(function () {

    Route::name('posts.display')->get('{slug}', [FrontPostController::class, 'show']);
    Route::name('posts.search')->get('', [FrontPostController::class, 'search']);
    Route::name('posts.comments')->get('{post}/comments', [FrontCommentController::class, 'comments']);
});

Route::name('category')->get('category/{category:slug}', [FrontPostController::class, 'category']);

Route::name('author')->get('author/{user}', [FrontPostController::class, 'user']);

Route::name('tag')->get('tag/{tag:slug}', [FrontPostController::class, 'tag']);


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


require __DIR__ . '/auth.php';

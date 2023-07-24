<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PageController;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('auth');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/readArticle/{id}', [PageController::class, 'readArticle']);

Route::get('/addArticlePage', [PageController::class, 'goToAddArticle']);

Route::get('/updateArticlePage/{id}', [PageController::class, 'goToUpdateArticle']);

Route::get("/addCategoryPage", [PageController::class, 'goToAddCategory']);

Route::get('/updateCategoryPage/{id}', [PageController::class, 'goToUpdateCategory']);

// Article CRUD
Route::get('/allArticles', [ArticleController::class, 'index']);

Route::get('/yourArticles', [ArticleController::class, 'yourArticles']);

Route::post('/addArticle', [ArticleController::class, 'addArticle']);

Route::delete('/deleteArticle/{id}', [ArticleController::class, 'deleteArticle']);

Route::post('/updateArticle/{id}', [ArticleController::class, 'updateArticle']);

// Category CRUD
Route::get('/yourCategories', [CategoryController::class, 'yourCategories']);

Route::post('/addCategory', [CategoryController::class, 'addCategory']);

Route::delete('/deleteCategory/{id}', [CategoryController::class, 'deleteCategory']);

Route::post('/updateCategory/{id}', [CategoryController::class, 'updateCategory']);

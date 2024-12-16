<?php

use App\Http\Controllers\AdminJSONController;
use App\Http\Controllers\AuthorBookController;
use App\Http\Controllers\AuthorJSONController;
use App\Http\Controllers\BookAuthorController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PublishersController;
use App\Http\Controllers\TransactionController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

// CRUD for admin
Route::apiResource('AdminList', AdminJSONController::class);


// CRUD for admin
Route::apiResource('Authors' , AuthorJSONController::class);

// CRUD for book

Route::apiResource('Books' , BookController::class);
// CRUD  for category

Route::apiResource('Categories' , CategoryController::class);
// CRUD for publisher

Route::apiResource("Publishers" , PublishersController::class);
// CRUD for transaction

Route::apiResource("Transactions" , TransactionController::class);

// CRUD for book author

Route::apiResource("AuthorBooks" , AuthorBookController::class);

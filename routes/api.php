<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\GenreController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UserController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::controller(AuthorController::class)->group(function () {
    Route::get('/authors', 'get');
    Route::get('/authors/books', 'getWithBooks');//listar autores com seus livros 
    Route::get('/authors/books/{id}', 'findBook');//listar livros de um autor
    Route::get('/authors/{id}', 'details');
    Route::post('/authors', 'store');
    Route::patch('/authors/{id}', 'update');
    Route::delete('/authors/{id}', 'delete');
});

Route::controller(GenreController::class)->group(function () {
    Route::get('/genres', 'get');
    Route::get('/genres/books', 'getWithBooks');//genero com seus livros
    Route::get('/genres/{id}', 'details');
    Route::post('/genres', 'store');
    Route::patch('/genres/{id}', 'update');
    Route::delete('/genres/{id}', 'delete');
    Route::get('/genres/books/{id}', 'findBooks');//livros de um genero
});

Route::controller(BookController::class)->group(function () {
    Route::get('/books', 'get');
    Route::get('/books/genres/authors/reviews','getWithGenreAuthorReviews');//rota adicional de listar livros com review autor e genero
    Route::get('/books/reviews/{id}', 'findReview');//listar reviews de um livro
    Route::get('/books/{id}', 'details');
    Route::post('/books', 'store');
    Route::patch('/books/{id}', 'update');
    Route::delete('/books/{id}', 'delete');
});

Route::controller(ReviewController::class)->group(function () {
    Route::get('/reviews', 'get');
    Route::get('/reviews/{id}', 'details');
    Route::post('/reviews', 'store');
    Route::patch('/reviews/{id}', 'update');
    Route::delete('/reviews/{id}', 'delete');
});

Route::controller(UserController::class)->group(function () {
    Route::get('/users', 'get');
    Route::get('/users/{id}', 'details');
    Route::get('/users/reviews/{id}', 'findReview');
    Route::post('/users', 'store');
    Route::patch('/users/{id}', 'update');
    Route::delete('/users/{id}', 'delete');
});

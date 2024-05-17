<?php

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

Route::get('/users',[\App\Http\Controllers\Api\UserController::class, 'index']);
Route::get('/books',[\App\Http\Controllers\Api\BookController::class, 'index']);
Route::get('/books/{id}',[\App\Http\Controllers\Api\BookController::class, 'show']);
Route::get('/publishers',[\App\Http\Controllers\Api\PublisherController::class, 'index']);
Route::get('/publishers/{id}',[\App\Http\Controllers\Api\PublisherController::class, 'show']);
Route::get('/best-reviews', [\App\Http\Controllers\Api\ReviewsController::class, 'getBestRating']);
Route::get('/reviews/{id}', [\App\Http\Controllers\Api\ReviewsController::class, 'show']);
Route::get('/averange/{id}', [\App\Http\Controllers\Api\ReviewsController::class, 'getAverageRating']);
Route::post('/login',[\App\Http\Controllers\Api\LoginController::class, 'login']);
Route::get('/checkEmail/{email}',[\App\Http\Controllers\Api\UserController::class,'checkEmail']);
Route::post('/register',[\App\Http\Controllers\Api\UserController::class, 'register']);
Route::get('/author/{id}',[\App\Http\Controllers\Api\AuthorController::class, 'show']);
Route::get('/author-user/{id}',[\App\Http\Controllers\Api\AuthorController::class, 'findByUserId']);
Route::get('/publisher/{id}',[\App\Http\Controllers\Api\PublisherController::class, 'show']);
Route::get('/publisher-user/{id}',[\App\Http\Controllers\Api\PublisherController::class, 'findByUserId']);
Route::get('/authorEmail/{email}', [\App\Http\Controllers\Api\AuthorController::class, 'getByEmail']);
Route::get('/userEmail/{email}', [\App\Http\Controllers\Api\UserController::class, 'getByEmail']);
Route::get('/publisherEmail/{email}', [\App\Http\Controllers\Api\PublisherController::class, 'getByEmail']);
Route::get('/book-status/{id}', [\App\Http\Controllers\Api\BookStatusController::class, 'getBookStatusByUser']);
Route::get('/user-list/{id}', [\App\Http\Controllers\Api\UserListController::class, 'getUserListByUser']);
Route::get('/book-list/{id}', [\App\Http\Controllers\Api\BookListController::class, 'getListByUser']);
Route::get('/book-status/{id}/{status}', [\App\Http\Controllers\Api\BookStatusController::class, 'getBookStatusByUserAndStatus']);
Route::get('/user-review/{id_user}/{id_book}', [\App\Http\Controllers\Api\ReviewsController::class, 'showUser']);
Route::put('/book-status-update/{id_book}/{id_user}', [\App\Http\Controllers\Api\BookStatusController::class, 'update']);
Route::put('/book-status-update-state/{id_book}/{id_user}', [\App\Http\Controllers\Api\BookStatusController::class, 'updateStatus']);
Route::get('/books-genre/{genre}',[\App\Http\Controllers\Api\BookController::class, 'booksByGenre']);
Route::get('/books-search/',[\App\Http\Controllers\Api\BookController::class, 'search']);
Route::post('/follow/',[\App\Http\Controllers\Api\FollowsController::class, 'store']);
Route::get('/followers/{id_user}',[\App\Http\Controllers\Api\FollowsController::class, 'show']);
Route::delete('/unfollowPublisher/{id_user}/{id_publisher}',[\App\Http\Controllers\Api\FollowsController::class, 'unfollowPublisher']);
Route::delete('/unfollowAuthor/{id_user}/{id_author}',[\App\Http\Controllers\Api\FollowsController::class, 'unfollowAuthor']);
Route::post('/follow-friend/',[\App\Http\Controllers\Api\FriendsController::class, 'store']);
Route::get('/friends/{id_user}',[\App\Http\Controllers\Api\FriendsController::class, 'show']);
Route::delete('/delete-friend/{id_user}/{id_friend}',[\App\Http\Controllers\Api\FriendsController::class, 'delete']);
Route::post('/user-list/',[\App\Http\Controllers\Api\UserListController::class, 'store']);
Route::post('/user-list-update/{id_user}/{id_list}',[\App\Http\Controllers\Api\UserListController::class, 'update']);
Route::delete('/user-list-delete/{id}',[\App\Http\Controllers\Api\UserListController::class, 'delete']);
Route::post('/book-list-register/', [\App\Http\Controllers\Api\BookListController::class, 'storeBook']);
Route::delete('/book-list-delete/{id_list}/{id_book}', [\App\Http\Controllers\Api\BookListController::class, 'delete']);
Route::get('/user/{id}',[\App\Http\Controllers\Api\UserController::class, 'show']);
Route::post('/review/', [\App\Http\Controllers\Api\ReviewsController::class, 'store']);
Route::put('/review-update/{id}', [\App\Http\Controllers\Api\ReviewsController::class, 'update']);
Route::get('/are-friend/{id_user}/{id_friend}',[\App\Http\Controllers\Api\FriendsController::class, 'areFriends']);
Route::get('/books-author/{id_author}',[\App\Http\Controllers\Api\BookController::class, 'getBookByAuthor']);
Route::get('/books-publisher/{id_publisher}',[\App\Http\Controllers\Api\BookController::class, 'getBookByPubisher']);

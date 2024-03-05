<?php

use App\Http\Controllers\UserController;
use GuzzleHttp\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Middleware\JwtMiddleware;

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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::middleware(JwtMiddleware::class)->group(function() {
    Route::post('auth/logout', [AuthenticationController::class, 'logout']);
    Route::post('auth/refresh', [AuthenticationController::class, 'refresh']);
    Route::post('auth/me', [AuthenticationController::class, 'me']);

    Route::apiResource('/posts', PostController::class, ['only' => 'store'])->parameter('posts', 'id');
    Route::apiResource('/posts', PostController::class, ['only' => ['update', 'destroy']])->parameter('posts', 'id')->middleware('post_owner');

    Route::apiResource('/comments', CommentController::class, ['only' => 'store'])->parameter('comments', 'id');
    Route::apiResource('/comments', CommentController::class, ['only' => ['update', 'destroy']])->parameter('comments', 'id')->middleware('comment_owner');

    Route::apiResource('/users', UserController::class)->parameter('users', 'id');
});
Route::post('auth/register', [AuthenticationController::class, 'register']);
Route::post('auth/login', [AuthenticationController::class, 'login']);

Route::apiResource('/posts', PostController::class, ['only' => ['index', 'show']])->parameter('posts', 'id');

<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\PostController;
use App\Http\Controllers\API\CommentController;
use App\Http\Controllers\API\RolePermissionController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');


Route::post("register", [AuthController::class, "register"])->name("api.register");
Route::post("login", [AuthController::class, "login"]);



Route::middleware(['auth:api'])->group(function() {
    Route::apiResource('/posts', PostController::class);
    Route::post('posts/{post}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::put('comments/{id}', [CommentController::class, 'update']);
    Route::delete('comments/{id}', [CommentController::class, 'destroy']);
    Route::get('/posts/{post}/comments', [CommentController::class, 'index']);
    Route::get('/comments/{id}', [CommentController::class, 'show']);
    Route::get('/my-posts', [PostController::class, 'myPosts']);
    Route::get('/other-posts', [PostController::class, 'otherPosts']);

});



Route::middleware(['auth:api'])->group(function () {
    Route::post('/users/{id}/assign-role', [RolePermissionController::class, 'assignRole']);
    Route::post('/users/{id}/give-permission', [RolePermissionController::class, 'givePermission']);
    Route::post('/users/{id}/revoke-permission', [RolePermissionController::class, 'revokePermission']);
    Route::post('/users/{id}/remove-role', [RolePermissionController::class, 'removeRole']);
});


Route::post('/logout', function(Request $request){
    $token = $request->user()->token();
    $token->revoke();               // revoke current access token
    $token->refreshToken?->revoke();
    return response()->json(['message'=>'Logged out successfully']);
})->middleware('auth:api');




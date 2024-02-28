<?php

use App\Http\Controllers\Dashboard\CategoriesController;
use App\Http\Controllers\Dashboard\ProductsController;
use App\Http\Controllers\Dashboard\ProfileController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware'=>'auth'],function (){

    Route::get('/categories/trash',[CategoriesController::class,'trash'])->name('categories.trashed');
Route::delete('/categories/{id}/force-delete', [CategoriesController::class,'forceDelete'])->name('categories.force-delete');
Route::post('/categories/{id}/restore', [CategoriesController::class,'restore'])->name('categories.restore');

    Route::get('profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('profile', [ProfileController::class, 'update'])->name('profile.update');





//    Route::resource('/categories', CategoriesController::class);
    Route::resources([
        'products' => ProductsController::class,
        'categories' => CategoriesController::class,
//        'roles' => RolesController::class,
//        'users' => UsersController::class,
//        'admins' => AdminsController::class,
    ]);
});






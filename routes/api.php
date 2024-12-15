<?php

use App\Http\Controllers\API\Auth\LoginController;
use App\Http\Controllers\API\Auth\LogoutController;
use App\Http\Controllers\API\Auth\RegisterController;
use App\Http\Controllers\API\CatigoryController;
use App\Http\Controllers\API\TaskController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\GeneralController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::middleware(['guest:sanctum'])
    ->group(function(){
        Route::get('/test',[GeneralController::class,'test']);
        Route::controller(LoginController::class)
            ->group(function(){
                Route::post('/login', 'login')->name('login');
            }
        );
        Route::controller(RegisterController::class)
            ->group(function(){
                Route::post('/register', 'register');
            }
        );
    }
);

Route::middleware(['auth:sanctum'])
    ->group(function(){
        Route::get('/logout', [LogoutController::class,'logout']);
        Route::get('/profile', [UserController::class,'profile']);
        
        Route::controller(TaskController::class)
        ->group(function () {
                Route::patch('/task/completion/{task}','completion');
                Route::get('/task/today','taskToday');
                Route::get('/task/filter/catigory/{catigory_id}','filterCatigory');
                Route::get('/task/filter/completion/{status}','filterCompletion')->name('task.filter.completion');
            }
        );
        Route::resource('task',TaskController::class);

        Route::resource('catigory',CatigoryController::class);
    }
);

<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\CatigoryController;
use App\Http\Controllers\GeneralController;
use App\Http\Controllers\TaskController;
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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::middleware(['guest'])
    ->group(function(){
        Route::controller(LoginController::class)
            ->group(function(){
                Route::get('/', 'index');
                Route::post('/', 'login')->name('login');
            }
        );
        Route::controller(RegisterController::class)
            ->group(function(){
                Route::get('/register', 'index');
                Route::post('/register', 'register')->name('register');
            }
        );
    }
);

Route::middleware(['auth'])
    ->group(function(){
        Route::get('/home', [GeneralController::class,'index'])->name('home');
        Route::get('/logout', LogoutController::class)->name('logout');
        
        Route::controller(TaskController::class)
        ->group(function () {
                Route::patch('/task/completion/{task}','completion')->name('task.completion');
                Route::get('/task/today','taskToday')->name('task.today');
                Route::get('/task/filter/catigory/{catigory_id}','filterCatigory')->name('task.filter.catigory');
                Route::get('/task/filter/completion/{status}','filterCompletion')->name('task.filter.completion');
            }
        );
        Route::resource('task',TaskController::class);

        Route::resource('catigory',CatigoryController::class);
    }
);

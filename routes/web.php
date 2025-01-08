<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\TransactionController;
use App\Repositories\ClientRepository;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});


Route::get('/home',[ClientController::class,'getAllClients']);
Route::get('/client/{id}', [ClientController::class, 'getDataByID']);
Route::delete('/delete/{id}', [ClientController::class, 'deleteDataByID']);
Route::patch('/update', [ClientController::class, 'updateByData']);
Route::post('/create', [ClientController::class, 'createByData']);
Route::post('/insert/transactions', [TransactionController::class, 'insert']);



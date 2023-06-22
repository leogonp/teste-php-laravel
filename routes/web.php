<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Document\DocumentController;

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
    return view('welcome');
});

Route::get('/documents', [DocumentController::class,'index'])->name('documents.index');

Route::get('/documents/send-queue', [DocumentController::class,'sendQueue'])->name('documents.send-queue');


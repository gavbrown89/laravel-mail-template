<?php

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/template/{id}', [App\Http\Controllers\HomeController::class, 'templateIndex'])->name('home.template');
Route::get('/options/{id}', [App\Http\Controllers\HomeController::class, 'optionsIndex'])->name('home.options');
// email template
Route::post('save-template', [App\Http\Controllers\EmailTemplateController::class, 'update'])->name('update.template');
// option values
Route::post('save-option', [App\Http\Controllers\TemplateOptionsController::class, 'create'])->name('create.option');
// send mail
Route::post('send-mail', [App\Http\Controllers\SendMailController::class, 'send'])->name('send.mail');

<?php

use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\AnnouncementResponseController;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ResponseController;
use App\Http\Controllers\ResumeController;
use App\Http\Controllers\MainController;
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


Route::get('login', [CustomAuthController::class, 'index'])->name('login');
Route::post('login', [CustomAuthController::class, 'customLogin'])->name('login.custom');
Route::get('register', [CustomAuthController::class, 'registration'])->name('register');
Route::post('register', [CustomAuthController::class, 'customRegistration'])->name('register.custom');
Route::get('signout', [CustomAuthController::class, 'signOut'])->name('signout');


Route::get('/main', [MainController::class, 'main'])->name('main');
Route::get('/contacts', [MainController::class, 'contact'])->name('contacts.view');
Route::get('/announcements', [AnnouncementController::class, 'get'])->name('announcements.view');



Route::middleware('auth')->group(function () {
    Route::get('/createAnnouncement', [AnnouncementController::class, 'createForm'])->name('createForm.announcement');
    Route::post('/createAnnouncement', [AnnouncementController::class, 'create'])->name('create.announcement');
    Route::get('/announcements/{announcementId}', [AnnouncementController::class, 'show'])->name('announcements.show');

    Route::get('resume', [ResumeController::class, 'createForm'])->name('resume');
    Route::post('resume', [ResumeController::class, 'create'])->name('custom.resume');
    Route::get('my-resume', [ResumeController::class, 'show'])->name('resume.show');
    Route::delete('delete-resume', [ResumeController::class,'delete'])->name('delete.resume');
    Route::get('/resume/{resumeId}', [ResumeController::class , 'showForEmployer'])->name('resume.showResumeToEmployer');
    Route::get('/resume/{resumeId}', [ResumeController::class, 'edit'])->name('edit.resume');
    Route::put('/resume/{resumeId}', [ResumeController::class, 'update'])->name('update.resume');

    Route::post('/messages/send', [MessageController::class, 'send'])->name('messages.send');

    Route::post('/announcements/{announcement}/reply', [AnnouncementResponseController::class , 'response'])->name('announcements.reply');

    Route::get('/responses', [ResponseController::class, 'showAll'])->name('responses.index');
    Route::get('/responses/{responseId}', [ResponseController::class, 'show'])->name('responses.show');
});





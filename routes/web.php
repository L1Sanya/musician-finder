<?php

use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ResponseController;
use App\Http\Controllers\ResumeController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\MailController;
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
Route::get('dashboard', [CustomAuthController::class, 'dashboard'])->name('dashboard');


//Authenticate
Route::get('login', [CustomAuthController::class, 'index'])->name('login');
Route::post('custom-login', [CustomAuthController::class, 'customLogin'])->name('login.custom');
Route::get('register', [CustomAuthController::class, 'registration'])->name('register');
Route::post('custom-registration', [CustomAuthController::class, 'customRegistration'])->name('register.custom');
Route::get('signout', [CustomAuthController::class, 'signOut'])->name('signout');



///main
Route::get('main', [MainController::class, 'main'])->name('main');
Route::get('/contacts', [MainController::class, 'contact'])->name('contacts.view');



///Announcement
Route::get('place-announcement', [AnnouncementController::class, 'placeAnnouncementForm'])->name('place.announcement')->middleware('auth');
Route::post('customAnnouncement', [AnnouncementController::class, 'customAnnouncement'])->name('customAnnouncement')->middleware('auth');
Route::get('view-announcements', [AnnouncementController::class, 'viewAnnouncements'])->name('announcements.view');
Route::get('/announcements/{announcement}', [AnnouncementController::class, 'showAnnouncement'])->name('announcements.show')->middleware('auth');
Route::post('/announcements/{announcement}/reply', [AnnouncementController::class , 'reply'])->name('announcements.reply')->middleware('auth');
Route::get('filter', [AnnouncementController::class, 'filter'])->name('announcements.filter')->middleware('auth');
Route::get('/search', [AnnouncementController::class, 'search'])->name('announcements.search')->middleware('auth');



///Resume
Route::get('resume', [ResumeController::class, 'index'])->name('resume')->middleware('auth');
Route::post('custom-resume', [ResumeController::class, 'customResume'])->name('custom.resume')->middleware('auth');
Route::get('my-resume', [ResumeController::class, 'showResume'])->name('resume.show')->middleware('auth');
Route::delete('delete-resume', [ResumeController::class,'deleteResume'])->name('delete.resume')->middleware('auth');
Route::get('/resume/{resumeId}', [ResumeController::class , 'showResumeForEmployer'])->name('resume.showResumeToEmployer')->middleware('auth');
Route::get('/resume/{id}/edit', [ResumeController::class, 'edit'])->name('edit.resume')->middleware('auth');
Route::put('/resume/{resume}', [ResumeController::class, 'update'])->name('update.resume')->middleware('auth');



///Messages
Route::post('/messages/send', [MessageController::class, 'send'])->name('messages.send')->middleware('auth');



//Responses
Route::get('/responses', [ResponseController::class, 'showAllResponses'])->name('responses.index')->middleware('auth');
Route::get('/responses/{response}', [ResponseController::class, 'show'])->name('responses.show')->middleware('auth');
Route::post('/responses/{responseId}/reject', [ResponseController::class, 'reject'])->name('responses.reject')->middleware('auth');



//Mail
Route::get('send-basic-email',[MailController::class, 'basic_email']);
Route::get('send-html-email',[MailController::class, 'html_email']);
Route::get('send-attachment-email',[MailController::class, 'attachment_email']);



<?php

use App\Http\Controllers\AnnouncementController;
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
Route::get('place-announcement', [AnnouncementController::class, 'placeAnnouncementForm'])->name('place.announcement');
Route::post('customAnnouncement', [AnnouncementController::class, 'customAnnouncement'])->name('customAnnouncement');
Route::get('view-announcements', [AnnouncementController::class, 'viewAnnouncements'])->name('announcements.view');
Route::get('/announcements/{announcement}', [AnnouncementController::class, 'showAnnouncement'])->name('announcements.show');
Route::post('/announcements/{announcement}/reply', [AnnouncementController::class , 'reply'])->name('announcements.reply');
Route::get('filter', [AnnouncementController::class, 'filter'])->name('announcements.filter');



///Resume
Route::get('resume', [ResumeController::class, 'index'])->name('resume');
Route::post('custom-resume', [ResumeController::class, 'customResume'])->name('custom.resume');
Route::get('my-resume', [ResumeController::class, 'showResume'])->name('resume.show');
Route::delete('delete-resume', [ResumeController::class,'deleteResume'])->name('delete.resume');
Route::get('/resume/{resumeId}', [ResumeController::class , 'showResumeForEmployer'])->name('resume.showResumeToEmployer');



///Messages
Route::post('/messages/send', [MessageController::class, 'send'])->name('messages.send');



//Responses
Route::get('/responses', [ResponseController::class, 'showAllResponses'])->name('responses.index');
Route::get('/responses/{response}', [ResponseController::class, 'show'])->name('responses.show');
Route::post('/responses/{responseId}/reject', [ResponseController::class, 'reject'])->name('responses.reject');







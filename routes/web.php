<?php

use App\Http\Controllers\AnnouncementController;
use App\Http\Controllers\CustomAuthController;
use App\Http\Controllers\DialogController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ResponseController;
use App\Http\Controllers\ResumeController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\SkillController;
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

Route::get('login', [CustomAuthController::class, 'index'])->name('login');
Route::post('custom-login', [CustomAuthController::class, 'customLogin'])->name('login.custom');
Route::get('register', [CustomAuthController::class, 'registration'])->name('register');
Route::post('custom-registration', [CustomAuthController::class, 'customRegistration'])->name('register.custom');
Route::get('signout', [CustomAuthController::class, 'signOut'])->name('signout');

Route::get('main', [MainController::class, 'main'])->name('main');

Route::get('place-announcement', [AnnouncementController::class, 'placeAnnouncementForm'])->name('place.announcement');
Route::post('customAnnouncement', [AnnouncementController::class, 'customAnnouncement'])->name('customAnnouncement');

Route::get('skill', [SkillController::class, 'skill'])->name('skill');
Route::post('custom-skill', [SkillController::class, 'create'])->name('skill');

Route::get('view-announcements', [AnnouncementController::class, 'viewAnnouncements'])->name('announcements.view');

Route::get('resume', [ResumeController::class, 'index'])->name('resume');
Route::post('custom-resume', [ResumeController::class, 'customResume'])->name('resume.custom');

Route::get('my-resume', [ResumeController::class, 'showResume'])->name('resume.show');
Route::delete('resume', [ResumeController::class,'deleteResume'])->name('resume.delete');

Route::get('/announcements/{announcement}', [AnnouncementController::class, 'showAnnouncement'])->name('announcements.show');

Route::post('/announcements/{announcement}/reply', [AnnouncementController::class , 'reply'])->name('announcements.reply');

Route::get('dialogs', [MessageController::class, 'show'])->name('dialog.show');

Route::post('messages/send', [MessageController::class, 'send'])->name('messages.send');

Route::get('/responses/{id}', [ResponseController::class, 'check'])->name('responses.check');

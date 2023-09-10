<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AjaxController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SemesterController;
use App\Http\Controllers\ClassRoomController;
use App\Http\Controllers\GuardianceController;
use App\Http\Controllers\MessageTypeController;
use App\Http\Controllers\GuardianceTypeController;
use App\Http\Controllers\AnnouncementController;

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

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::group(['middleware' => ['auth']], function() {

    Route::resource('roles', RoleController::class);

    Route::get('/users/suspend/{id}',[UserController::class,'suspend'])->name('users.suspend');
    Route::get('/users/suspendusers/',[UserController::class,'suspendusers'])->name('users.suspendusers');
    Route::get('/users/activate/{id}',[UserController::class,'activate'])->name('users.activate');
    Route::get('/users/resetpass/{id}',[UserController::class,'resetpass'])->name('users.resetpass');
    Route::get('/users/get-users-by-group/{group_id}', [UserController::class,'getUsersByGroup'])->name('users.getUsersByGroup');
    Route::resource('users', UserController::class);

    Route::get('/students/inactive/{id}',[StudentController::class,'inactive'])->name('students.inactive');
    Route::get('/students/activate/{id}',[StudentController::class,'activate'])->name('students.activate');
    Route::get('/students/add_class_room_view/{id}',[StudentController::class,'addClassRoomView'])->name('students.add_class_room_view');
    Route::post('/students/add_class_room_store/{student}',[StudentController::class,'addClassRoomStore'])->name('students.add_class_room_store');
    Route::resource('students', StudentController::class);

    Route::get('/class_rooms/inactive/{id}',[ClassRoomController::class,'inactive'])->name('class_rooms.inactive');
    Route::get('/class_rooms/activate/{id}',[ClassRoomController::class,'activate'])->name('class_rooms.activate');
    Route::resource('class_rooms', ClassRoomController::class);

    Route::get('/semesters/inactive/{id}',[SemesterController::class,'inactive'])->name('semesters.inactive');
    Route::get('/semesters/activate/{id}',[SemesterController::class,'activate'])->name('semesters.activate');
    Route::resource('semesters', SemesterController::class);

    Route::get('/guardiance_types/inactive/{id}',[GuardianceTypeController::class,'inactive'])->name('guardiance_types.inactive');
    Route::get('/guardiance_types/activate/{id}',[GuardianceTypeController::class,'activate'])->name('guardiance_types.activate');
    Route::resource('guardiance_types', GuardianceTypeController::class);

    Route::get('/message_types/inactive/{id}',[MessageTypeController::class,'inactive'])->name('message_types.inactive');
    Route::get('/message_types/activate/{id}',[MessageTypeController::class,'activate'])->name('message_types.activate');
    Route::resource('message_types', MessageTypeController::class);

    Route::get('/guardiances/inactive/{id}',[GuardianceController::class,'inactive'])->name('guardiances.inactive');
    Route::get('/guardiances/activate/{id}',[GuardianceController::class,'activate'])->name('guardiances.activate');
    Route::get('/guardiances/add_children_view/{id}',[GuardianceController::class,'addChildrenView'])->name('guardiances.add_children_view');
    Route::post('/guardiances/add_children_store/{guardiance}',[GuardianceController::class,'addChildrenStore'])->name('guardiances.add_children_store');
    Route::resource('guardiances', GuardianceController::class);

    Route::get('/groups/inactive/{id}',[GroupController::class,'inactive'])->name('groups.inactive');
    Route::get('/groups/activate/{id}',[GroupController::class,'activate'])->name('groups.activate');
    Route::get('/groups/add_user_view/{id}',[GroupController::class,'addUserView'])->name('groups.add_user_view');
    Route::post('/groups/add_user_store/{group}',[GroupController::class,'addUserStore'])->name('groups.add_user_store');
    Route::resource('groups', GroupController::class);

    Route::resource('announcements', AnnouncementController::class);
});



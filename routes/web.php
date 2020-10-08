<?php

use App\Http\Controllers\AssignmentController;
use App\Http\Controllers\ChallengeController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserController;
use App\Models\User;
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

Route::post('/login', [UserController::class, 'Authenticate']);

Route::post('/update', [UserController::class, 'UpdateUser']);

Route::post('/delete', [UserController::class, 'DeleteUser']);

Route::post('/profile', [UserController::class, 'UpdateProfile']);

Route::get('/detail', [UserController::class, 'DetailUser']);

Route::post('/register', [UserController::class, 'AddUser']);

Route::post('/sendmessage', [MessageController::class, 'SendMessage']);

Route::post('/deletemessage', [MessageController::class, 'DeleteMessage']);

Route::post('/editmessage', [MessageController::class, 'EditMessage']);

Route::post('/addassignment', [AssignmentController::class, 'AddAssignment']);

Route::post('/addreport', [ReportController::class, 'AddReport']);

Route::post('/deleteassignment', [AssignmentController::class, 'DeleteAssignment']);

Route::get('/detailassignments', [AssignmentController::class, 'DetailAssignment']);

Route::post('/changeassignment', [AssignmentController::class, 'ChangeAssignment']);

Route::post('/changereport', [ReportController::class, 'ChangeReport']);

Route::post('/addchallenge', [ChallengeController::class, 'AddChallenge']);

Route::post('/deletechallenge', [ChallengeController::class, 'DeleteChallenge']);

Route::get('/challenges/detail', [ChallengeController::class, 'DetailChallenge']);

Route::post('/challenges/answer', [ChallengeController::class, 'Answer']);

Route::middleware(['auth:sanctum', 'verified'])->get('/', function () {
    $users = User::all();
    return view('home',compact('users'));
});

Route::get('messages', function () {
    $messages = MessageController::GetReceivedMessage();

    return view('messages', compact('messages'));
});

Route::get('assignments', function () {
    $assignments = AssignmentController::GetAllAssignments();
    return view('assignments', compact('assignments'));
});

Route::get('accessdenied', function () {
    return view('includes.accessdenied');
});

Route::get('profile', function () {
    $user = auth()->user();
    return view('profile', compact('user'));
});

Route::get('challenges', function () {
    $challenges = ChallengeController::GetAllChallenge();

    return view('challenges', compact('challenges'));
});




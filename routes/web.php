<?php


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\web\CatController;
use App\Http\Controllers\web\ExamController;
use App\Http\Controllers\web\HomeController;
use App\Http\Controllers\web\LangController;
use App\Http\Controllers\web\SkillController;
use App\Http\Controllers\web\ProfileController;

use App\Http\Controllers\Admin\SkillController as AdminSkillController;
use App\Http\Controllers\Admin\CatController as AdminCatController;
use App\Http\Controllers\Admin\HomeController as AdminHomeController;


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
Route::middleware('lang')->group(function() {
Route::get('/', [HomeController::class,'index']);
Route::get('/category/show/{id}', [CatController::class,'show']);
Route::get('/skills/show/{id}', [SkillController::class,'show']);
Route::get('/exams/show/{id}', [ExamController::class,'show']);
Route::get('/exams/questions/{id}', [ExamController::class,'questions'])->middleware(['auth' , 'verified' , 'student']);
Route::get('/contact' , [ContactController::class, 'index']);
Route::get('/profile' , [ProfileController::class, 'index'])->middleware(['auth' , 'verified' , 'student']);

});

Route::post('/exams/start/{id}', [ExamController::class,'start'])->middleware(['auth' , 'verified' , 'student' , 'can-enter-exam']);
Route::post('/exams/submit/{id}', [ExamController::class,'submit'])->middleware(['auth' , 'verified' , 'student']);

Route::post('/contact/message/send' , [ContactController::class, 'send']);
Route::get('/lang/set/{lang}' , [LangController::class,'set']);


Route::prefix('dashboard')->middleware(['auth', 'verified', 'can-enter-dashboard'])->group(function() {
    Route::get('/', [AdminHomeController::class, 'index']);
    Route::get('/categories', [AdminCatController::class, 'index']);
    Route::POST('/categories/store', [AdminCatController::class, 'store']);
    Route::POST('/categories/update', [AdminCatController::class, 'update']);
    Route::get('/categories/toggle/{cat}', [AdminCatController::class, 'toggle']);
    Route::get('/categories/delete/{cat}', [AdminCatController::class, 'delete']);

    Route::get('/skills', [AdminSkillController::class, 'index']);
    Route::POST('/skills/store', [AdminSkillController::class, 'store']);
    Route::POST('/skills/update', [AdminSkillController::class, 'update']);
    Route::get('/skills/toggle/{skill}', [AdminSkillController::class, 'toggle']);
    Route::get('/skills/delete/{skill}', [AdminSkillController::class, 'delete']);

});


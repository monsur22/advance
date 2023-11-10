<?php

use App\Facades\Invoice;
use App\Facades\InvoiceFacade;
use App\Http\Controllers\JobQueueDemoController;
use App\Livewire\Content\Home;
use Illuminate\Support\Facades\Route;
use App\Livewire\Counter;

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

Route::get('/counter', Counter::class);
Route::get('/home', Home::class);
Route::get('/home', Home::class);
Route::get('/upload',[JobQueueDemoController::class,'index']);
Route::post('/upload',[JobQueueDemoController::class,'upload']);
Route::get('/redis-demo',[JobQueueDemoController::class,'redisget']);

//Custom Facades
Route::get('/facades', function () {
    echo InvoiceFacade::companyName();
});

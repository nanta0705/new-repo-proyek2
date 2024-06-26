<?php

use App\Http\Controllers\admin\ContentController;
use App\Http\Controllers\Admin\DataClientController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LandingController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AppController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\client\ClientBookingController;
use App\Http\Controllers\client\DiagnosaController;
use App\Http\Controllers\DataOwnerController;
use App\Http\Controllers\Owner\KatalogMakeupController;
use App\Http\Controllers\Owner\TypeMakeupController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\TestDiagnosaController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!re
|
*/

Route::get('/', [LandingController::class, 'index']);
Route::get('/login', [LoginController::class, 'index']);
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::resource('/register', RegisterController::class);
Route::post('/myfeature', [DiagnosaController::class, 'sendFile'])->name('upload.file');
Route::get('/testdiagnosa', [TestDiagnosaController::class, 'index']);
Route::get('/run-main', [DiagnosaController::class, 'runMain']);

Route::post('/uploadgambar', function (Request $request) {
    $image = $request->file('file');
    $response = Http::attach(
        'file', file_get_contents($image), $image->getClientOriginalName()
    )->post('http://127.0.0.1:8000/videocapture/');
    // dd($request->all());
    
    return $response->json();
})->name('upload.gambar');

Route::group(['middleware' => ['autentikasi']], function () {

    Route::get('/admin/dashboard', [AppController::class, 'admin']);
    Route::resource('/admin/data_client', DataClientController::class);
    Route::resource('/admin/data_owner', DataOwnerController::class);
    Route::get('/admin/content', [ContentController::class, 'index']);
    Route::get('/admin/content/view/{id}', [ContentController::class, 'show']);
    Route::post('/admin/content/changestatus', [ContentController::class, 'changeStatus']);


    Route::resource('/booking', BookingController::class);

    Route::get('/owner/dashboard', [AppController::class, 'owner']);
    Route::resource('/owner/katalog_makeup', KatalogMakeupController::class);
    Route::resource('/owner/type_makeup', TypeMakeupController::class);
    Route::post('/owner/changeStatus', [BookingController::class, 'changeStatus'])->name('changeStatus');



    Route::get('/client/dashboard', [AppController::class, 'client']);
    Route::get('/client/skindetection', [AppController::class, 'myfeature'])->name('skindetection');
    Route::resource('/client/booking', ClientBookingController::class);




    Route::get('/logout', [LoginController::class, 'logout']);
});

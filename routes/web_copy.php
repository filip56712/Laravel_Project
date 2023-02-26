<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PodstawowyKontroler;

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
/*
Route::get('/', function () {
    return view('welcome');
});
*/
Route::get('/loguj', [PodstawowyKontroler::class,'zmienStanUwierzytelnienia']);
Route::post('/loguj', [PodstawowyKontroler::class,'zologujScr']);
Route::get('/wyloguj', [PodstawowyKontroler::class,'zmienStanUwierzytelnienia']);
Route::get('/', [PodstawowyKontroler::class,'zwrocStroneDomowa']); 
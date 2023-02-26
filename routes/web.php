<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PodstawowyKontroler;
use App\Http\Controllers\UserController;

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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});
*/
Route::get('/', [PodstawowyKontroler::class,'zwrocStroneDomowa']); 
Route::get('/loguj', [PodstawowyKontroler::class,'zmienStanUwierzytelnienia']);
Route::post('/loguj', [PodstawowyKontroler::class,'zologujScr']);
Route::get('/wyloguj', [PodstawowyKontroler::class,'zmienStanUwierzytelnienia']);
Route::get('/oferty', [PodstawowyKontroler::class,'zwrocListeOfert']);
Route::get('/ksiazki', [PodstawowyKontroler::class,'zwrocListeKsiazek']);
Route::get('/oferty/search', [PodstawowyKontroler::class, 'search']);
Route::get('/konto_ekran', [PodstawowyKontroler::class, 'zwrocStroneKonto'])-> middleware('auth');
Route::get('/ustawienia', [PodstawowyKontroler::class, 'zwrocStroneUstawienia'])-> middleware('auth');
Route::get('/zmienHaslo', [PodstawowyKontroler::class, 'zwrocStroneZmianaHasla'])-> middleware('auth');
Route::get('/change-password', [UserController::class, 'changePassword'])->name('changePassword');
Route::post('/change-password', [UserController::class, 'changePasswordSave'])->name('postChangePassword');
Route::get('/mojeOferty', [PodstawowyKontroler::class, 'zwrocMojeOferty'])-> middleware('auth');
Route::get('/mojeSprzedane', [PodstawowyKontroler::class, 'zwrocMojeSprzedane'])-> middleware('auth');
Route::get('/mojeZakupione', [PodstawowyKontroler::class, 'zwrocMojeZakupione'])-> middleware('auth');
Route::get('/oferty/add', [PodstawowyKontroler::class, 'create'])-> middleware('auth');
Route::get('/ksiazka/add', [PodstawowyKontroler::class, 'createKsiazka'])-> middleware('auth');
Route::post('/ksiazka/save', [PodstawowyKontroler::class, 'storeKsiazka'])-> middleware('auth');
Route::post('/oferty/save', [PodstawowyKontroler::class, 'store'])-> middleware('auth');
Route::get('/oferty/edit/{Id}', [PodstawowyKontroler::class, 'edit'])-> middleware('auth');
Route::post('/oferty/update/{Id}', [PodstawowyKontroler::class, 'update'])-> middleware('auth');
Route::get('/oferty/deleteConf/{Id}', [PodstawowyKontroler::class, 'show'])-> middleware('auth');
Route::get('/oferty/wysylka/{Id}', [PodstawowyKontroler::class, 'wyswietlDaneWysylki'])-> middleware('auth');
Route::get('/oferty/kupno/{Id}', [PodstawowyKontroler::class, 'kupno']);
Route::get('/oferty/daneWysylki/{Id}', [PodstawowyKontroler::class, 'createDaneWysylki'])-> middleware('auth');
Route::get('/oferty/sprzedaj/{Id}', [PodstawowyKontroler::class, 'potwierdzSprzedaz'])-> middleware('auth');
Route::post('/oferty/potwierdzSprzedaz/{Id}/save', [PodstawowyKontroler::class, 'confSprzedaz'])-> middleware('auth');
Route::post('/oferty/daneWysylki/{Id}/save', [PodstawowyKontroler::class, 'storeDaneWysylki'])-> middleware('auth');

//zmiana stanu wysylki dla sprzedajacego
Route::get('/oferty/wysylka/zmienStan/{Id}', [PodstawowyKontroler::class, 'zmienStanWysylki'])-> middleware('auth');
Route::post('/oferty/wysylka/zmienStan/save/{Id}', [PodstawowyKontroler::class, 'zapiszStanWysylki'])-> middleware('auth');

//nadawanie danych wysylki if by zapytanie
Route::get('/oferty/wysylka/zmienDane/{Id}', [PodstawowyKontroler::class, 'zmienDaneWysylkiStrona'])-> middleware('auth');
Route::post('/oferty/zmienDaneWysylki/{Id}/save', [PodstawowyKontroler::class, 'zmienDaneWysylki'])-> middleware('auth');

//usuwanie ofert
Route::post('/oferty/delete/{Id}', [PodstawowyKontroler::class, 'destroy'])-> middleware('auth');

Route::get('/oferty/wymiana/{Id}', [PodstawowyKontroler::class, 'potwierdzWymiane'])-> middleware('auth');
Route::post('/oferty/potwierdzWymiane/{Id}/save', [PodstawowyKontroler::class, 'confWymiana'])-> middleware('auth');

Route::get('/kontakt', [PodstawowyKontroler::class, 'pokazKontakt']);
Route::post('/kontakt/wyslij', [PodstawowyKontroler::class, 'wyslijKontakt']);
//Route::redirect('/oferty/oferty', url('/oferty',[], true));

require __DIR__.'/auth.php';

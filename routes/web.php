<?php

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

Route::get("login", "Auth\LoginController@showLoginForm");
Route::post("login", "Auth\LoginController@login")->name("login");
Route::get('/', "umumC@index");

Route::middleware(['auth'])->group(function () {
    Route::get('/home', 'HomeController@index');

    //logout
    Route::post("logout", "Auth\LoginController@logout")->name("logout");
    Route::middleware(['gerbangAkses'])->group(function () {
        //profil
        Route::get('profil', "profilC@index");
        Route::post('profil/ubahnama', "profilC@ubahnama")->name("ubah.nama");
        Route::post('profil/ubahpassword', "profilC@ubahpassword")->name("ubah.password");
        Route::post('profil/ubahgambar', "profilC@ubahgambar")->name("ubah.gambar");

        //kartu
        Route::get("kartu", "kartuC@kartu")->name("kartu");
        Route::post("tambah/ujian", "kartuC@tambahujian")->name("tambah.ujian");
        Route::put("ubah/ujian/{idujian}", "kartuC@ubahujian")->name("ubah.ujian");
        Route::delete("hapus/ujian/{idujian}", "kartuC@hapusujian")->name("hapus.ujian");
        Route::get("kartu/{idujian}", "kartuC@index")->name("cari");
        //kirim AJAX
        Route::post("kartu/{idujian}", "kartuC@kirimurutan")->name("kirim.urutan");
        Route::delete("kartu/{idujian}", "kartuC@hapusurutan")->name("hapus.urutan");
        Route::get("kartu/{idujian}/cetak", "kartuC@cetak")->name("cetak");
        Route::get("cetak/{idujian}/absen", "kartuC@cetakabsen")->name("cetak.absen");
        Route::get("cetak/{idujian}/denah", "kartuC@cetakdenah")->name("cetak.denah");

        //
        Route::resource("soal", "soalC");
        Route::get("kelola/soal/{idujian}", "soalC@kelola")->name("soal");


        //pengaturan
        Route::resource('pengaturan', "pengaturanC");

    });


});



// Route::get('pdf', 'startController@pdf');

// Route::get('siswa/export/', 'startController@export');



// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

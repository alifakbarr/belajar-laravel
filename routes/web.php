<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\SiswaController;
use App\Http\Controllers\UserController;
use App\Models\SiswaModel;

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
Route::get('/',[HomeController::class,'index']);


// Route::get('/', function () {
//     return view('v_home');
// });

// Route::view('/guru','v_guru');
// Route::view('/siswa','v_siswa');
// Route::view('/user','v_user');


// Route::get('/home', function ($nama_siswa ='Irdho') {
//     return view('v_home',['nama_siswa'=>$nama_siswa]);
// });

// Route::view('/about','v_about',[
//     'nama'=>'Irdho',
//     'alamat'=>'<h1>Tulangan</h1>'
// ]);

// // bisa menggunakan . atau /
// Route::view('/admin','admin.v_admin');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// hak akses admin
Route::group(['middleware'=>'admin'],function(){
//4. memberi nama route name dengan guru
Route::get('/guru',[GuruController::class,'index'])->name('guru');
Route::get('/guru/detail/{id_guru}',[GuruController::class,'detail']);
Route::get('/guru/add',[GuruController::class,'add']);
Route::post('/guru/validasi',[GuruController::class,'validasi']);
Route::get('/guru/edit/{id_guru}',[GuruController::class,'edit']);
Route::post('/guru/prosesEdit/{id_guru}',[GuruController::class,'prosesEdit']);
Route::get('/guru/hapus/{id_guru}',[GuruController::class,'hapus']);
Route::get('/guru/print',[GuruController::class,'print']);
Route::get('/guru/printPDF',[GuruController::class,'printPDF']);

Route::get('/siswa',[SiswaController::class,'index'])->name('siswa');
Route::get('/siswa/detail/{id_siswa}',[SiswaController::class,'detail']);
Route::get('/siswa/tambah',[SiswaController::class,'tambah']);
Route::post('/siswa/validasi',[SiswaController::class,'validasiSiswa']);
Route::get('/siswa/edit/{id_siswa}',[SiswaController::class,'edit']);
Route::post('/siswa/prosesEdit/{id_siswa}',[SiswaController::class,'prosesEdit']);
Route::get('/siswa/hapus/{id_siswa}',[SiswaController::class,'hapus']);

Route::get('/user',[UserController::class,'index']);
});

Route::group(['middleware'=>'guru'],function(){
  Route::get('/guru',[GuruController::class,'index'])->name('guru');
  Route::get('/guru/detail/{id_guru}',[GuruController::class,'detail']);
  Route::get('/guru/add',[GuruController::class,'add']);
  Route::post('/guru/validasi',[GuruController::class,'validasi']);
  Route::get('/guru/edit/{id_guru}',[GuruController::class,'edit']);
  Route::post('/guru/prosesEdit/{id_guru}',[GuruController::class,'prosesEdit']);
  Route::get('/guru/hapus/{id_guru}',[GuruController::class,'hapus']);
  Route::get('/guru/print',[GuruController::class,'print']);
  Route::get('/guru/printPDF',[GuruController::class,'printPDF']);
});

Route::group(['middleware'=>'siswa'],function(){
  Route::get('/siswa',[SiswaController::class,'index'])->name('siswa');
  Route::get('/siswa/detail/{id_siswa}',[SiswaController::class,'detail']);
  Route::get('/siswa/tambah',[SiswaController::class,'tambah']);
  Route::post('/siswa/validasi',[SiswaController::class,'validasiSiswa']);
  Route::get('/siswa/edit/{id_siswa}',[SiswaController::class,'edit']);
  Route::post('/siswa/prosesEdit/{id_siswa}',[SiswaController::class,'prosesEdit']);
  Route::get('/siswa/hapus/{id_siswa}',[SiswaController::class,'hapus']);
});

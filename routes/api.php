<?php

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MahasiswaCon; //tambahkan controller
use App\Http\Controllers\JurusanCon; //tambahkan controller
use App\Http\Controllers\BukuCon; //tambahkan controller
use App\Http\Controllers\PinjamCon;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// direct to postman
//url ini
Route::get('/getmahasiswa', [MahasiswaCon::class, 'getM']);
Route::get('/getjurusan', [JurusanCon::class, 'getJ']);
Route::get('/getbuku', [BukuCon::class, 'getB']);
Route::get('/getpeminjaman', [PinjamCon::class, 'getpeminjaman']);

//panggil berdasarkan idnya
Route::get('/getidmahasiswa/{id}', [MahasiswaCon::class, 'getid']);
Route::get('/getidjurusan/{id_jurusan}', [JurusanCon::class, 'getidjurusan']);
Route::get('/getidbuku/{id_buku}', [BukuCon::class, 'getidbuku']);
Route::get('/getpinjam/{id_peminjaman}', [PinjamCon::class, 'getpinjam']);

//menambah data lewat postman
Route::post('/createmahasiswa', [MahasiswaCon::class, 'createmahasiswa']);
Route::post('/createjurusan', [JurusanCon::class, 'createjurusan']);
Route::post('/createbuku', [BukuCon::class, 'createbuku']);
Route::post('/pinjam', [PinjamCon::class, 'pinjam']);

Route::post('/createpeminjaman', [PinjamCon::class, 'createpeminjaman']);

// update 
Route::put('/updatemahasiswa/{id}', [MahasiswaCon::class, 'updatemahasiswa']);
Route::put('/updatejurusan/{id_jurusan}', [JurusanCon::class, 'updatejurusan']);
Route::put('/updatebuku/{id_buku}', [BukuCon::class, 'updatebuku']);
Route::put('/updatepinjam/{id_peminjaman}', [PinjamCon::class, 'updatepinjam']);
Route::put('/kembali/{id_peminjaman}', [PinjamCon::class, 'pengembalian']);


// delete 
Route::delete('deletemahasiswa/{id}', [MahasiswaCon::class, 'deletemahasiswa']);
Route::delete('deletejurusan/{id}', [JurusanCon::class, 'deletejurusan']);
Route::delete('deletebuku/{id}', [BukuCon::class, 'deletebuku']);
Route::delete('deletepinjam/{id_peminjaman}', [PinjamCon::class, 'deletpinjam']);

<?php

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

// Route::get('/index', '@index')->name('index');
Route::get('/login', 'AuthController@login')->name('login');
Route::post('/postlogin', 'AuthController@postlogin');
Route::get('/logout', 'AuthController@logout');

//Route untuk user Admin
Route::group(['middleware' => ['auth', 'checkRole:admin']], function () {
    Route::get('/siswa/index', 'SiswaController@index')->name('siswa');
  
  
    // Route::get('/laporanpendaftaran/index', 'SiswaController@indexxxx')->name('laporanpendaftaran');
    // Route::get('/laporanpendaftaran/export_excel', 'SiswaController@export_excelll');
    // Route::get('/siswa/create', 'SiswaController@create');
    // Route::get('/siswa/{id}/show', 'SiswaController@show');
    // Route::post('/siswa/store', 'SiswaController@store');
    // Route::get('/siswa/{id}/edit', 'SiswaController@edit');
    // Route::post('/siswa/{id}/update', 'SiswaController@update');
    // Route::get('/siswa/{id}/delete', 'SiswaController@delete');
   
    Route::get('/barang/index', 'BarangController@index')->name('barang');
    Route::get('/barang/create', 'BarangController@create');
    Route::post('/barang/store', 'BarangController@store');
    Route::post('/barang/tambah', 'BarangController@tambah');
    Route::get('/barang/{id}/edit', 'BarangController@edit');
    Route::post('/barang/{id}/update', 'BarangController@update');   
    Route::Delete('/barang/{id}/destroy', 'BarangController@destroy')->name('posts.destroy');

      //Route untuk instansi dan pengguna contoller
      Route::resource('/instansi', 'InstansiController');
      Route::resource('/pengguna', 'PenggunaController');
    
});

//Route untuk user Petugas Administrasi Keuangan dan Admin
Route::group(['middleware' => ['auth', 'checkRole:admin,suplier']], function () {

    Route::get('/barang/index', 'BarangController@index')->name('barang');
    Route::get('/barang/create', 'BarangController@create');
    Route::post('/barang/store', 'BarangController@store');
    Route::post('/barang/tambah', 'BarangController@tambah')->name('barang.tagihan.tambah');
    Route::get('/barang/{id}/edit', 'BarangController@edit');
    Route::post('/barang/{id}/update', 'BarangController@update');
    Route::delete('/barang/{id}/delete', 'BarangController@delete');
    Route::post('/barang/filter', 'BarangController@filter');
    Route::get('/barang/{filter}/print', 'BarangController@print');

 
});

//Route untuk user siswa
Route::group(['middleware' => ['auth', 'checkRole:costumer']], function () {
    Route::get('/{id}/siswadashboard', 'DashboardController@siswadashboard');
    Route::get('/tabungan/setor/{id}/siswaindex', 'SetorController@siswaindex');
    Route::get('/tabungan/tarik/{id}/siswaindex', 'TarikController@siswaindex');
    Route::get('/pembayaran/transaksipembayaran/{id}/siswaindex', 'TransaksiPembayaranController@siswaindex');
});

//Route untuk user Admin, Petugas Administrasi Surat dan Petugas Administrasi Keuangan
Route::group(['middleware' => ['auth', 'checkRole:admin,PetugasAdministrasiKeuangan,PetugasAdministrasiSurat']], function () {
    Route::get('/', function () {
        return view('/dashboard');
    });

    Route::get('/dashboard', 'DashboardController@index');
    Route::get('/dashboardd', 'DashboardController@indexx');

    Route::get('/pengumuman/index', 'PengumumanController@index');
    Route::post('/pengumuman/tambah', 'PengumumanController@tambah');
});

//Route untuk user Admin, Petugas Administrasi Surat, Petugas Administrasi Keuangan dan Siswa
Route::group(['middleware' => ['auth', 'checkRole:admin,PetugasAdministrasiKeuangan,PetugasAdministrasiSurat,Siswa']], function () {
    Route::get('/auths/{id}/gantipassword', 'AuthController@gantipassword');
    Route::post('/auths/{id}/simpanpassword', 'AuthController@simpanpassword');
});

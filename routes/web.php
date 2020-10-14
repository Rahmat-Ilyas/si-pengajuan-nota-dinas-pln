<?php

// Pegawai
//auth
Route::get('/login', 'Auth\LoginPegawai@showLoginForm')->name('pegawai.login');
Route::post('/login', 'Auth\LoginPegawai@login')->name('pegawai.login.submit');
Route::post('/logout', 'Auth\LoginPegawai@logout')->name('pegawai.logout');

Route::get('/', 'PegawaiController@index');
Route::get('/pegawai', 'PegawaiController@index')->name('pegawai.home');
Route::get('/datakeluarga', 'PegawaiController@datakeluarga');
Route::get('/datakeluarga/{val}', 'PegawaiController@datakeluarga');
Route::post('/datakeluarga/store', 'PegawaiController@storedatakeluarga')->name('storedatakeluarga');
Route::post('/datakeluarga/edit', 'PegawaiController@editdatakeluarga')->name('editdatakeluarga');
Route::get('/datakeluarga/hapus/{id}', 'PegawaiController@hapusdatakeluarga');
Route::get('/layanan', 'PegawaiController@layanan');
Route::get('/layanan/{val}/{id}', 'PegawaiController@layanan');
Route::post('/layanan/store', 'PegawaiController@storepengajuan')->name('storepengajuan');
Route::get('/progres', 'PegawaiController@progres');

//Admin SDM
Route::group(['prefix' => 'admin'], function () {
    //auth
    Route::get('/login', 'Auth\LoginAdmin@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\LoginAdmin@login')->name('admin.login.submit');
    Route::post('/logout', 'Auth\LoginAdmin@logout')->name('admin.logout');

    Route::get('/', 'AdminController@index')->name('admin.home');
    Route::get('/suratmasuk', 'AdminController@suratmasuk');
    Route::get('/suratkeluar', 'AdminController@suratkeluar');
    Route::get('/datapegawai', 'AdminController@datapegawai');
    Route::get('/datapegawai/{val}', 'AdminController@datapegawai');
    Route::post('/datapegawai/store', 'AdminController@storedatapegawai')->name('storedatapegawai');
    Route::post('/datapegawai/edit', 'AdminController@editdatapegawai')->name('editdatapegawai');
    Route::get('/datapegawai/hapus/{id}', 'AdminController@hapusdatapegawai');
    Route::get('/datayakes', 'AdminController@datayakes');
    Route::get('/datayakes/{val}', 'AdminController@datayakes');
    Route::post('/datayakes/store', 'AdminController@storedatayakes')->name('storedatayakes');
    Route::post('/datayakes/edit', 'AdminController@editdatayakes')->name('editdatayakes');
    Route::get('/datayakes/hapus/{id}', 'AdminController@hapusdatayakes');
    Route::get('/notadinaspegawai/{id}', 'AdminController@notadinaspegawai');
    Route::get('/notadinasyakes/{id}', 'AdminController@notadinasyakes');
    Route::post('/buatnota/store', 'AdminController@storenotadinas')->name('storenotadinas');
});

// Yakes
Route::group(['prefix' => 'yakes'], function () {
    //auth
    Route::get('/login', 'Auth\LoginYakes@showLoginForm')->name('yakes.login');
    Route::post('/login', 'Auth\LoginYakes@login')->name('yakes.login.submit');
    Route::post('/logout', 'Auth\LoginYakes@logout')->name('yakes.logout');

    Route::get('/', 'YakesController@index')->name('yakes.home');
    Route::get('/pengajuannota', 'YakesController@pengajuannota');
    Route::post('/getkeluarga', 'YakesController@getkeluarga');
    Route::post('/pengajuannota/store', 'YakesController@storepengajuannota')->name('storepengajuannota');
    Route::get('/datapasien', 'YakesController@datapasien');
    Route::get('/progresnota', 'YakesController@progresnota');
    Route::get('/datadokter/', 'YakesController@datadokter');
    Route::get('/datadokter/{val}', 'YakesController@datadokter');
    Route::post('/datadokter/store', 'YakesController@storedatadokter')->name('storedatadokter');
    Route::post('/datadokter/edit', 'YakesController@editdatadokter')->name('editdatadokter');
    Route::get('/datadokter/hapus/{id}', 'YakesController@hapusdatadokter');
});

// Keuangan
Route::group(['prefix' => 'keuangan'], function () {
    //auth
    Route::get('/login', 'Auth\LoginKeuangan@showLoginForm')->name('keuangan.login');
    Route::post('/login', 'Auth\LoginKeuangan@login')->name('keuangan.login.submit');
    Route::post('/logout', 'Auth\LoginKeuangan@logout')->name('keuangan.logout');

    Route::get('/', 'KeuanganController@index')->name('keuangan.home');
    Route::get('/notadiajukan', 'KeuanganController@notadiajukan');
    Route::get('/notadinas/{val}/{id}', 'KeuanganController@prosesnota');
    Route::get('/datanota/notadisetujui', 'KeuanganController@notadisetujui');
    Route::get('/datanota/notaditolak', 'KeuanganController@notaditolak');
});

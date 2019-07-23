<?php
/*
|--------------------------------------------------------------------------
| Web Routes TANJA | Badan Pemeriksa Keuangan
|--------------------------------------------------------------------------
*/
Route::get('/', function () { //Localhost master default link
    return view('satubpkhome');
});
Auth::routes();
Route::get('/home', 'C_Event@TanjaHome')->name('tanjahome');
//route admin
Route::get('/homeadmin', 'C_Event@admin_event');
//route user
Route::get('/homeuser', 'C_Event@user_event');
Route::resource('tanja','C_Event',[
    'only' => ['store','show']
    ]);
//==test case==//
Route::get('/session/tampil','C_Event@tampilkanSession');
Route::get('/session/hapus','C_Event@hapusSession');
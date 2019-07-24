<?php
/*
|--------------------------------------------------------------------------
| Web Routes TANJA | Badan Pemeriksa Keuangan
|--------------------------------------------------------------------------
*/
//=====================Route Admin====================\\
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
    'only' => ['store','update']
    ]);
//route speaker in Event
Route::post('/speaker','C_Event@speaker_Add');
Route::get('/delete_speaker/{id}','C_Event@speaker_delete');

//=====================Route User=======================\\
Route::resource('tanja','C_Question',[
    'only'=> ['store','destroy','update']
    ]);

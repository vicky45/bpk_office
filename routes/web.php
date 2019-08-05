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
Route::get('/home', 'C_Event@home')->name('home');

//route admin
Route::get('/homeadmin', 'C_Event@admin_event');
//route user
Route::get('/homeuser', 'C_Event@user_event');

//Resource event
Route::resource('event', 'C_Event', [
    'only' => ['create', 'store', 'update', 'show']
]);
Route::get('/out', 'C_Event@Out_Event');
Route::post('/speaker', 'C_Event@speaker_Add');
Route::get('/delete_speaker/{id}', 'C_Event@speaker_delete');

//resource question
Route::resource('question', 'C_Question', [
    'only' => ['store', 'show', 'update', 'destroy']
]);
Route::get('/validate/{id}', 'C_Question@Show_validate');
Route::get('/approve/{id}', 'C_Question@Approve');


//resource Polling
Route::resource('polling', 'C_Polling', [
    'only' => ['store', 'show']
]);
Route::get('/show/{id}', 'C_Polling@approve_polling');
Route::get('/delete/{id}', 'C_Polling@delete_polling');
Route::get('/stop/{id}', 'C_Polling@stop_polling');

Route::get('/session/tampil', 'C_Event@tampilkanSession');
Route::get('/session/buat', 'C_Event@buatSession');
Route::get('/session/hapus', 'C_Event@hapusSession');

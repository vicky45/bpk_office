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
Route::get('/home','C_Event@home')->name('home');

//route admin
Route::get('/homeadmin', 'C_Event@admin_event');
//route user
Route::get('/homeuser', 'C_Event@user_event');

//Resource event
Route::resource('event', 'C_Event', [
    'only' => ['store','update']
]);
Route::get('/out','C_Event@Out_Event');
Route::post('/speaker', 'C_Event@speaker_Add');
Route::get('/delete_speaker/{id}', 'C_Event@speaker_delete');

//resource question
Route::resource('question', 'C_Question', [
    'only' => ['store', 'show' , 'update']
]);
Route::get('/validate/{id}','C_Question@Show_validate');
Route::get('/approve/{id}','C_Question@Approve');
Route::get('/delete/{id}','C_Question@delete');

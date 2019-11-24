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
    'only' => ['store', 'show', 'update']
]);
Route::get('/remove/{id}', 'C_Question@delete'); //Delete question (not approve)
Route::get('/remove_ans/{id}', 'C_Question@remove_answer'); //Delete answer (by admin)
Route::get('/validate/{id}', 'C_Question@Show_validate'); //Javascript auto refresh
Route::get('/approve/{id}', 'C_Question@Approve');
Route::get('/approveall/{id}', 'C_Question@Approve_all');
Route::get('/like/{id}', 'C_Question@like');
Route::get('/dislike/{id}', 'C_Question@dislike');

//resource Polling
Route::resource('polling', 'C_Polling', [
    'only' => ['store', 'show']
]);
Route::get('/showpoll/{id}', 'C_Polling@show_user'); //for user
Route::get('/show/{id}', 'C_Polling@approve_polling'); //for admin
Route::get('/delete/{id}', 'C_Polling@delete_polling');
Route::get('/stop/{id}', 'C_Polling@stop_polling');
Route::get('/submit/{id}', 'C_Polling@submitPolling');

//Route Summary Download (Comming Soon)
Route::get('/download/{id}', 'C_Event@Downloadsummary');

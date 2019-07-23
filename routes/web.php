<?php
use Illuminate\Support\Str;

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

Route::get('/', function () { //Localhost master default link
    return view('HomeGuest');
});


Auth ::routes();
Route::get('/sitanyahome','C_Event@SitanyaPage')->name('sitanyahome');

//route admin
Route::get('/homeadmin', 'C_Event@admin_event');
//route user
Route::get('/homeuser', 'C_Event@user_event');


//route create
Route::post('/create','C_Event@create_event');//created_user
//route join
Route::post('/join','C_Event@join_event');//user used or created_user
//route switch event
Route::get('/switch_event','C_Event@switch_event');

//update event
Route::post('/update','C_Event@update_event');

Route::get('/session/tampil','C_Event@tampilkanSession');
Route::get('/session/buat','C_Event@buatSession');
Route::get('/session/hapus','C_Event@hapusSession');

//add speaker
Route::post('/add_speaker','C_Question@speaker_add');
//delete speaker
Route::get('/delete_speaker/{id}','C_Question@speaker_delete');
//ask question
Route::post('/ask','C_Question@ask');

Route::get('/cekapi','C_Event@cekapi');

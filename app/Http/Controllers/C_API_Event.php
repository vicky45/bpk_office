<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use App\EventModel;

class C_API_Event extends Controller {

    public function create() {
        //Not Used
    }

    public function show($id) {
        //Not Used
    }

    public function edit($id) {
        //Not Used
    }

    public function destroy($id) {
        //Not Used
    }

    public function index() {//Show Event Active
        $Event_active = EventModel::all();
        return $Event_active;
    }

    public function store(Request $request) {//Create Event
        $code = Str::random(6);
        $this->validate($request, [
            'event' => 'required',
            'location' => 'required',
            'date' => 'required',
            'time' => 'required',
        ]);
        $EventModel = EventModel::create([
                    'code_event' => $code,
                    'name_event' => $request->event,
                    'date_event' => $request->date,
                    'time_event' => $request->time,
                    'status_event' => 1,
                    'location' => $request->location
        ]);
        return "Success";
    }

    public function update(Request $request, $id) {
        $EventModel = EventModel::find($id);
        $EventModel->code_event = $request->code;
        $EventModel->name_event = $request->event;
        $EventModel->location = $request->location;
        $EventModel->date_event = $request->date;
        $EventModel->time_event = $request->time;
        $EventModel->save();
        return "Success";
    }
}
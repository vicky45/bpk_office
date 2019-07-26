<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\EventModel;
use App\AdminModel;
use App\Join_EventModel;
use App\SpeakerModel;
use App\QuestionModel;
use Auth;
use Illuminate\Support\Str;

class C_Event extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function home() {
        return view('tanjahome');
    }

    public function create() {//create some page create
        //Not Use
    }

    public function destroy($id) {//hapusSpeaker
        //Not Use    
    }

    public function edit($id) {//update data berdasar
        //Not Use
    }

    public function store(Request $request) {//store data code admin or user
        $idEvent = null;
        $idadmin = null;
        $code_event = null;
        $username = Auth::user()->name;
        $usernip = Auth::user()->NIP;
        $code = $request->join;
        $status = 0;
        //log in with create event
        if (False) {
            $codeevent = Str::random(6);
            $this->validate($request, [
                'event' => 'required',
                'location' => 'required',
                'date' => 'required',
                'time' => 'required',
            ]);
            $EventModel = EventModel::create([
                        'code_event' => $codeevent,
                        'name_event' => $request->event,
                        'date_event' => $request->date,
                        'time_event' => $request->time,
                        'status_event' => 1,
                        'location' => $request->location
            ]);
            $Admin = AdminModel::create([
                        'Name_Admin' => $user
            ]);
            if ($EventModel->exists) {
                $request->session()->forget('event');
                $request->session()->put('event', $codeevent);
                return redirect('/homeadmin');
            } else {
                return redirect()->back()->with(['warning' => 'Create Event Failed!']);
            }
        } else {
            //log in with code
            $event = EventModel :: where('code_event', '=', $code)->get();
            foreach ($event as $ev) {
                $code_event = $ev->code_event;
                $idEvent = $ev->idEvent;
                $status = $ev->status_event;
            }
            if ($code === $code_event) {
                $request->session()->forget('event');
                $join = Join_EventModel :: where('User_NIP', $usernip)
                        ->where('Event_idEvent', $idEvent)
                        ->get();
                foreach ($join as $jo) {
                    $idadmin = $jo->Admin_idAdmin;
                }
                if ($idadmin > 0) {
                    $request->session()->put('event', $idEvent);
                    $Upstatus = EventModel::find($idEvent);
                    $Upstatus->status_event = 1;
                    $Upstatus->save();
                    return redirect('/homeadmin');
                } else {
                    if ($status == 1) {
                        $request->session()->put('event', $idEvent);
                        return redirect('/homeuser');
                    } else {
                        return redirect()->back()->with(['warning' => 'Event Not Active!']);
                    }
                }
            } else {
                return redirect()->back()->with(['warning' => 'Code Not Registered!']);
            }
        }
    }

    //    =====================Speaker Function==========================
    public function speaker_add(Request $request) {
        $event = EventModel :: where('code_event', '=', $request->session()->get('event'))->get();
        foreach ($event as $ev) {
            $idEvent = $ev->idEvent;
        }
        SpeakerModel::create([
            'Event_idEvent' => $idEvent,
            'name_speaker' => $request->speaker,
        ]);
        return redirect()->back()->with(['success' => 'Speaker Succes Added!']);
    }

    public function speaker_delete($id) {
        $speak = SpeakerModel::find($id);
        $speak->delete();
        return redirect()->back()->with(['success' => 'Speaker Succes Deleted!']);
    }

    public function user_event(request $request) {// /homeuser
        $idev = null;
        $nip = null;
        if ($request->session()->has('event')) {
            $join = Join_EventModel :: where('User_NIP', Auth::user()->NIP)
                    ->where('Event_idEvent', $request->session()->get('event'))
                    ->get();
            foreach ($join as $jo) {
                $idev = $jo->Event_idEvent;
                $nip = $jo->User_NIP;
            }
            if ($idev === $request->session()->get('event') && $nip === Auth::user()->NIP) {
                return "user Old";
            } else {
                Join_EventModel::create([
                    'Event_idEvent' => $request->session()->get('event'),
                    'Admin_idAdmin' => 0,
                    'User_NIP' => Auth::user()->NIP
                ]);
                return "user New";
            }
        } else {
            return redirect('/home')->with(['warning' => 'Input code and Join Required!']);
        }
    }

    public function admin_event(request $request) {// /homeadmin
        $idev = null;
        $nip = null;
        if ($request->session()->has('event')) {
            $join = Join_EventModel :: where('User_NIP', Auth::user()->NIP)
                    ->where('Event_idEvent', $request->session()->get('event'))
                    ->get();
            foreach ($join as $jo) {
                $idev = $jo->Event_idEvent;
                $nip = $jo->User_NIP;
            }
            if ($idev === $request->session()->get('event') && $nip === Auth::user()->NIP) {
                return "admin Old";
            } else {
                AdminModel::create([
                    'Name_Admin' => Auth::user()->name
                ]);
                $floor = AdminModel::where('Name_Admin', Auth::user()->name)->get();
                foreach ($floor as $ad) {
                    $idAdmin = $ad->idAdmin;
                }
                Join_EventModel::create([
                    'Event_idEvent' => $request->session()->get('event'),
                    'Admin_idAdmin' => $idAdmin,
                    'User_NIP' => Auth::user()->NIP
                ]);
                return "admin New";
            }
        } else {
            return redirect('/home')->with(['warning' => 'Input code and Join Required!']);
        }
    }

    public function update(Request $request, $id) {//update berdasar
        // update data pegawai
        $EventModel = EventModel::find($id);
        $EventModel->code_event = $request->code;
        $EventModel->name_event = $request->event;
        $EventModel->location = $request->location;
        $EventModel->date_event = $request->date;
        $EventModel->time_event = $request->time;
        $EventModel->save();
        if ($EventModel->exists) {
            $request->session()->forget('event');
            $request->session()->put('event', $request->code);
            return redirect()->back()->with(['success' => 'Update Event Completed!']);
        }
        return redirect()->back()->with(['error' => 'Update Event Failed!Try Again!']);
    }

    public function show(Request $request, $codeevent) {  //summary  
    }

    /** ===============================================================================================* */
}

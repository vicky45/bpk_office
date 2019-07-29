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

    public function show(Request $request, $id) {
        //Note Use
    }

    public function create() {//create some page create
        //Not Use
    }

    public function destroy($id) {//hapus
        //Not Use
    }

    public function edit($id) {//update data berdasar
        //Not Use
    }

    public function store(Request $request) {//store data code admin or user
        $idEvent = null;
        $idadmin = null;
        $code_event = null;
        $session = null;
        $username = Auth::user()->name;
        $usernip = Auth::user()->NIP;
        $code = $request->join;
        $status = 0;
        //log in with create event
        if ($code === null) {
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
                        'Name_Admin' => $username
            ]);
            if ($EventModel->exists) {
                $request->session()->forget('event');
                $Event = EventModel::where('code_event', $codeevent)->get();
                foreach ($Event as $id) {
                    $session = $id->idEvent;
                }
                $request->session()->put('event', $session);
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

    public function user_event(request $request) {// /homeuser
        $tmp = null;
        if ($request->session()->has('event')) {
            $event = EventModel::where('idEvent', $request->session()->get('event'))
                    ->get();
            $join = Join_EventModel :: where('Event_idEvent', $request->session()->get('event'))
                    ->where('User_NIP', Auth::user()->NIP)
                    ->count();
            $questme = Questionmodel::where('Event_idEvent', $request->session()->get('event'))
                    ->where('User_NIP', Auth::user()->NIP)
                    ->get();

            $questall = Questionmodel::where('Event_idEvent', $request->session()->get('event'))
                    ->where('status', 1)
                    ->get();

            foreach ($event as $ev) {
                $tmp = $ev->status_event;
            }
            if ($tmp === 0) {
                return redirect('/home')->with(['warning' => 'Event has Ended!']);
            } else {
                if ($join < 1) {
                    Join_EventModel::create([
                        'Event_idEvent' => $request->session()->get('event'),
                        'User_NIP' => Auth::user()->NIP
                    ]);
                    return view('homeuser', compact('event', 'questme', 'questall'));
                } else {
                    return view('homeuser', compact('event', 'questme', 'questall'));
                }
            }
        } else {
            return redirect('/home')->with(['warning' => 'Input code and Join Required!']);
        }
    }

    public function admin_event(request $request) {// /homeadmin
        if ($request->session()->has('event')) {
            $event = EventModel::where('idEvent', $request->session()->get('event'))
                    ->get();
            $join = Join_EventModel :: where('Event_idEvent', $request->session()->get('event'))
                    ->where('User_NIP', Auth::user()->NIP)
                    ->count();
            $question_validate = QuestionModel::where('Event_idEvent', $request->session()->get('event'))
                    ->where('status', 0)
                    ->get();
            $question_approve = QuestionModel::where('Event_idEvent', $request->session()->get('event'))
                    ->where('status', 1)
                    ->get();
            if ($join < 1) {
                $floor = AdminModel::where('Name_Admin', Auth::user()->name)->get();
                foreach ($floor as $ad) {
                    $idAdmin = $ad->idAdmin;
                }
                Join_EventModel::create([
                    'Event_idEvent' => $request->session()->get('event'),
                    'Admin_idAdmin' => $idAdmin,
                    'User_NIP' => Auth::user()->NIP
                ]);
                return view('homeadmin', compact('event', 'question_validate', 'question_approve'));
            } else {
                return view('homeadmin', compact('event', 'question_validate', 'question_approve'));
            }
        } else {
            return redirect('/home')->with(['warning' => 'Input code and Join Required!']);
        }
    }

    public function update(Request $request, $id) {//update berdasar
        $EventModel = EventModel::find($id);
        $EventModel->code_event = $request->code;
        $EventModel->name_event = $request->event;
        $EventModel->location = $request->location;
        $EventModel->date_event = $request->date;
        $EventModel->time_event = $request->time;
        $EventModel->save();
        if ($EventModel->exists) {
            return redirect()->back()->with(['success' => 'Update Event Completed!']);
        }
        return redirect()->back()->with(['error' => 'Update Event Failed!Try Again!']);
    }

    //    =====================Speaker Function==========================
    public function speaker_add(Request $request) {
        SpeakerModel::create([
            'Event_idEvent' => $request->session()->get('event'),
            'name_speaker' => $request->speaker
        ]);
        return redirect()->back()->with(['success' => 'Speaker Succes Added!']);
    }

    public function speaker_delete($id) {
        $speak = SpeakerModel::find($id);
        $speak->delete();
        return redirect()->back()->with(['success' => 'Speaker Succes Deleted!']);
    }

    /** ==============================Out Event===================================* */
    public function Out_Event(Request $request) {
        $tmpadmin = 0;
        $join = Join_EventModel :: where('User_NIP', Auth::user()->NIP)
                ->where('Event_idEvent', $request->session()->get('event'))
                ->get();
        foreach ($join as $tmp) {
            $tmpadmin = $tmp->Admin_idAdmin;
        }
        if ($tmpadmin > 0) {
            $EventModel = EventModel::find($request->session()->get('event'));
            $EventModel->status_event = 0;
            $EventModel->save();
            $request->session()->forget('event');
            return redirect()->action('C_Event@home');
        } else {
            $request->session()->forget('event');
            return redirect()->action('C_Event@home');
        }
    }

}

<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

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

    public function tanjahome() {
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
        $user = Auth::user()->name;
        $code = $request->join;
        $status = 1;
        if ($code === null):
            //Button Create Event
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
                        'status_event' => $status,
                        'location' => $request->location
            ]);
            $Admin = AdminModel::create([
                        'Name_Admin' => $user
            ]);
            $event = EventModel :: where('code_event', '=', $code)->get();
            foreach ($event as $id) {
                $idEvent = $id->idEvent;
            }
            $Admin = AdminModel::where('Name_Admin', '=', $user) - get();
            foreach ($Admin as $id) {
                $idAdmin = $id->idAdmin;
            }
            $Join = Join_EventModel::create([
                        'Event_idEvent' => $idEvent,
                        'Admin_idAdmin' => $idAdmin,
                        'User_NIP' => Auth::user()->NIP
            ]);
            if ($EventModel->exists):
                $request->session()->forget('event');
                $request->session()->put('event', $codeevent);
                return redirect('/homeadmin');
            else:
                return redirect()->back()->with(['warning' => 'Create Event Failed!']);
            endif;
        else:
            //button join event
            $event = EventModel :: where('code_event', '=', $code)->get();
            $join = Join_EventModel::where('User_NIP', '=', Auth::user()->NIP) - get();
            if ($event != null) :
                $request->session()->forget('event');
                foreach ($join as $tmp) {//get data
                    //inisialisasi data
                    $Event_idEvent = $tmp->Event_idEvent;
                    $Admin_idAdmin = $tmp->Admin_idAdmin;
                }
//                seleksi admin
                if ($Admin_idAdmin > 0):
                    $EventModel = EventModel::find($Event_idEvent);
                    $EventModel->status_event = $status;
                    $EventModel->save();
                    $request->session()->put('event', $code);
                    return redirect('/homeadmin');
                else:
                    $request->session()->put('event', $code);
                    return redirect('/homeuser');
                endif;

            endif;
            return redirect()->back()->with(['warning' => 'Code Tidak Terdaftar!']);
        endif;
    }

    //    =====================Speaker Function==========================
    public function speaker_add(Request $request) {
        $event = EventModel :: where('code_event', '=', $request->session()->get('event'))->get();
        foreach ($event as $ev) {
            $idEvent = $ev->idEvent;
        }
        SpeakerModel::create([
            'idEvent' => $idEvent,
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
        $nip = null;
        $idEv = null;
        if ($request->session()->has('event')):
            //cek idEevent di table Event
            $event = EventModel :: where('code_event', '=', $request->session()->get('event'))->get();
            foreach ($event as $ev) {
                $idEvent = $ev->idEvent;
            }
            //get nip
            $cek = Join_EventModel:: where('NIP', '=', Auth::user()->NIP)->get();
            $question = QuestionModel::where('status', '=', '1');
            //seleksi
            //cek nip
            foreach ($cek as $ev) {
                $idEv = $ev->idEvent;
                $nip = $ev->NIP;
            }
            if ($nip === Auth::user()->NIP && $idEvent === $idEv) :
                return view('homeuser', ['event' => $event], ['question' => $question]);
            else:
                Join_EventModel::create([
                    'idEvent' => $idEvent,
                    'NIP' => Auth::user()->NIP
                ]);
                return view('homeuser', ['event' => $event]);
            endif;
        endif;
        return redirect('/home')->with(['warning' => 'Input code and Join Required!']);
    }

    public function admin_event(request $request) {// /homeadmin
        $domainA = Auth::user()->NIP;
        $domainB = Auth::user()->name;
        $nip = null;
        $idEv = null;
        if ($request->session()->has('event')) :
            //cek idEevent di table Event
            $event = EventModel :: where('code_event', '=', $request->session()->get('event'))->get();
            foreach ($event as $ev) {
                $idEvent = $ev->idEvent;
                $user = $ev->user_created;
            }
            if ($domainB === $user) :
                $cek = Join_EventModel :: where('NIP', '=', $domainA)->get();
                if ($cek != null) :
                    //cek nip
                    foreach ($cek as $ev) {
                        $idEv = $ev->idEvent;
                        $nip = $ev->NIP;
                    }
                    if ($nip === $domainA && $idEvent === $idEv):
                        return view('homeadmin', ['event' => $event]);
                    else:
                        Join_EventModel::create([
                            'idEvent' => $idEvent,
                            'NIP' => Auth::user()->NIP
                        ]);
                        return view('homeadmin', ['event' => $event]);
                    endif;
                endif;
            endif;
        endif;
        return redirect('/home')->with(['warning' => 'Join from Code admin Required!']);
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

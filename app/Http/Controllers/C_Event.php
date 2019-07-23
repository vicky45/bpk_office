<?php

namespace App\Http\Controllers;

use App\EventModel;
use App\Join_EventModel;
use App\QuestionModel;
use auth;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class C_Event extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function SitanyaPage() {
        return view('sitanyahome');
    }

    public function switch_event(Request $request) {
        $request->session()->forget('event');
        return redirect('/sitanyahome');
    }

    public function join_event(Request $request) {
        $code = $request->input('join');
        $status = 1;
        $event = EventModel :: where('code_event', '=', $code)->get();
        $domain = Auth::user()->name;
        if ($event != null) :
            foreach ($event as $tmp) {//get data
                //inisialisasi data
                $auth = $tmp->user_created;
//                seleksi admin
                if ($domain == $auth):
                    $EventModel = EventModel::find($tmp->idEvent);
                    $EventModel->status_event = $status;
                    $EventModel->save();
                    $request->session()->put('event', $code);
                    return redirect('/homeadmin');
                else:
                    $request->session()->put('event', $code);
                    return redirect('/homeuser');
                endif;
            }
        endif;
        return redirect()->back()->with(['warning' => 'Code Tidak Terdaftar!']);
    }

    public function create_event(Request $request) {
        $codeevent = Str::random(6);
        $status = 1;
        $usercreated = Auth::user()->name;
        $this->validate($request, [
            'event' => 'required',
            'location' => 'required',
            'date' => 'required',
            'time' => 'required',
        ]);

        $EventModel = EventModel::create([
                    'code_event' => $codeevent,
                    'user_created' => $usercreated,
                    'name_event' => $request->event,
                    'location' => $request->location,
                    'date_event' => $request->date,
                    'time_event' => $request->time,
                    'status_event' => $status
        ]);
        if ($EventModel->exists) {
            $request->session()->forget('event');
            $request->session()->put('event', $codeevent);
            return redirect('/homeadmin');
        }
        return redirect('/sitanyahome');
    }

    public function update_event(Request $request) {
        $usercreated = Auth::user()->name;
        $idEvent = $request->id;
        // update data pegawai
        $EventModel = EventModel::find($idEvent);
        $EventModel->code_event = $request->code;
        $EventModel->user_created = $usercreated;
        $EventModel->name_event = $request->event;
        $EventModel->location = $request->location;
        $EventModel->date_event = $request->date;
        $EventModel->time_event = $request->time;
        $EventModel->save();
        if ($EventModel->exists) {
            $request->session()->forget('event');
            $request->session()->put('event', $request->code);
            return redirect('/homeadmin');
        }
        return redirect('/homeadmin');
    }

    public function user_event(request $request) {// /homeuser
        $nip = null;
        $idEv = null;
        if ($request->session()->has('event')) {
            //cek idEevent di table Event
            $event = EventModel :: where('code_event', '=', $request->session()->get('event'))->get();
            foreach ($event as $ev) {
                $idEvent = $ev->idEvent;
            }
            //get nip
            $cek = Join_EventModel:: where('NIP', '=', Auth::user()->NIP)->get();
            //seleksi
            if ($cek != null) {
                //cek nip
                foreach ($cek as $ev) {
                    $idEv = $ev->idEvent;
                    $nip = $ev->NIP;
                }
                $question = QuestionModel::where('NIP','=',$nip)->get();
                if ($nip === Auth::user()->NIP && $idEvent === $idEv) {
                    return view('homeuser', ['event' => $event],['question' => $question]);
                } else {
                    Join_EventModel::create([
                        'idEvent' => $idEvent,
                        'NIP' => Auth::user()->NIP
                    ]);
                    return view('homeuser', ['event' => $event],['question' => $question]);
                }
            }
        }
        return redirect('/sitanyahome')->with(['warning' => 'Input code and Join Required!']);
    }

    public function admin_event(request $request) {// /homeadmin
        $domainA = Auth::user()->NIP;
        $domainB = Auth::user()->name;
        $nip = null;
        $idEv = null;
        if ($request->session()->has('event')) {
            //cek idEevent di table Event
            $event = EventModel :: where('code_event', '=', $request->session()->get('event'))->get();
            foreach ($event as $ev) {
                $idEvent = $ev->idEvent;
                $user = $ev->user_created;
            }
            if ($domainB === $user) {
                $cek = Join_EventModel :: where('NIP', '=', $domainB)->get();
                if ($cek != null) {
                    //cek nip
                    foreach ($cek as $ev) {
                        $idEv = $ev->idEvent;
                        $nip = $ev->NIP;
                    }
                    if ($nip === $domainB && $idEvent === $idEv) {
                        return view ('homeadmin',['event' => $event]);
                    } else {
                        Join_EventModel::create([
                            'idEvent' => $idEvent,
                            'NIP' => Auth::user()->NIP
                        ]);
                        return view ('homeadmin',['event' => $event]);
                    }
                }
            }
        }
        return redirect('/sitanyahome')->with(['warning' => 'Join from Code admin Required!']);
    }
    //=================================================================//
//                                End @Ananda
    public function tampilkanSession(Request $request) {
		if($request->session()->has('event')){
			echo $request->session()->get('event');
		}else{
			echo 'Tidak ada data dalam session.';
		}
	}
 
	// membuat session
	public function buatSession(Request $request) {
		$request->session()->put('event','BPKRI');
		echo "Data telah ditambahkan ke session.";
	}
 
	// menghapus session
	public function hapusSession(Request $request) {
		$request->session()->forget('event');
		echo "Data telah dihapus dari session.";
	}
        
        public function cekapi(){
            $cekapi = EventModel::all();
            return cekapi;
        }
}

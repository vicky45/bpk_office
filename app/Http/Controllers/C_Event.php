<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\EventModel;
use App\AdminModel;
use App\User;
use App\User_has_EventModel;
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
       $event_active = EventModel::where('status_event',1)->get(); 
        return view('Extended.show_active',compact('event_active'));
    }

    public function destroy($id) {//hapus
        //Not Use
    }

    public function edit($id) {//update data berdasar
        //Not Use
    }

    public function store(Request $request) {//store data code admin or user
        $request->session()->forget('event');
        $usernip = Auth::user()->NIP;
        $code = $request->join;
        $session = null;
        $idadmin = null;
        //resource global event
        $idEvent = null;
        $code_event = null;
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
            
            $user = User::where('NIP',$usernip)->get();
            $Event = EventModel::where('code_event', $codeevent)->get();
            
            foreach($user as $user){
                $name = $user->name;
                $NIP = $user->NIP;
            }
            foreach ($Event as $event) {
                    $session = $event->idEvent;
            }
            
            $Admin = AdminModel::create([
                        'Name_Admin' => $name,
                        'User_NIP' => $NIP,
                        'Event_idEvent' => $session,
            ]);
            if ($EventModel->exists) {
                $request->session()->forget('event');
                $request->session()->put('event', $session);
                return redirect('/homeadmin');
                
            } else {
                return redirect()->back()->with(['warning' => 'Create Event Failed!']);
            }
        } else {
            //log in with code
            $event = EventModel :: where('code_event', '=', $code)->get();
            foreach ($event as $ev) {
                $idEvent = $ev->idEvent;
                $code_event = $ev->code_event;
                $status = $ev->status_event;
            }
            
            if ($code === $code_event) {                
                $admin = AdminModel :: where('Event_idEvent', $session)
                    ->where('User_NIP',$usernip)
                    ->count();
                if ($admin > 0) {
                    $request->session()->put('event', $idEvent);
                    $Upstatus = EventModel::find($idEvent);
                    $Upstatus->status_event = 1;
                    $Upstatus->save();
                    return redirect('/homeadmin');
                } else {
                    if ($status == 1) {
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
        if ($request->session()->has('event')) {
            $session = $request->session()->get('event');
            $usernip = Auth::user()->NIP;
            $tmp = null;
            $event = EventModel::where('idEvent', $session)
                    ->get();
            $user = User_has_EventModel :: where('Event_idEvent', $session)
                    ->where('User_NIP', $usernip)
                    ->count();
            $questme = Questionmodel::where('Event_idEvent', $session)
                    ->where('User_NIP', $usernip)
                    ->get();

            $questall = Questionmodel::where('Event_idEvent', $session)
                    ->where('status', 1)
                    ->get();

            foreach ($event as $ev) {
                $tmp = $ev->status_event;
            }
            if ($tmp === 0) {
                $request->session()->forget('event');
                return redirect('/home')->with(['warning' => 'Event has Ended!']);
            } else {
                if ($user < 1) {
                    User_has_EventModel::created([
                        'User_NIP' => $usernip,
                        'Event_idEvent' => $session,
                    ]);
                    return view('homeuser', compact('event', 'questme', 'questall'));
                } else {
                    return view('homeuser', compact('event', 'questme', 'questall'));
                }
//            }
            }
        } else {
            $request->session()->forget('event');
            return redirect('/home')->with(['warning' => 'Input code and Join Required!']);
        }
    }

    public function admin_event(request $request) {// /homeadmin   
        if ($request->session()->has('event')) {
            $usernip = Auth::user()->NIP;
            $session = $request->session()->get('event');
            $admin = AdminModel :: where('Event_idEvent', $session)
                    ->where('User_NIP',$usernip)
                    ->count();
            if ($admin == 1 && $session > 0) {
                $event = EventModel::where('idEvent', $session)
                        ->get();
                $question_validate = QuestionModel::where('Event_idEvent', $session)
                        ->where('status', 0)
                        ->get();
                $question_approve = QuestionModel::where('Event_idEvent', $session)
                        ->where('status', 1)
                        ->get();
                return view('homeadmin', compact('event', 'question_validate', 'question_approve'));
            }else{
                $request->session()->forget('event');
                return redirect('/home')->with(['warning' => 'Input code admin Required!']);
            }
        } else {
            $request->session()->forget('event');
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

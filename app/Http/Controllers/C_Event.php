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
use App\PollingModel;
use Auth;
use PDF;
use Illuminate\Support\Str;

class C_Event extends Controller {

    public function __construct() {
        $this->middleware('auth');
    }

    public function home() {
        return view('tanjahome');
    }

    
    
    public function destroy($id) {//hapus
        //Not Use
    }

    public function edit($id) {//update data berdasar
        //Not Use
    }

    public function create() {//create some Event create
        $event_active = EventModel::where('status_event', 1)->get();
        return view('Extended.show_active', compact('event_active'));
    }
    
    public function show(Request $request, $id) {//show summary
        $question = QuestionModel::where('Event_idEvent',$id)->get();
        $polling = PollingModel::where('Event_idEvent',$id)
                                ->where('status_polling',11)
                                ->get();
        return view('Extended.summary',compact('question','polling'));
    }
    
    public function store(Request $request) {//store data code admin or user
        $usernip = Auth::user()->NIP;
        $code = $request->join;
        //resource global join by input code
        $idEvent = null;
        $code_event = null;
        $status = 0;
        $session_admin = null;
        $session_event = null;
       
        // Join event by Create Event
        if ($code === null) {
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
            if ($EventModel->exists) {
                //get data for create admin by IdEvent
                $Event = EventModel::where('code_event', $code)->get();
                foreach ($Event as $event) {
                    $session_event = $event->idEvent;
                }
                $user = User::where('NIP', $usernip)->get();
                foreach ($user as $use) {
                    $user_nip = $use->NIP;
                    $user_name = $use->name;
                }
                $Admin = AdminModel::create([
                            'User_NIP' => $user_nip,
                            'Name_Admin' => $user_name,
                            'Event_idEvent' => $session_event
                ]);
                $Admin = AdminModel::where('User_NIP', $user_nip)->get();
                foreach ($Admin as $admin) {
                    $session_admin = $admin->idAdmin;
                }
                session(['event' => $session_event , 'admin' => $session_admin]);
                return redirect('/homeadmin');
            } else {

                return redirect()->back()->with(['warning' => 'Create Event Failed!']);
            }
        } else {
            //join with input code
            $event = EventModel :: where('code_event', '=', $code)->get();
            foreach ($event as $ev) {
                $session_event = $ev->idEvent;
                $code_event = $ev->code_event;
                $status = $ev->status_event;
            }
            if ($code === $code_event) {
                //validate for Admin
                $admin = AdminModel :: where('Event_idEvent', $session_event)
                        ->where('User_NIP', $usernip)
                        ->count();
                if ($admin > 0) {
                    $Upstatus = EventModel::find($session_event);
                    $Upstatus->status_event = 1;
                    $Upstatus->save();

                    $Admin = AdminModel :: where('Event_idEvent', $session_event)
                            ->where('User_NIP', $usernip)
                            ->get();
                    foreach ($Admin as $admin) {
                        $session_admin = $admin->idAdmin;
                    }
                    session(['event' => $session_event , 'admin' => $session_admin]);
                    return redirect('/homeadmin');
                } else {
                    if ($status == 1) {
                        session(['event' => $session_event , 'user' => $usernip]);
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
        if ($request->session()->has('user')) {
            $session = $request->session()->get('event');
            $usernip = $request->session()->get('user');
            $tmp = null;
            $event = EventModel::where('idEvent', $session)
                    ->get();
            $user = User_has_EventModel :: where('Event_idEvent', $session)
                    ->where('User_NIP', $usernip)
                    ->count();
            $questme = Questionmodel::where('Event_idEvent', $session)
                    ->where('User_NIP', $usernip)
                    ->get();
            $polling_result = PollingModel::where('Event_idEvent', $session)
                    ->where('status_polling', 1)
                    ->get();
            foreach ($event as $ev) {
                $tmp = $ev->status_event;
            }
            if ($tmp === 0) {
                $request->session()->forget('event');
                $request->session()->forget('user');
                return redirect('/home')->with(['warning' => 'Event has Ended!']);
            } else {
                if ($user < 1) {
                    User_has_EventModel::create([
                        'Event_idEvent' => $session,
                        'User_NIP' => $usernip,
                    ]);
                    return view('homeuser', compact('event', 'questme','polling_result'));
                } else {
                    return view('homeuser', compact('event', 'questme','polling_result'));
                }
            }
        } else {
            $request->session()->forget('event');
            $request->session()->forget('user');
            return redirect('/home')->with(['warning' => 'Input code and Join Required!']);
        }
    }

    public function admin_event(request $request) {//homeadmin   
        if ($request->session()->has('admin')) {
            $session = $request->session()->get('event');
            $event = EventModel::where('idEvent', $session)
                    ->get();
            $used = User_has_EventModel::where('Event_idEvent', $session)
                    ->get();
            $question_approve = QuestionModel::where('Event_idEvent', $session)
                    ->where('status', 1)
                    ->get();
            $polling_ready = PollingModel::where('Event_idEvent', $session)->get();
            $polling_result = PollingModel::where('Event_idEvent', $session)
                    ->where('status_polling', 1)
                    ->get();
            $summary_poll = PollingModel::where('Event_idEvent', $session)
                    ->where('status_polling', 11)
                    ->get();
            return view('homeadmin', compact('event','used','question_approve','polling_ready','polling_result','summary_poll'));
        } else {
            $request->session()->forget('event');
            $request->session()->forget('admin');
            return redirect('/home')->with(['warning' => 'Input code admin Required!']);
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
        $tmpadmin = $request->session()->get('admin');

        if ($tmpadmin > 0) {
            $EventModel = EventModel::find($request->session()->get('event'));
            $EventModel->status_event = 0;
            $EventModel->save();
            $request->session()->forget('event');
            $request->session()->forget('admin');
            return redirect()->action('C_Event@home');
        } else {
            $request->session()->forget('event');
            $request->session()->forget('user');
            return redirect()->action('C_Event@home');
        }
    }
    //For Download Summary
    public function Downloadsummary($id){
        $EventModel = EventModel::find($id);
        $DOMPDF = PDF::loadview('summarypdf',['EventModel'=>$EventModel]);
    	return $DOMPDF->download('summary-pdf');
    }
}
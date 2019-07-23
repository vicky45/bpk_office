<?php

namespace App\Http\Controllers;
use App\EventModel;
use App\SpeakerModel;
use App\QuestionModel;
use auth;
use Illuminate\Http\Request;

class C_Question extends Controller
{
//    =====================Speaker Function==========================
    public function speaker_add(Request $request){
    $event = EventModel :: where('code_event', '=', $request->session()->get('event'))->get();
        foreach ($event as $ev) {
            $idEvent = $ev->idEvent;
        }
    SpeakerModel::create([
        'idEvent' => $idEvent,
        'name_speaker' => $request->speaker,
    ]);
    return redirect('/homeadmin');
    }
    
    public function speaker_delete($id){
    $speak = SpeakerModel::find($id);
    $speak->delete();
    }
    
//    ========================Question Function=====================
    
    public function ask(Request $request) {
        $event = EventModel :: where('code_event', '=', $request->session()->get('event'))->get();
        foreach ($event as $ev) {
            $idEvent = $ev->idEvent;
        }
        
        if($request->speak === "--Select Speaker--"){
            QuestionModel::create([
                'idEvent' => $idEvent,
                'NIP' => Auth::user()->NIP,
                'question' => $request->ask,
                ]);
            return redirect()->back();
        }else{
            $speak = SpeakerModel :: where('name_speaker', '=', $request->speak)->get();
            foreach ($speak as $ec) {
                $idSpeak = $ec->idSpeaker;
            }
            QuestionModel::create([
                'idEvent' => $idEvent,
                'NIP' => Auth::user()->NIP,
                'idSpeaker' => $idSpeak,
                'question' => $request->ask,
            ]);
            return redirect()->back();
        }
        
    }

}

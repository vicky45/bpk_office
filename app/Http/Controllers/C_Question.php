<?php

namespace App\Http\Controllers;
use Auth;
use App\EventModel;
use App\Join_EventModel;
use App\SpeakerModel;
use App\QuestionModel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class C_Question extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $event = EventModel :: where('code_event', '=', $request->session()->get('event'))->get();
        foreach ($event as $ev) {
            $idEvent = $ev->idEvent;
        }
        $question = QuestionModel::where('idEvent','=',$idEvent)->get();
        return ['question'=>$question];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $Question = QuestionModel :: where('User_NIP', Auth::user()->NIP)
                   ->where('Event_idEvent', $request->session()->get('event'))
                   ->get();
      
        if($request->speak === "--Select Speaker--"){
            QuestionModel::create([
                'User_NIP' => Auth::user()->NIP,
                'Event_idEvent'=>$request->session()->get('event'),
                'question' => $request->ask
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
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //Not Use
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}

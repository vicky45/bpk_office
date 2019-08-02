<?php

namespace App\Http\Controllers;

use App\SpeakerModel;
use App\QuestionModel;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class C_Question extends Controller {

    public function index() {
        //Not Use
    }

    public function edit($id) {
        //Not Use
    }

    public function create() {
        //note Use
    }

    public function destroy($id) {//remove question
//        Not Use
    }

    public function store(Request $request) {//store question
        $event = $request->session()->get('event');
        $user = $request->session()->get('user');
        $Question = QuestionModel :: where('User_NIP', $user)
                ->where('Event_idEvent', $event)
                ->get();
        if ($request->speak === "--Select Speaker--") {
            QuestionModel::create([
                'User_NIP' => $user,
                'Event_idEvent' => $event,
                'question' => $request->ask
            ]);
            return redirect()->back();
        } else {
            $speak = SpeakerModel :: where('name_speaker', '=', $request->speak)->get();
            foreach ($speak as $ec) {
                $idSpeak = $ec->idSpeaker;
            }
            QuestionModel::create([
                'Event_idEvent' => $event,
                'User_NIP' => $user,
                'Speaker_idSpeaker' => $idSpeak,
                'question' => $request->ask,
            ]);
            return redirect()->back();
        }
    }

    public function show(Request $request, $id) { //refresh all question by javascript
        $question_approve = QuestionModel::where('Event_idEvent', $id)
                ->where('status', 1)
                ->get();
        return view('Extended.question_approve', compact('question_approve'));
    }

    public function update(Request $request, $id) {//update answer by admin
        $admin = $request->session()->get('admin');
        $answer = QuestionModel::find($id);
        $answer->Admin_idAdmin = $admin;
        $answer->answer = $request->answer;
        $answer->save();
        return redirect()->back()->with(['success' => 'Answer Completed!']);
    }

    public function Show_validate(Request $request, $id) {//for view admin to validate question
        $question_validate = QuestionModel::where('Event_idEvent', $id)
                ->where('status', 0)
                ->get();
        return view('Extended.question_validate', compact('question_validate'));
    }

    public function approve($id) {//for admin to validate
        $approve = QuestionModel::find($id);
        $approve->status = 1;
        $approve->save();
        return redirect()->back()->with(['success' => 'Approve Completed!']);
    }

    public function delete($id) {
        $statusupdate = QuestionModel::find($id);
        $statusupdate->delete();
        return redirect()->back()->with(['success' => 'Question Deleted!']);
    }

    public function like() {
        
    }

    public function dislike() {
        
    }

}

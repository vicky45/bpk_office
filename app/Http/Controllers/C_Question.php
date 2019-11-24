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

    public function store(Request $request) {//store question
        $form = $request->ask;
        if($form != null) {
            $event = $request->session()->get('event');
            $user = $request->session()->get('user');
            $Question = QuestionModel :: where('User_NIP', $user)
                    ->where('Event_idEvent', $event)
                    ->get();
            if ($request->speak === "--Select Speaker--") {
                QuestionModel::create([
                    'User_NIP' => $user,
                    'Event_idEvent' => $event,
                    'question' => $request->ask,
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
        } else {
            return redirect()->back();
        }
    }

    public function delete($id) {
        $delete = QuestionModel::find($id);
        $delete->delete();
        return redirect()->back()->with(['success' => 'Question Deleted!']);
    }

    public function remove_answer($id) {
        $remove_answer = QuestionModel::find($id)->update(['answer' => "Not Answered"]);
        ;
        return redirect()->back()->with(['success' => 'Answer Deleted!']);
    }

    public function show(Request $request, $id) { //refresh all question by javascript
        $question_approve = QuestionModel::where('Event_idEvent', $id)
                ->where('status', 1)
                ->get();
        return view('Extended.question_approve', compact('question_approve'));
    }

    public function update(Request $request, $id) {//update answer by admin
        $form = $request->answer;
        if ($form != null) {
            $admin = $request->session()->get('admin');
            $answer = QuestionModel::find($id);
            $answer->Admin_idAdmin = $admin;
            $answer->answer = $request->answer;
            $answer->save();
            return redirect()->back()->with(['success' => 'Answer Completed!']);
        } else {
            return redirect()->back()->with(['warning' => 'Answer Failed!']);
        }
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

    public function approve_all($id) {//for admin to validate all question
        QuestionModel::where('Event_idEvent', $id)->update(['status' => 1]);
        return redirect()->back()->with(['success' => 'Approve all Completed!']);
    }

    public function like($id) {
        QuestionModel::find($id)->increment('reaction_like');
        return redirect()->back();
    }

    public function dislike($id) {
        QuestionModel::find($id)->increment('reaction_dislike');
        return redirect()->back();
    }
}
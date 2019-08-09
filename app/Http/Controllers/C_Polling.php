<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\PollingModel;
use App\RatingModel;
use App\MultipleModel;




class C_Polling extends Controller
{
    public function index()
    {
        //Not Use
    }
    public function create()
    {
        //Not Use
    }
    

    public function store(Request $request) { //store polling 
        $admin = $request->session()->get('admin');
        $event = $request->session()->get('event');
        $type = $request->type;
        $title = $request->title;
        $idPoll = null;
        $choise = [];

        //Create Polling by type
        PollingModel::create([
            'Admin_idAdmin' => $admin,
            'Event_idEvent' => $event,
            'type_polling' => $type,
            'title_polling' => $title,
            'status_polling' => 0
        ]);
        $Poll = PollingModel::where('Event_idEvent', $event)
                ->where('title_polling', $title)
                ->get();
        foreach ($Poll as $p) {
            $idPoll = $p->idPolling;
        }
        switch ($type) {
            case 'Rating':
                for ($i = 1; $i <= 5; $i++) {
                    RatingModel::create([
                        'polling_idPolling' => $idPoll,
                        'rating' => $i
                    ]);
                }
                return redirect()->back()->with(['success' => 'Created rating Success!']);
                break;
            case 'Multiple':
                //Get data n input User multiple choise
                $choice = array($request->A, $request->B, $request->C, $request->D);
                
                for ($i = 0; $i < 4; $i++) {
                    if($choice[$i] != null){
                    MultipleModel::create([
                        'polling_idPolling' => $idPoll,
                        'multiple_choice' => $choice[$i]
                    ]);
                    }else{
                    $i = 4;
                    }
                }
                return redirect()->back()->with(['success' => 'Created Multiple Success!']);
                break;
        }
    }   
    public function show($id) {//show polling active right from admin (javascript auto update)
        $n_choice_multi = null;
        $n_choice_rate = null;
        $polling_result = PollingModel::where('Event_idEvent', $id)
                ->where('status_polling', 1)
                ->get();
        foreach ($polling_result as $count) {
            switch ($count->type_polling) {
                case 'Multiple':
                    foreach ($count->MultipleModel as $count_m) {
                        $n_choice_multi = $count_m->sum('total_multiple_choice');
                    }
                    break;
                case 'Rating':
                    foreach ($count->RatingModel as $count_m) {
                        $n_choice_rate = $count_m->sum('total_rating');
                    }
                    break;
            }
        }
        return view('Extended.polling_result', compact('polling_result','n_choice_multi','n_choice_rate'));
    }

    public function show_user($id) {//show polling active right from admin (javascript auto update)
        $polling_show = PollingModel::where('Event_idEvent', $id)
                ->where('status_polling', 1)
                ->get();
        return view('Extended.polling_show', compact('polling_show'));
    }
    
    public function approve_polling(Request $request,$id){
        $event = $request->session()->get('event');
        $poll = PollingModel::where('Event_idEvent',$event)
                ->where('status_polling',1)
                ->count();
        if($poll == 0){
            $show = PollingModel::find($id);
            $show->status_polling = 1;
            $show->save();
            return redirect()->back();
            }else{
             return redirect()->back()->with(['warning' => 'Failed! You have active Polling!']);
            }
    }
    
    public function delete_polling($id){
        $type = null;
        $polling = PollingModel::where('idPolling',$id)->get();
        foreach ($polling as $p) {
            $type = $p->type_polling;
        }
        $polling = PollingModel::find($id);
        $polling->delete();
        
        switch ($type) {
            case 'Rating':
                RatingModel::where('Polling_idPolling',$id)->delete();
                return redirect()->back()->with(['success' => 'Delete rating Success!']);
                break;
            case 'Multiple':
                MultipleModel::where('Polling_idPolling',$id)->delete();
                return redirect()->back()->with(['success' => 'Delete Multiple Success!']);
                break;
        }
        return redirect()->back();
    }
    
    public function stop_polling($id){
        $polling = PollingModel::find($id);
        $polling->status_polling = 11;
        $polling->save();
        return redirect()->back();
    }
    
    public function submitPolling(Request $request, $id){
        $type = null;
        $polling = PollingModel::where('idPolling',$id)->get();
        foreach ($polling as $p) {
            $type = $p->type_polling;
        }
        switch ($type) {
            case 'Rating':
                    RatingModel::where('polling_idPolling',$id)
                    ->where('rating',$request->star)->increment('total_rating');
                break;
            case 'Multiple':
                    MultipleModel::where('id_multiple_choice',$request->choice)->increment('total_multiple_choice');
                break;
        }
        return redirect()->back()->with(['success' => 'Polling Succes!']);
    } 
}
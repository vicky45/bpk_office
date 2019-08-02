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
            case 'rating':
                for ($i = 1; $i <= 5; $i++) {
                    RatingModel::create([
                        'polling_idPolling' => $idPoll,
                        'rating' => $i
                    ]);
                }
                return redirect()->back()->with(['success' => 'Created rating Success!']);
                break;
            case 'multiple':
                //Get data n input User multiple choise
                $choice = array($request->A, $request->B, $request->C, $request->D);
                for ($i = 0; $i < 4; $i++) {
                    MultipleModel::create([
                        'polling_idPolling' => $idPoll,
                        'multiple_choice' => $choice[$i]
                    ]);
                }
                return redirect()->back()->with(['success' => 'Created Multiple Success!']);
                break;
        }
    }   
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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

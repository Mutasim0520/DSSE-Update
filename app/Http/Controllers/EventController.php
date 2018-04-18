<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event as Events;
use Session;
use Auth;

class EventController extends Controller
{
    public function show(){
        $Events = Events::orderBy('id','desc')->get();
        if(Auth::guard('admin')->check()){
            return view('events.eventList' ,['event' => $Events]);
        }
        else{
            return view('user.events' ,['events' => $Events]);
        }
    }
    public function addEvent(){
        return view('events.addEvent');
    }
    public function store(Request $request){
        echo "got";
        if($request->hasFile('image')){
            $this->validate($request, [
                'image' => 'mimes:jpeg,png,jpg,gif,svg|max:5048',
            ]);
            $imageName = time().'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('images/events'), $imageName);
        }

        $Event = new Events();
        $Event->name = $request->eventName;
        $Event->date = $request->eventDate;
        $Event->time = $request->time;
        $Event->place = $request->place;
        $Event->description = $request->description;
        $Event->url = $imageName;
        $Event ->save();

        Session::flash('EventAdd','Event has been added successully!');
        return view('events.eventList');
    }

    public function deleteEvent(Request $request){
        if($request->ajax()){
            $Event = Events::find($request->id)->delete();
            return redirect()->back();
        }
        else{
            return redirect()->back();
        }
    }
}

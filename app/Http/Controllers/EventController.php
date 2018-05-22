<?php

namespace App\Http\Controllers;

use App\Event;
use Illuminate\Http\Request;
use App\Event as Events;
use Session;
use Auth;
use App\Events_photo as Photos;

class EventController extends Controller
{
    public function show(){
        $Events = Events::orderBy('id','desc')->with('events_photo')->get();
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

        $Event = new Events();
        $Event->name = $request->eventName;
        $Event->date = $request->eventDate;
        $Event->time = $request->time;
        $Event->place = $request->place;
        $Event->description = $request->description;
        $Event ->save();
        $event = Events::orderBy('id','DESC')->first();
        if($request->hasFile('images')){
            $k = 0;
            foreach ($request->images as $item){
                $imageName = $k.time().'.'.$item->getClientOriginalExtension();
                $photo = new Photos();
                $photo->path = $imageName;
                $event->events_photo()->save($photo);
                $item->move(public_path('images/events'), $imageName);
                $k++;
            }
        }

        Session::flash('EventAdd','Event has been added successully!');
        return redirect('/admin/eventlist');
    }

    public function delete(Request $request){
        if($request->ajax()){
            $Event = Events::find($request->id);
            $Event->delete();
            return redirect()->back();
        }
        else{
            return redirect()->back();
        }
    }

    public function showUpdateEventForm(Request $request){
        $event = Event::with('events_photo')->find($request->id);
        return view('events.updateEvent',['event' => $event]);
    }

    public function update(Request $request){

        $Event = Events::find($request->id);
        $Event->name = $request->eventName;
        $Event->date = $request->eventDate;
        $Event->time = $request->time;
        $Event->place = $request->place;
        $Event->description = $request->description;
        $Event ->save();
        $event = Events::orderBy('id','DESC')->first();
        if($request->hasFile('images')){
            $k = 0;
            foreach ($request->images as $item){
                $imageName = $k.time().'.'.$item->getClientOriginalExtension();
                $photo = new Photos();
                $photo->path = $imageName;
                $event->events_photo()->save($photo);
                $item->move(public_path('images/events'), $imageName);
                $k++;
            }
        }

        Session::flash('EventAdd','Event has been added successully!');
        return redirect('/admin/eventlist');
    }
}

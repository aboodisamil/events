<?php

namespace App\Http\Controllers;

use App\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function store(Request $request){
        $event =  Event::create($request->all());
        return response($event);
    }
    
    public function destroy(Event $event)
    {
        $event->delete();
    }
}

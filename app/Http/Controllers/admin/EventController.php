<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::all();
        return view("admin.events.index", compact("events"));
    }

    public function show(int $eventId)
    {
        $event = Event::findOrFail($eventId);
        $eventBookings = $event->eventBookings()->with(["user"])->get();
        return view("admin.events.show", compact("event", "eventBookings"));
    }


}

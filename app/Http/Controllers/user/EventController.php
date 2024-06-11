<?php

namespace App\Http\Controllers\user;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\EventBooking;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::latest()->get();
        return view("user.events.index", compact("events"));
    }

    public function show(int $eventId)
    {
        $event = Event::findOrFail($eventId);
        $user = auth()->user();

        $eventBookingExists = EventBooking::where("event_id", $eventId)->where("user_id", $user->id)->exists();

        return view("user.events.show", compact("event", "eventBookingExists"));
    }
}

<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\EventEditRequest;
use App\Http\Requests\EventStoreRequest;
use App\Models\Event;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

    public function create()
    {
        return view("admin.events.create");
    }


    public function store(EventStoreRequest $request)
    {
        $data = $request->validated();
        $image = $request->file("event_image");
        $imageExtension = $image->getClientOriginalExtension();
        $newImageName = str_replace(" ", "_", $data["name"]) . Carbon::now()->timestamp . "." . $imageExtension;

        $request->file("event_image")->storeAs("images/events/", $newImageName, "public");
        Event::create([
            "name" => $data["name"],
            "description" => $data["description"],
            "capacity" => $data["capacity"],
            "price" => $data['price'],
            "event_image_url" => $newImageName
        ]);

        return redirect(route("adminEvents.index"))->with("success", "Event Created Successfully");
    }


    public function edit(int $eventId)
    {
        $event = Event::findOrFail($eventId);
        return view("admin.events.edit", compact("event"));
    }

    public function update(EventEditRequest $request, int $eventId)
    {
        $data = $request->validated();
        $event = Event::findOrFail($eventId);

        if ($request->has("event_image")) {

            $newImage = $request->file("event_image");

            $imageExtension = $newImage->getClientOriginalExtension();
            $newImageName = str_replace(" ", "_", $data["name"]) . "_" . Carbon::now()->timestamp . "." . $imageExtension;

            $request->file("event_image")->storeAs("images/events/", $newImageName, "public");

            Storage::delete("public/images/events/" . $event->event_image_url);

            $event->update([
                "event_image_url" => $newImageName
            ]);
        }

        $event->update($data);

        return redirect(route('adminEvents.index'))->with("success", "Event Updated Successfully");
    }


    public function destroy(int $eventId)
    {
        $event = Event::findOrFail($eventId);
        Storage::delete("public/images/events/" . $event->event_image_url);
        $bookings = $event->eventBookings()->get();
        foreach ($bookings as $eventBooking) {
            $eventBooking->delete();
        }
        $event->delete();

        return redirect(route('adminEvents.index'))->with("success", "Event Deleted Successfully");
    }

    public function toggleStatus(int $eventId)
    {
        $event = Event::findOrFail($eventId);

        $event->status == "open" ? $event->status = "closed" : $event->status = "open";
        $event->save();


        return redirect()->back()->with("success", "Event Updated Successfully");
    }
}

@extends('layouts.admin.app')

@section('title', 'Events')

@section('content')
    <h1 class="text-4xl font-bold text-center">Events</h1>

    <div class="flex justify-center items-start gap-10 mt-10">
        @foreach ($events as $event)
            <a href="{{ route('adminEvents.show', $event->id) }}">
                <div class="flex flex-col items-center">
                    <div class="relative overflow-hidden mb-2">
                        @if ($event->status == 'closed')
                            <div
                                class="absolute top-32 text-center left-0 p-5 bg-red-600 border-2 border-black text-white -rotate-45 w-96">
                                Closed
                            </div>
                        @endif
                        <img src="{{ asset('storage/images/events/' . $event->event_image_url) }}" alt=""
                            class="h-64 w-64 object-cover object-top rounded-md">
                    </div>
                    <div>
                        <p class="font-bold text-left text-xl word-wrap max-w-64">{{ $event->name }}</p>
                        @if ($event->status != 'closed')
                            <div class="font-semibold text-green-500">Rs. {{ $event->price }}</div>
                        @endif
                    </div>
                </div>
            </a>
        @endforeach
    </div>
@endsection

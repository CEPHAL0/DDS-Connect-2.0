@extends('layouts.user.app')

@section('title', 'Events')

@section('content')
    <h1 class="text-4xl font-bold text-center">Events</h1>

    <div class="flex flex-wrap items-start justify-center gap-10 mt-10">
        @foreach ($events as $event)
            <a href="{{ route('userEvents.show', $event->id) }}" class="flex flex-col items-start">
                <div class="flex flex-col items-center">
                    <div class="relative flex items-center justify-center mb-2 overflow-hidden eventBanner">
                        <div
                            class="absolute top-0 z-20 hidden w-full h-full text-white bg-black rounded-md opacity-60 overlay">
                            <p class="mt-[50%] text-center font-bold">
                                View Details
                            </p>
                        </div>
                        @if ($event->status == 'closed')
                            <div
                                class="absolute mx-auto mt-[20%] text-center left-0 p-5 bg-red-600 border-2 border-black text-white -rotate-45 w-96">
                                Closed
                            </div>
                        @endif
                        <img src="{{ asset('storage/images/events/' . $event->event_image_url) }}" alt=""
                            class="object-cover object-top w-64 h-64 rounded-md">

                    </div>

                </div>
                <div class="">
                    <p class="text-xl font-bold text-left word-wrap max-w-64">{{ $event->name }}</p>
                    @if ($event->status != 'closed')
                        <div class="font-semibold text-green-500">Rs. {{ $event->price }}</div>
                    @endif
                </div>
            </a>
        @endforeach
    </div>
    <a href="{{ route('adminEvents.create') }}" class="mx-auto">
        <button type="submit"
            class="px-3 py-3 mx-auto mt-10 font-semibold text-white duration-200 ease-in-out bg-black border border-black rounded-md w-fit focus:ring-2 ring-black ring-offset-1 hover:text-black hover:bg-white"
            id="submitForm">
            Create Event
        </button>
    </a>
@endsection


@section('scripts')
    <script>
        $(".eventBanner").mouseover(function() {
            $(this).children(".overlay").show();
        })

        $(".eventBanner").mouseleave(function() {
            $(this).children(".overlay").hide();
        })
    </script>
@endsection

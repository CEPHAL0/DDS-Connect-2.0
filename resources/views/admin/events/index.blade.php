@extends('layouts.admin.app')

@section('title', 'Events')

@section('content')
    <h1 class="text-4xl font-bold text-center">Events</h1>

    <div class="flex justify-center items-start gap-10 mt-10 flex-wrap">
        @foreach ($events as $event)
            <a href="{{ route('adminEvents.show', $event->id) }}" class="flex flex-col items-start">
                <div class="flex flex-col items-center">
                    <div class="relative overflow-hidden mb-2 eventBanner flex items-center justify-center">
                        <div
                            class="bg-black opacity-60 absolute top-0 text-white h-full w-full rounded-md hidden z-20 overlay">
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
                            class="h-64 w-64 object-cover object-top rounded-md">

                    </div>

                </div>
                <div class="">
                    <p class="font-bold text-left text-xl word-wrap max-w-64">{{ $event->name }}</p>
                    @if ($event->status != 'closed')
                        <div class="font-semibold text-green-500">Rs. {{ $event->price }}</div>
                    @endif
                </div>
            </a>
        @endforeach
    </div>
    <a href="{{ route('adminEvents.create') }}" class="mx-auto">
        <button type="submit"
            class="border w-fit mx-auto mt-10 border-black bg-black px-3 py-3 rounded-md text-white focus:ring-2 ring-black ring-offset-1 hover:text-black hover:bg-white ease-in-out duration-200 font-semibold"
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

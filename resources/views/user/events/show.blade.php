@extends('layouts.user.app')

@section('title', 'Event')


@section('content')


    <div class="flex justify-center gap-20">
        <div class="flex flex-col items-center gap-4">
            <img src="{{ asset('storage/images/events/' . $event->event_image_url) }}" alt=""
                class="object-cover object-top rounded-md h-96 w-96">
            <p class="text-3xl font-normal">Price - <span class="font-extrabold">Rs.{{ $event->price }}</span></p>
        </div>

        <div class="flex flex-col items-start w-1/2 gap-4">
            <div class="flex flex-col items-start gap-2">
                <h1 class="text-4xl font-bold text-start">{{ $event->name }}</h1>
                <p class="text-gray-600 word-wrap">{{ $event->description }}
                </p>
            </div>

            <div>
                <h4 class="text-2xl font-semibold">Participants - <span class="font-extrabold">{{ $event->capacity }}</span>
                </h4>
            </div>

            <div class="flex gap-4">
                @if (!$eventBookingExists)
                    <a href="{{ route('stripe.checkout', ['price' => $event->price, 'product' => $event->name, 'eventId' => $event->id]) }}"
                        class="btn btn-primary"> <button type="submit"
                            class="px-10 py-4 font-semibold text-white duration-200 ease-in-out bg-black border border-black rounded-md w-fit focus:ring-2 ring-black ring-offset-1 hover:text-black hover:bg-white">
                            Book Now
                        </button>
                    </a>
                @else
                    <div
                        class="px-10 py-4 font-semibold text-white duration-200 ease-in-out bg-black border border-black rounded-md w-fit ">
                        Already booked
                    </div>
                @endif


            </div>
        </div>
    </div>




@endsection

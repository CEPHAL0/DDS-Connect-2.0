@extends('layouts.admin.app')

@section('title', 'Event')


@section('content')


    <div class="flex justify-center gap-20">
        <div class="flex flex-col items-center gap-4">
            <img src="{{ asset('storage/images/events/' . $event->event_image_url) }}" alt=""
                class="h-96 w-96 object-cover object-top rounded-md">
            <p class="text-3xl font-normal">Price - <span class="font-extrabold">Rs.{{ $event->price }}</span></p>
        </div>

        <div class="flex flex-col w-1/2 items-start gap-4">
            <div class="flex flex-col items-start gap-2">
                <h1 class="text-4xl font-bold text-start">{{ $event->name }}</h1>
                <p class="word-wrap text-gray-600">{{ $event->description }}
                </p>
            </div>

            <div>
                <h4 class="font-semibold text-2xl">Capacity - <span class="font-extrabold">{{ $event->capacity }}</span>
                </h4>

                <div class="flex flex-wrap gap-1 mt-2">
                    @for ($i = 0; $i < $event->capacity; $i++)
                        <span class="material-symbols-outlined rounded-full bg-black text-white">boy</span>
                    @endfor
                </div>
            </div>
        </div>
    </div>


    <h1 class="mt-24 mb-10 font-bold text-4xl text-center">Bookings</h1>
    <div>
        <table class="table table-auto w-full border-collapse ">
            <thead>
                <tr class="*:text-left *:border *:border-black *:px-2 *:h-10 bg-black text-white">
                    <th>S.N.</th>
                    <th>Booker</th>
                    <th>Contact</th>
                    <th>Email</th>
                    <th>Payment</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($eventBookings as $eventBooking)
                    <tr class="*:text-left *:border *:border-black *:px-2 *:h-10 bg-white text-black *:font-normal">
                        <th>{{ $loop->iteration }}</th>
                        <th>{{ $eventBooking->user->name }}</th>
                        <th>{{ $eventBooking->contact }}</th>
                        <th>{{ $eventBooking->user->email }}</th>
                        <th>{{ ucfirst($eventBooking->payment) }}</th>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
@endsection

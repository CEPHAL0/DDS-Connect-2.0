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

            <div class="flex gap-4">
                <a href="{{ route('adminEvents.edit', $event->id) }}">
                    <button type="submit"
                        class=" bg-black border border-black w-fit px-10 py-4 text-white rounded-md focus:ring-2 ring-black ring-offset-1 hover:text-black hover:bg-white ease-in-out duration-200 font-semibold">
                        Edit
                    </button>
                </a>
                <form action="{{ route('adminEvents.destroy', $event->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class=" bg-red-500 border border-red-500 w-fit px-10 py-4 text-white rounded-md focus:ring-2 ring-red-500 ring-offset-1 hover:text-red-500 hover:bg-white ease-in-out duration-200 font-semibold">
                        Delete
                    </button>

                </form>



            </div>


        </div>
    </div>


    <h1 class="mt-24 mb-10 font-bold text-4xl text-center">Bookings</h1>
    <div class="flex flex-col items-center gap-4">
        <a href="{{ route('adminEvents.toggleStatus', $event->id) }}" class="">
            <button type="submit"
                class=" bg-black border w-fit border-black px-10 py-4 text-white rounded-md focus:ring-2 ring-black ring-offset-1 hover:text-black hover:bg-white ease-in-out duration-200 font-semibold mx-auto">
                @if ($event->status == 'closed')
                    Open Bookings
                @else
                    Close Bookings
                @endif
            </button>
        </a>
        <table class="table table-auto w-full border-collapse rounded-md">
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

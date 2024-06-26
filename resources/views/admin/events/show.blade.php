@extends('layouts.admin.app')

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
                <h4 class="text-2xl font-semibold">Capacity - <span class="font-extrabold">{{ $event->capacity }}</span>
                </h4>

                <div class="flex flex-wrap mt-2 gap-[0.25rem]">
                    @if ($event->capacity < 50)
                        @for ($i = 0; $i < $event->capacity; $i++)
                            <span class="text-white bg-black rounded-full material-symbols-outlined ">boy</span>
                        @endfor
                    @endif
                </div>
            </div>

            <div class="flex gap-4">
                <a href="{{ route('adminEvents.edit', $event->id) }}">
                    <button type="submit"
                        class="px-10 py-4 font-semibold text-white duration-200 ease-in-out bg-black border border-black rounded-md w-fit focus:ring-2 ring-black ring-offset-1 hover:text-black hover:bg-white">
                        Edit
                    </button>
                </a>
                <form action="{{ route('adminEvents.destroy', $event->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="px-10 py-4 font-semibold text-white duration-200 ease-in-out bg-red-500 border border-red-500 rounded-md w-fit focus:ring-2 ring-red-500 ring-offset-1 hover:text-red-500 hover:bg-white">
                        Delete
                    </button>

                </form>



            </div>


        </div>
    </div>


    <h1 class="mt-24 mb-10 text-4xl font-bold text-center">Bookings</h1>
    <div class="flex flex-col items-center gap-4">
        <a href="{{ route('adminEvents.toggleStatus', $event->id) }}" class="">
            <button type="submit"
                class="px-10 py-4 mx-auto font-semibold text-white duration-200 ease-in-out bg-black border border-black rounded-md w-fit focus:ring-2 ring-black ring-offset-1 hover:text-black hover:bg-white">
                @if ($event->status == 'closed')
                    Open Bookings
                @else
                    Close Bookings
                @endif
            </button>
        </a>
        <table class="table w-full border-collapse rounded-md table-auto">
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

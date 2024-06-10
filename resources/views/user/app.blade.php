@extends('layouts.user.app')


@section('title', 'Home')

@section('content')
    <h1 class="mb-10 text-4xl font-bold text-center">Discover Surveys</h1>
    <div class="flex flex-col gap-4">
        @forelse ($forms as $form)
            <div class="flex justify-between px-6 py-5 border rounded-md shadow-md shadow-gray-400 ">
                <div class="flex flex-col gap-4 ">
                    <div class="flex flex-col">
                        <h1 class="text-2xl font-bold word-wrap max-w-[90%]">{{ $form->title }}</h1>
                        <span class="text-sm text-gray-500">{{ $form->user->username }}</span>
                    </div>
                    <div class="text-sm word-wrap max-w-[90%]">{{ $form->description ?? '' }}</div>
                </div>

                <div>
                    @if ($form->status == 'closed')
                        <div class="px-2 py-2 text-white bg-red-600 rounded-md focus:ring-2 ring-red-600 ring-offset-1">
                            Closed</div>
                    @else
                        <div class="px-2 py-2 text-white bg-green-600 rounded-md focus:ring-2 ring-green-600 ring-offset-1">
                            Open
                        </div>
                    @endif
                </div>
            </div>
        @empty
            <p class="text-lg font-bold text-center text-red-500">No form found</p>
        @endforelse
    </div>

    <h1 class="mt-20 mb-8 text-4xl font-bold text-center">Discover Events</h1>
    <div class="flex flex-wrap justify-center gap-10 ">
        @forelse ($events as $event)
            <a href="{{ route('adminEvents.show', $event->id) }}" class="flex flex-col items-start">
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
        @empty
            <div>No Events Currently</div>
        @endforelse
    </div>

@endsection

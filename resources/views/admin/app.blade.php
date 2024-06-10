@extends('layouts.admin.app')

@section('title', 'Home')

@section('content')
    <div class="flex flex-col gap-10">

        <div class="flex justify-center gap-14">
            <a href="{{ route('forms.create') }}">
                <button
                    class="flex flex-col items-center justify-center h-48 gap-4 text-white duration-200 ease-in-out bg-black border border-black shadow-md aspect-square rounded-xl hover:text-black hover:bg-white hover:fill-black shadow-gray-700">
                    <span class="material-symbols-outlined scale-[2]">
                        add
                    </span>
                    <p>Create Form</p>
                </button></a>


            <a href="{{ route('adminMembers.index') }}">
                <button
                    class="flex flex-col items-center justify-center h-48 gap-4 text-white duration-200 ease-in-out bg-black border border-black shadow-md aspect-square rounded-xl hover:text-black hover:bg-white hover:fill-black shadow-gray-700">
                    <span class="material-symbols-outlined scale-[2]">
                        passkey
                    </span>
                    <p>Members</p>
                </button>
            </a>


            <a href="{{ route('adminEvents.create') }}">
                <button
                    class="flex flex-col items-center justify-center h-48 gap-4 text-white duration-200 ease-in-out bg-black border border-black shadow-md aspect-square rounded-xl hover:text-black hover:bg-white hover:fill-black shadow-gray-700">
                    <span class="material-symbols-outlined scale-[2]">
                        local_activity
                    </span>
                    <p>Create Event</p>
                </button>
            </a>


        </div>

        <div class="flex flex-col gap-4">
            <h1 class="my-10 text-4xl font-bold text-center">Latest Forms</h1>
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
                        <form action="{{ route('forms.toggleFormStatus', $form->id) }}" method="POST">
                            @csrf
                            @method('POST')
                            @if ($form->status == 'closed')
                                <button type="submit"
                                    class="px-2 py-2 text-white bg-red-600 rounded-md focus:ring-2 ring-red-600 ring-offset-1">
                                    Closed</button>
                            @else
                                <button type="submit"
                                    class="px-2 py-2 text-white bg-green-600 rounded-md focus:ring-2 ring-green-600 ring-offset-1">Open
                                </button>
                            @endif
                        </form>

                    </div>
                </div>
            @empty
                <p class="text-lg font-bold text-center text-red-500">No form found</p>
            @endforelse
        </div>

    </div>

@endsection

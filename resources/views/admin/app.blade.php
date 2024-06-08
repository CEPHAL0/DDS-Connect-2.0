@extends('layouts.admin.app')

@section('title', 'Home')

@section('content')
    <div class="flex flex-col gap-10">

        <div class="flex justify-center gap-14">
            <a href="{{ route('forms.create') }}">
                <button
                    class="h-48 text-white aspect-square border border-black bg-black rounded-xl flex flex-col items-center justify-center hover:text-black hover:bg-white hover:fill-black ease-in-out duration-200 gap-4 shadow-md shadow-gray-700">
                    <span class="material-symbols-outlined scale-[2]">
                        add
                    </span>
                    <p>Create Form</p>
                </button></a>


            <a href="{{ route('adminMembers.index') }}">
                <button
                    class="h-48 text-white aspect-square border border-black bg-black rounded-xl flex flex-col items-center justify-center hover:text-black hover:bg-white hover:fill-black ease-in-out duration-200 gap-4 shadow-md shadow-gray-700">
                    <span class="material-symbols-outlined scale-[2]">
                        passkey
                    </span>
                    <p>Members</p>
                </button>
            </a>


            <button
                class="h-48 text-white aspect-square border border-black bg-black rounded-xl flex flex-col items-center justify-center hover:text-black hover:bg-white hover:fill-black ease-in-out duration-200 gap-4 shadow-md shadow-gray-700">
                <span class="material-symbols-outlined scale-[2]">
                    local_activity
                </span>
                <p>Events</p>
            </button>


        </div>

        <div class="flex flex-col gap-4">
            <h1 class="text-4xl font-bold text-center my-10">Latest Forms</h1>
            @forelse ($forms as $form)
                <div class="flex  px-6 py-5 border shadow-md shadow-gray-400 rounded-md justify-between ">
                    <div class=" flex flex-col gap-4">
                        <div class="flex flex-col">
                            <h1 class="font-bold text-2xl">{{ $form->title }}</h1>
                            <span class="text-sm text-gray-500">{{ $form->user->username }}</span>
                        </div>
                        <div class="text-sm">{{ $form->description ?? '' }}</div>
                    </div>

                    <div>
                        <form action="{{ route('forms.toggleFormStatus', $form->id) }}" method="POST">
                            @csrf
                            @method('POST')
                            @if ($form->status == 'closed')
                                <button type="submit"
                                    class="bg-red-600 px-2 py-2 rounded-md text-white focus:ring-2 ring-red-600 ring-offset-1">
                                    Closed</button>
                            @else
                                <button type="submit"
                                    class="bg-green-600 px-2 py-2 rounded-md text-white focus:ring-2 ring-green-600 ring-offset-1">Open
                                </button>
                            @endif
                        </form>

                    </div>
                </div>
            @empty
                <p>No form found</p>
            @endforelse
        </div>

    </div>

@endsection

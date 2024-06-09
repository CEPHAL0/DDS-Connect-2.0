@extends('layouts.admin.app')

@section('title', 'Forms')

@section('content')
    <div class="flex flex-col items-center gap-9">
        <h1 class="font-bold text-3xl">All Forms</h1>
        <a href="{{ route('forms.create') }}">
            <button type="submit"
                class="border border-black bg-black px-3 py-3 rounded-md text-white focus:ring-2 ring-black ring-offset-1 hover:text-black hover:bg-white ease-in-out duration-200 font-semibold"
                id="submitForm">
                Create Form
            </button>
        </a>
        @forelse ($forms as $form)
            <a href="{{ route('admin.viewForm', $form->id) }}" class="w-full">
                <div class="flex  px-6 py-5 border shadow-md shadow-gray-400 rounded-md justify-between ">
                    <div class=" flex flex-col gap-4">
                        <div class="flex flex-col">
                            <h1 class="font-bold text-2xl">{{ $form->title }}</h1>
                            <div>
                                <span class="text-sm text-gray-500">{{ $form->user->username }}</span> -
                                <span class="text-sm text-gray-500">{{ $form->created_at->format('M d') }}</span>
                            </div>
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
            </a>
        @empty
            <p>No form found</p>
        @endforelse
    </div>
@endsection

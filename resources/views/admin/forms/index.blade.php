@extends('layouts.admin.app')

@section('title', 'Forms')

@section('content')
    <div class="flex flex-col items-center gap-9">
        <h1 class="text-3xl font-bold">All Forms</h1>
        <a href="{{ route('forms.create') }}">
            <button type="submit"
                class="px-3 py-3 font-semibold text-white duration-200 ease-in-out bg-black border border-black rounded-md focus:ring-2 ring-black ring-offset-1 hover:text-black hover:bg-white"
                id="submitForm">
                Create Form
            </button>
        </a>
        @forelse ($forms as $form)
            <a href="{{ route('admin.viewForm', $form->id) }}" class="w-full">
                <div class="flex justify-between px-6 py-5 border rounded-md shadow-md shadow-gray-400 ">
                    <div class="flex flex-col gap-4 ">
                        <div class="flex flex-col">
                            <h1 class="text-2xl font-bold word-wrap max-w-[90%]">{{ $form->title }}</h1>
                            <div>
                                <span class="text-sm text-gray-500">{{ $form->user->username }}</span> -
                                <span class="text-sm text-gray-500">{{ $form->created_at->format('M d') }}</span>
                            </div>
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
            </a>
        @empty
            <p>No form found</p>
        @endforelse
    </div>
@endsection

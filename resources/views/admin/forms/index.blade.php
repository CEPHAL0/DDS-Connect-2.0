@extends('layouts.admin.app')

@section('title', 'Forms')

@section('content')
    <div class="p-10 flex flex-col gap-7">

        @forelse ($forms as $form)
            <div class="flex border border-black px-3 py-4 rounded-md justify-between bg-gray-100">
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

        <button>
            <a href="{{ route('forms.create') }}">Create Form</a>
        </button>

    </div>

@endsection

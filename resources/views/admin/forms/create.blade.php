@extends('layouts.admin.app')

@section('title', 'Create Form')

@section('content')
    <div>
        <h1 class="font-bold text-3xl text-center mb-10">Create Form</h1>
        <form action="{{ route('forms.store') }}" method="POST">
            @csrf
            @method('POST')
            <div class="flex flex-col gap-10 items-center">
                <div class="flex flex-col items-center justify-center gap-4">
                    <label for="title" class="font-semibold text-lg">Title of Form</label>
                    <input type="text" name="title" class="border border-black px-4 py-4 w-80 rounded-3xl">
                </div>

                <div class="flex flex-col items-center justify-center gap-4">
                    <label for="description" class="font-semibold text-lg">Description of form
                        <span class="font-thin italic text-sm">(optional)</span></label>
                    <textarea name="description" id="description" rows="8"
                        class="border border-black px-4 py-4 w-80 rounded-3xl resize-none"></textarea>
                </div>

                <button type="submit"
                    class="bg-black p-4 rounded-md text-white focus:ring ring-black ring-offset-1 w-fit">Add
                    Questions</button>
            </div>
        </form>
    </div>
@endsection

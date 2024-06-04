@extends('layouts.admin.app')

@section('title', 'Create Form')

@section('content')
    <div>
        <form action="{{ route('forms.store') }}" method="POST">
            @csrf
            @method('POST')
            <label for="title">Title of Form</label>
            <input type="text" name="title" class="border border-black">

            <label for="description">Description of form (optional)</label>
            <textarea name="description" id="description" cols="30" rows="4" class="border border-black"></textarea>

            <button type="submit">Create Form</button>
        </form>
    </div>
@endsection

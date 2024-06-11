@extends('layouts.admin.app')

@section('title', 'Responses')

@section('content')
    <h1 class="flex items-center justify-center gap-5 mb-10 text-4xl font-bold text-center">
        Responses of <span class="px-3 py-2 text-lg rounded-md bg-slate-300">
            {{ $form->title }}</span>
    </h1>

    <a href="{{ route('adminResponses.export', $form->id) }}" class="mx-auto">
        <button type="submit"
            class="px-3 py-3 mb-5 font-semibold text-white duration-200 ease-in-out bg-black border border-black rounded-md focus:ring-2 ring-black ring-offset-1 hover:text-black hover:bg-white w-fit"
            id="submitForm">
            Export to CSV
        </button>
    </a>

    <table class="block w-full overflow-scroll h-[80vh] ">
        <thead class="sticky z-20 text-white bg-black border-2 border-black -top-1 ">
            <tr class="">
                <th class="px-4 text-left border border-white">S.N</th>
                @foreach ($form->questions as $question)
                    <th class="p-4 text-left border border-white w-96 whitespace-nowrap">{{ $question->question }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach ($form->responseUsers as $responseUser)
                <tr class="border-2 border-black hover:bg-slate-200">
                    <td class="h-10 px-4 border-2 border-black ">{{ $loop->iteration }}</td>
                    @foreach ($form->questions as $question)
                        @php
                            $response = $responseUser->responses->firstWhere('question_id', $question->id);
                        @endphp
                        <td class="px-4 border-2 border-black">
                            {{ $response ? $response->answer : 'N/A' }}
                        </td>
                    @endforeach
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

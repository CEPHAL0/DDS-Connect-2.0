@extends('layouts.admin.app')

@section('title', 'Responses')

@section('content')
    <h1 class="flex items-center justify-center gap-5 mb-10 text-4xl font-bold text-center">
        Responses of <span class="px-3 py-2 text-lg rounded-md bg-slate-300">
            {{ $form->title }}</span>
    </h1>

    <table class="overflow-scroll">
        <thead class="text-white bg-black">
            <tr>
                <th class="px-4 text-left border border-white">S.N</th>
                @foreach ($form->questions as $question)
                    <th class="p-4 text-left border border-white w-96">{{ $question->question }}</th>
                @endforeach
            </tr>
        </thead>
        <tbody>
            @foreach ($form->responseUsers as $responseUser)
                <tr class="border-2 border-black divide-x-2 divide-y-2 divide-black">
                    <td class="h-10 px-4 border-l-2 border-black">{{ $loop->iteration }}</td>
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

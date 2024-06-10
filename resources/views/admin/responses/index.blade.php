@extends('layouts.admin.app')

@section('title', 'Form Responses')

@section('content')
    <h1 class="mb-10 text-4xl font-bold text-center">Latest Responses</h1>
    <div class="flex flex-wrap justify-center gap-5">
        @foreach ($responseUsers as $responseUser)
            <div
                class="flex items-center justify-between h-40 p-4 overflow-hidden border-2 border-black rounded-md bg-slate-100 b gap-7 w-96">
                <div class="flex flex-col items-center">
                    <img src="{{ asset('storage/images/users/' . $responseUser->user->profile_image_url) }}" alt=""
                        class="object-cover object-top w-12 h-12 rounded-full">
                    <p class="text-xs text-center truncate max-w-12">{{ $responseUser->user->username }}</p>
                </div>
                <p class="text-lg font-bold ">{{ $responseUser->form->title }}</p>
            </div>
        @endforeach
    </div>

    <h1 class="my-20 text-4xl font-bold text-center">Responses By Forms</h1>
    <table class="table table-auto">
        <thead class="px-3 py-2 text-white bg-black">
            <tr class="*:text-left h-10">
                <th class="pl-5 rounded-tl-md">S.N.</th>
                <th>Title</th>
                <th>Created By</th>
                <th class="rounded-tr-md">Responses</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($forms as $form)
                <tr class="h-10 border border-black cursor-pointer hover:bg-slate-200">
                    <td class="pl-5">{{ $loop->iteration }}</td>
                    <td>{{ $form->title }}</td>
                    <td>{{ $form->user->name }}</td>
                    <td class="py-2">
                        <a href="{{ route('adminResponses.showResponse', $form->id) }}">
                            <button
                                class="px-2 py-1 font-bold text-white rounded-md bg-darkGreen">{{ count($form->responseUsers) }}
                            </button>
                        </a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection

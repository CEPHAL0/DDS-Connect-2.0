@extends('layouts.admin.app')

@section('title', 'View Form')

@section('content')
    <div class="flex flex-col">
        <div class="flex justify-around">
            <div class="flex flex-col gap-8 w-[50%]">
                <div>
                    <h1 class="text-3xl font-bold">{{ $form->title }}</h1>
                 
                    <p class="text-sm text-gray-600">{{ $form->created_at->format('M d -  h:m') }}</p>
                </div>

                <p>{{ $form->description }}</p>


                <h1 class="mt-5 text-2xl font-bold">Questions</h1>
                <div class="flex flex-col gap-6">
                    @foreach ($form->questions as $index => $question)
                        <div class="text-lg font-semibold">{{ $loop->iteration }}. {{ $question->question }}</div>
                        @if ($question->type == 'short')
                            <input type="text" class="p-4 ml-5 rounded-md bg-slate-100" disabled>
                        @elseif ($question->type == 'long')
                            <input type="text" class="p-16 ml-5 rounded-md bg-slate-100" disabled>
                        @elseif ($question->type == 'single')
                            @foreach ($question->values as $indexValue => $value)
                                <div class="flex items-center gap-2 ml-5">
                                    <input type="radio" name="{{ $question->question }}" id="" class="w-6 h-6">
                                    <label for="">{{ $value->value }}</label>
                                </div>
                            @endforeach
                        @elseif ($question->type == 'multiple')
                            @foreach ($question->values as $indexValue => $value)
                                <div class="flex items-center gap-2 ml-5">
                                    <input type="checkbox" name="{{ $question->question }}" id="" class="w-5 h-5">
                                    <label for="">{{ $value->value }}</label>
                                </div>
                            @endforeach
                        @endif
                    @endforeach
                </div>

                <form action="{{ route('adminForms.destroy', $form->id) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="px-10 py-4 font-semibold text-white duration-200 ease-in-out bg-red-500 border border-red-500 rounded-md w-fit focus:ring-2 ring-red-500 ring-offset-1 hover:text-red-500 hover:bg-white">
                        Delete Form
                    </button>
                </form>
            </div>


            <div class="flex flex-col items-center gap-20">
                <div class="flex flex-col items-center gap-3">
                    <img src="{{ asset('storage/images/users/' . $form->user->profile_image_url) }}" alt=""
                        class="object-cover object-top w-48 h-48 rounded-full">
                    <h2>{{ $form->user->name }} - <span class="italic text-gray-500">{{ $form->user->username }}</span>
                    </h2>
                </div>

                <div>
                    <h1 class="text-xl font-bold">Filled By</h1>
                    <h1 class="text-2xl"><span class="font-extrabold ">{{ $form->responseUsers->count() }}</span> users
                    </h1>
                </div>
            </div>
        </div>
    </div>
@endsection

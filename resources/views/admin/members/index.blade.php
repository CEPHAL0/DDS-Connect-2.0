@extends('layouts.admin.app')

@section('title', 'Members Page')

@section('content')
    <div class="flex flex-col gap-16">
        <h1 class="font-bold text-4xl text-center">Club Members</h1>


        <div class="flex flex-wrap gap-x-14 gap-y-10 justify-center">
            @foreach ($members as $member)
                <div class="flex flex-col items-center gap-2">
                    <a href="{{ route('adminMembers.edit', $member->id) }}"
                        class="focus:ring-4 ring-black ring-offset-1 rounded-full">
                        <div class="relative memberCard hover:cursor-pointer">
                            <div class="hidden absolute h-48 w-48 top-0 bg-black opacity-75 rounded-full memberCardOverlay">
                                <p class="z-40 m-auto text-white mt-[45%] font-bold text-center">
                                    Edit
                                </p>
                            </div>
                            <img src="{{ asset('storage/images/users/' . $member->profile_image_url) }}" alt=""
                                class="h-48 w-48 object-top object-cover rounded-full">
                        </div>
                    </a>
                    <div class="flex flex-col items-center">
                        <p class="font-bold text-lg max-w-44 truncate text-wrap text-center">{{ $member->name }} </p>
                        <p class="text-gray-600 italic text-sm">{{ $member->username }}</p>
                    </div>
                </div>
            @endforeach
        </div>

        <a href="{{ route('adminMembers.create') }}" class="mx-auto">
            <button
                class="bg-black border border-black w-fit px-10 py-4 self-center text-white rounded-md focus:ring-2 ring-black ring-offset-1 hover:text-black hover:bg-white ease-in-out duration-200 font-semibold">
                Add Member
            </button>
        </a>
    </div>
@endsection


@section('scripts')
    <script>
        $(document).on("mouseover", ".memberCard", function() {
            $(this).children(".memberCardOverlay").show();
        });

        $(document).on("mouseleave", ".memberCard", function() {
            $(this).children(".memberCardOverlay").hide();
        });
    </script>
@endsection

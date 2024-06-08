@extends('layouts.admin.app')

@section('title', 'Edit Member')


@section('content')
    <h class="text-4xl text-center font-bold">Edit Club Member</h>
    <form action="{{ route('adminMembers.update', $member->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="flex justify-center gap-40 mt-14 items-start ">
            <div class="flex flex-col gap-10 items-center">
                <button type="button" id="profileButton" class="rounded-full border border-black">
                    <img src="{{ asset('storage/images/users/' . $member->profile_image_url) }}" alt=""
                        class="h-64 w-64 object-cover object-top rounded-full" id="profileImage">
                </button>

                <button type="submit"
                    class=" bg-black border border-black w-fit px-10 py-4 text-white rounded-md focus:ring-2 ring-black ring-offset-1 hover:text-black hover:bg-white ease-in-out duration-200 font-semibold">
                    Edit Member
                </button>


            </div>

            <input type="file" name="profile_image" class="hidden" onchange="loadFile(event)" id="profileImageInput"
                value="placeholder.jpg">

            <div class="flex flex-col gap-2 w-[30%]">
                <label for="name" class="font-bold">Name</label>
                <input type="text" name="name" class="px-4 py-3 border border-black rounded-md mb-2"
                    value="{{ $member->name }}">

                <label for="username" class="font-bold">Username</label>
                <input type="text" name="username" class="px-4 py-3 border border-black rounded-md mb-2"
                    value="{{ $member->username }}">

                <label for="" class="font-bold">Email</label>
                <input type="email" name="email" class="px-4 py-3 border border-black rounded-md "
                    value="{{ $member->email }}">
            </div>
        </div>


    </form>

    <form action="{{ route('adminMembers.destroy', $member->id) }}" class="flex justify-end mr-[15rem]" method="POST">
        @csrf
        @method('DELETE')
        <button type="submit"
            class=" bg-red-500 border border-red-500 w-fit px-10 py-4 text-white rounded-md focus:ring-2 ring-red-500 ring-offset-1 hover:text-red-500 hover:bg-white ease-in-out duration-200 font-semibold">
            Delete Member
        </button>
    </form>
@endsection


@section('scripts')
    <script>
        const loadFile = function(event) {
            let output = document.getElementById("profileImage");
            output.src = URL.createObjectURL(event.target.files[0]);
            output.onLoad = function() {
                URL.revokeObjectURL(output.src);
            }
        }

        $("#profileButton").click(function() {
            $("#profileImageInput").click();
        });
    </script>
@endsection

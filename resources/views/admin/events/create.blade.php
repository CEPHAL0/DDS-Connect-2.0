@extends('layouts.admin.app')

@section('title', 'Create Event')


@section('content')
    <h class="text-4xl text-center font-bold">Add Event</h>
    <form action="{{ route('adminEvents.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('POST')
        <div class="flex justify-center gap-40 mt-14 items-end ">
            <div class="flex flex-col gap-10 items-center">
                <button type="button" id="profileButton" class="rounded-md border border-black">
                    <img src="{{ asset('icons/upload.jpg') }}" alt=""
                        class="h-80 w-80 object-cover object-top rounded-md" id="profileImage">
                </button>

                <button type="submit"
                    class=" bg-black border border-black w-fit px-10 py-4 text-white rounded-md focus:ring-2 ring-black ring-offset-1 hover:text-black hover:bg-white ease-in-out duration-200 font-semibold">
                    Create Event
                </button>
            </div>

            <input type="file" name="event_image" class="hidden" onchange="loadFile(event)" id="profileImageInput"
                value="placeholder.jpg">

            <div class="flex flex-col gap-2 min-w-[30%] ">
                <label for="name" class="font-bold">Name</label>
                <input type="text" name="name" class="px-4 py-3 border border-black rounded-md mb-2"
                    placeholder="Event Name">

                <label for="description" class="font-bold">Description</label>
                <textarea name="description" id="" rows="9"
                    class="px-4 py-3 border border-black rounded-md mb-2 resize-none" placeholder="Event Description"></textarea>

                <div class="flex gap-2 w-[100%]">
                    <div class="flex flex-col">
                        <label for="capacity" class="font-bold">Capacity</label>
                        <input type="number" name="capacity" min=1 class="px-3 py-3 border border-black rounded-md"
                            placeholder="1">
                    </div>

                    <div class="flex flex-col">
                        <label for="price" class="font-bold">Price</label>
                        <input type="number" name="price" min=0 class="p-3 border border-black rounded-md"
                            placeholder="100">
                    </div>
                </div>
            </div>
        </div>


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

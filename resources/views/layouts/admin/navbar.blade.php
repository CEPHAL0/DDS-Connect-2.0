<nav
    class="bg-black flex justify-between h-16 px-5 m-4 rounded-[2.5rem] text-white items-center shadow-md shadow-gray-600 sticky top-4 z-[9999]">
    <img src="{{ asset('storage/images/dds_logo.png') }}" alt="" class="h-10">
    <div class="flex items-center h-[60%] *:h-full *:flex *:items-center">
        <a href="{{ route('admin.home') }}"
            class="px-2 mr-2 hover:px-3 hover:bg-white ease-in-out duration-150 rounded-3xl hover:text-black">Home</a>
        <a href="{{ route('adminForms.index') }}"
            class="px-2 mr-2 hover:px-3 hover:bg-white ease-in-out duration-150  rounded-3xl hover:text-black">Forms</a>
        <a href=""
            class="px-2 mr-2 hover:px-3 hover:bg-white ease-in-out duration-150  rounded-3xl hover:text-black">Responses</a>
        <a href=""
            class="px-2 mr-2 hover:px-3 hover:bg-white ease-in-out duration-150  rounded-3xl hover:text-black">Members</a>
        <a href=""
            class="px-2 hover:px-3 hover:bg-white ease-in-out duration-150  rounded-3xl hover:text-black">Events</a>
    </div>

    <div class="flex items-center gap-3">
        {{ auth()->user()->name }}
        <img src="{{ asset('storage/images/users/' . auth()->user()->profile_image_url) }}" alt=""
            class="h-12 aspect-square rounded-full">
    </div>
</nav>

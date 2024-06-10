<nav
    class="bg-gradient-to-r from-black to-darkGreen flex justify-between h-16 px-5 mx-4 mb-4 mt-2 rounded-[2.5rem] text-white items-center shadow-md shadow-gray-600 sticky top-2 z-[9999]">
    <img src="{{ asset('storage/images/dds_logo.png') }}" alt="" class="h-10">
    <div class="flex items-center h-[60%] *:h-full *:flex *:items-center">
        <a href="{{ route('user.home') }}"
            class="px-2 mr-2 duration-150 ease-in-out hover:px-3 hover:bg-white rounded-3xl hover:text-black">Home</a>
        <a href="{{ route('userForms.index') }}"
            class="px-2 mr-2 duration-150 ease-in-out hover:px-3 hover:bg-white rounded-3xl hover:text-black">Surveys</a>

        <a href="{{ route('userEvents.index') }}"
            class="px-2 duration-150 ease-in-out hover:px-3 hover:bg-white rounded-3xl hover:text-black">Events</a>
    </div>

    <div class="relative flex items-center gap-3 cursor-pointer" id="navbarAvatar">
        {{ auth()->user()->name }}
        <img src="{{ asset('storage/images/users/' . auth()->user()->profile_image_url) }}" alt=""
            class="object-cover object-top w-12 h-12 rounded-full">
        <div class="absolute hidden top-12 right-4" id="logout">
            <form action="{{ route('logout') }}" method="post">
                @csrf
                @method('POST')
                <button type="submit"
                    class="px-4 py-2 text-red-500 bg-white border border-red-500 rounded-md hover:bg-red-500 hover:text-white">Logout</button>
            </form>
        </div>
    </div>
</nav>

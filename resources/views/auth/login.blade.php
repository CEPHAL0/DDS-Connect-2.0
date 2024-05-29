<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        @vite('resources/css/app.css')
        <title>Login</title>
    </head>

    <body>

        <div class="min-h-screen flex">
            <div class="w-1/2 flex flex-col items-center justify-center bg-gradient-to-br from-black to-darkGreen">
                <h1 class="text-center text-5xl font-extrabold text-white">DDS Connect <span
                        class="block text-xl font-poetsen font-extralight">Re-Imagine
                        Forms</span></h1>
                <img src="{{ asset('storage/images/hero_image_login.png') }}" alt="survey_illustration" class="w-[70%]">
            </div>


            <form action="{{ route('login') }}" method="POST"
                class="border-double border-2 border-darkGreen min-h-[70%] w-[30vw] m-auto flex flex-col justify-center gap-8 rounded-md relative pb-4 pt-10 px-8">
                @csrf
                @method('POST')
                <div
                    class="absolute -top-8 left-1/2 transform -translate-x-1/2 bg-white text-2xl font-poetsen rounded-full px-4">
                    <img src="{{ asset('storage/images/dds_logo.png') }}" alt="dds-logo"
                        class="w-16 rounded-full p-4 bg-black">
                </div>
                <h1 class="text-center text-2xl font-poetsen">Login</h1>

                @if ($errors->any())
                    <div class="text-red-500">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="flex flex-col gap-2">
                    <label for="username" class="font-bold">Username</label>
                    <input type="text" name="username" class="py-3 pr-4 pl-2 rounded-md border border-lightGreen">
                </div>

                <div class="flex flex-col gap-2">
                    <label for="password" class="font-bold">Password</label>
                    <input type="password" name="password" class="py-3 pr-4 pl-2 rounded-md border border-lightGreen">
                </div>

                <button type="submit" class="bg-darkGreen px-4 py-3 rounded-md text-white font-poetsen">Login</button>


                <p class="text-center">
                    Don't Have an account? <a href="{{ route('register') }}" class="text-blue-500 font-bold">Register
                        Now</a>
                </p>
            </form>

        </div>

    </body>

</html>

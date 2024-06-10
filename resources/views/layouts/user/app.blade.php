<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        @vite('resources/css/app.css')
        <title>@yield('title')</title>
        <link rel="stylesheet"
            href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@20..48,100..700,0..1,-50..200" />
        <style>
            /* .material-symbols-outlined {
                font-variation-settings:
                    'FILL' 0,
                    'wght' 400,
                    'GRAD' 0,
                    'opsz' 10
            } */
        </style>
        @yield('styles')
    </head>

    <body>
        @include('layouts.user.navbar')

        @if (session()->has('success'))
            <li
                class="text-green-600 bg-gray-100 w-fit p-4 ml-10 rounded-md font-bold sessionContainer fixed top-24 animate-pulse">
                {{ session()->get('success') }}
            </li>
        @endif


        @if ($errors->any())
            <div class="text-red-500 p-10 sessionContainer">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="flex flex-col p-10">
            @yield('content')
        </div>
        <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
            crossorigin="anonymous"></script>
    </body>

    @yield('scripts')

    <script>
        setTimeout(() => {
            $(".sessionContainer").hide();
        }, 4000);
    </script>


    <script>
        $("#navbarAvatar").mouseenter(function() {
            $("#logout").show();
        });

        $("#navbarAvatar").mouseleave(function() {
            $("#logout").hide();
        });
    </script>

</html>

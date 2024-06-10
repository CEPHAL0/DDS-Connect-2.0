<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel Stripe integration tutorial</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
        <style>
            .bg {
                background-color: #ffc72c;
                border-color: #ffd98e #ffbe3d #de9300;
            }

            .bg:hover {
                background-color: #f7c027;
            }
        </style>
    </head>

    <body>
        <div class="container pt-5 mt-5 text-center">
            <img src="{{ asset('check-circle.svg') }}" class="tick-img">
            <h1 class="text-center">Thank you for making payment</h1>
            <h3 class="mt-3 text-center">{{ $successMessage }}</h3>

            <a href="{{ route('stripe.index') }}" class="mt-5 btn bg">Continue Shopping</a>
        </div>
    </body>

</html>

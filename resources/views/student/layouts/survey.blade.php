<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title>Document</title>
        <link
            href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/3.11.0/mdb.min.css"
            rel="stylesheet"
        />
        <link rel="stylesheet" href="{{ url('css/survey.css') }}" />

        @vite('resources/js/app.js') @vite('resources/css/app.css')
    </head>

    <body>
        <div>@yield('survey')</div>
    </body>
</html>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />

        <!-- Font Icon -->
        <link
            href="https://fonts.googleapis.com/icon?family=Material+Icons"
            rel="stylesheet"
        />
        <link
            href="https://cdnjs.cloudflare.com/ajax/libs/material-design-iconic-font/2.2.0/css/material-design-iconic-font.min.css"
            rel="stylesheet"
        />
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
            crossorigin="anonymous"
        />
        <!-- Main css -->
        <link rel="stylesheet" href="{{ url('css/auth.css') }}" />
        @vite('resources/js/app.js') @vite('resources/css/app.css')
    </head>
    <body>
        <div
            class="navbar navbar-top"
            style="padding-left: 0px; margin-left: 0px"
        >
            <div class="navbar-header">
                <div>
                    <img
                        id="Image3"
                        class="img-responsive"
                        src="{{ url('images/logo-new2.png') }}"
                        alt="Enverga University Student Information System"
                    />
                </div>
            </div>
        </div>
        <div class="main">@yield('contents')</div>

        <div class="footer-new">
            <span
                ><br />
                © Graduate Tracer
                <br />
            </span>
        </div>
    </body>
</html>

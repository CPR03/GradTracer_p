<!DOCTYPE html>
<html lang="en" data-theme="light">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />

        <!-- Font -->
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link
            href="https://fonts.googleapis.com/css2?family=Barlow:wght@100..900&display=swap"
            rel="stylesheet"
        />

        <!-- Icons -->
        <script src="https://unpkg.com/lucide@latest"></script>

        @vite('resources/css/app.css') @vite('resources/js/app.js')
    </head>
    <body class="min-h-screen bg-gray-50 font-barlow text-gray-900">
        <!-- Header -->
        <x-layout.header />

        {{-- Main Content --}}
        <main class="container mx-auto px-4 py-8 mb-16">
            @yield('contents')
        </main>

        <!-- Footer -->
        <x-layout.footer />

        <!-- Lucide Icon init -->
        <script>
            lucide.createIcons();
        </script>
    </body>
</html>

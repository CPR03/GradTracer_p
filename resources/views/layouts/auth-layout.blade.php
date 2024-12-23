<!DOCTYPE html>
<html lang="en" data-theme="light">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        <title>@yield('title')</title>

        <link
            rel="icon"
            type="image/x-icon"
            href="/images/GradTracerLogo.png"
        />

        <!-- Font -->
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link
            href="https://fonts.googleapis.com/css2?family=Barlow:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
            rel="stylesheet"
        />

        <!-- Icons -->
        <script src="https://unpkg.com/lucide@latest"></script>

        @vite('resources/css/app.css') @vite('resources/js/app.js')
    </head>

    <body class="min-h-screen bg-gray-50 font-barlow text-gray-900">
        <!-- Header -->
        <!-- <x-layout.header /> -->

        <!-- Main Content -->
        <main class="container mx-auto px-4 py-8 mb-3">
            <div class="hero z-50 min-h-screen p-6">
                <div
                    class="logBG hero-content w-full max-w-[1200px] shadow-md xs:min-h-[850px] md:min-h-[700px] xl:p-40"
                >
                    <div
                        class="flex grow items-center justify-center xs:flex-col xs:gap-6 md:flex-row md:gap-20"
                    >
                        <div
                            class="flex w-full flex-col items-center justify-center"
                        >
                            <!-- GradTracer Logo -->
                            <img
                                src="{{ url('images/GradTracerLogo.png') }}"
                                alt="Prismara Logo"
                                class="xs:w-[150px] md:w-[200px]"
                            />

                            <h1
                                class="m-0 text-2xl font-bold sm:text-2xl md:text-3xl lg:text-4xl xl:text-4xl"
                            >
                                Grad Tracer
                            </h1>
                            <p
                                class="text-lg font-semibold sm:text-md md:text-xl text-center"
                            >
                                Your graduate tracer platform by M.S.E.U.F
                            </p>
                        </div>

                        <!-- Login Form -->
                        <div
                            class="border-dotted border-gray-500 opacity-35 xs:h-[0px] xs:w-[100px] xs:border-t-[4px] md:h-[190px] md:w-[0px] md:border-l-[7px]"
                        ></div>
                        <div class="space-y-6 w-full">
                            <div class="text-center">
                                <h2 class="text-2xl font-bold text-primary">
                                    @yield('form-title')
                                </h2>
                                <p class="text-sm text-base-content/60">
                                    @yield('form-subtitle')
                                </p>
                            </div>

                            <!-- Validation Errors -->
                            <x-auth-validation-errors
                                class="mb-4 text-error text-sm"
                                :errors="$errors"
                            />

                            @if (session()->has('message'))
                            <div class="alert alert-info shadow-lg">
                                <i data-lucide="info" class="w-5 h-5"></i>
                                <span>{{ session()->get('message') }}</span>
                            </div>
                            @endif @yield('form-content')
                        </div>
                    </div>
                </div>
            </div>
        </main>

        <!-- Footer -->
        <x-layout.footer />

        <!-- Lucide Icon init -->
        <script>
            lucide.createIcons();
        </script>
    </body>
</html>

<!DOCTYPE html>
<html lang="en" data-theme="light">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <title>@yield('title')</title>

        <link
            rel="icon"
            type="image/x-icon"
            href="/images/GradTracerLogo.png"
        />

        <!-- Lucide Icons -->
        <script src="https://unpkg.com/lucide@latest"></script>

        <!-- Font -->
        <link rel="preconnect" href="https://fonts.googleapis.com" />
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
        <link
            href="https://fonts.googleapis.com/css2?family=Barlow:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
            rel="stylesheet"
        />

        <script
            defer
            src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"
        ></script>

        @vite('resources/js/app.js') @vite('resources/css/app.css')
    </head>

    <body class="min-h-screen bg-gray-50 font-barlow">
        <!-- Main Layout Container -->
        <div class="drawer lg:drawer-open">
            <input
                id="dashboard-drawer"
                type="checkbox"
                class="drawer-toggle"
            />

            <!-- Page content -->
            <div class="drawer-content flex flex-col">
                <!-- Header -->
                <header
                    class="h-16 bg-base-100 shadow-md flex items-center px-4 sticky top-0 z-40"
                >
                    <!-- Mobile Menu Button -->
                    <div class="lg:hidden">
                        <label
                            for="dashboard-drawer"
                            class="btn btn-ghost btn-sm"
                        >
                            <i data-lucide="menu" class="w-5 h-5"></i>
                        </label>
                    </div>

                    <!-- Right side header content -->
                    <div class="ml-auto flex items-center">
                        <div class="dropdown dropdown-end">
                            <label
                                tabindex="0"
                                class="btn btn-ghost btn-circle p-0"
                            >
                                <div
                                    class="w-10 h-10 rounded-full overflow-hidden hover:opacity-80 transition-opacity"
                                >
                                    <img
                                        src="{{
                                            asset(
                                                'images/default-avatar-icon.jpg'
                                            )
                                        }}"
                                        alt="Profile"
                                        class="w-full h-full object-cover"
                                    />
                                </div>
                            </label>
                            <ul
                                tabindex="0"
                                class="mt-3 z-[1] p-2 shadow-lg menu menu-sm dropdown-content bg-base-100 rounded-lg w-52 border"
                            >
                                <li>
                                    <a
                                        href="/student/profile/{{ Auth::guard('student')->user()->id }}"
                                        class="flex items-center gap-2 py-2 hover:bg-base-200 rounded-md transition-colors"
                                    >
                                        <img
                                            src="{{
                                                asset(
                                                    'images/default-avatar-icon.jpg'
                                                )
                                            }}"
                                            alt="Profile"
                                            class="w-6 h-6 object-cover rounded-full"
                                        />
                                        Profile
                                    </a>
                                </li>
                                <li>
                                    <form
                                        method="POST"
                                        action="{{ route('logout') }}"
                                        class="w-full"
                                        onclick="event.preventDefault(); this.submit();"
                                    >
                                        @csrf
                                        <button
                                            type="submit"
                                            class="flex items-center gap-2 w-full py-2 px-1 hover:bg-base-200 rounded-md transition-colors text-error"
                                        >
                                            <i
                                                data-lucide="log-out"
                                                class="w-4 h-4"
                                            ></i>
                                            Logout
                                        </button>
                                    </form>
                                </li>
                            </ul>
                        </div>
                    </div>
                </header>

                <!-- Main Content -->
                <main class="p-4 pt-5 max-w-[1250px] mx-auto flex-grow w-full">
                    @yield('content')
                </main>
            </div>

            <!-- Sidebar -->
            <div class="drawer-side z-40">
                <label for="dashboard-drawer" class="drawer-overlay"></label>
                <aside class="w-56 min-h-screen bg-gray-50">
                    <!-- Sidebar Header -->
                    <div
                        class="h-16 bg-base-100 shadow-md flex items-center px-4"
                    >
                        <div class="flex items-center gap-2">
                            <img
                            src="{{
                                asset(
                                    'images/GradTracerLogo.png'
                                )
                            }}"
                                alt="Logo"
                                class="w-9"
                            />
                            <p class="font-bold text-xl">Grad Tracer</p>
                        </div>
                    </div>

                    <!-- Navigation Links -->
                    <ul class="menu pt-5">
                        <li>
                            <a
                                href="/dashboard"
                                class="flex items-center gap-2 rounded-lg {{ Request::is('dashboard') ? 'accent-gradient text-white font-medium' : 'text-muted-foreground' }}"
                            >
                                <i data-lucide="house" class="w-4 h-4"></i>
                                Dashboard
                            </a>
                        </li>
                        <li>
                            <a
                                href="{{ route('student.survey.index') }}"
                                class="flex items-center gap-2 rounded-lg {{ Route::currentRouteNamed('student.survey.index') || Request::is('student/questionnaires/*') ? 'accent-gradient text-white font-medium' : 'text-muted-foreground' }}"
                            >
                                <i data-lucide="file-pen" class="w-4 h-4"></i>
                                Survey
                            </a>
                        </li>
                    </ul>
                </aside>
            </div>
        </div>

        <!-- Initialize Lucide Icons -->
        <script>
            lucide.createIcons();
        </script>
    </body>
</html>

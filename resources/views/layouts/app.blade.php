<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">

    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    {{-- scrip --}}
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>

</head>

<body class="h-screen font-sans antialiased leading-none bg-gray-100">



    <div id="app">
        <header class="px-4 py-0 bg-gray-800">
            <!-- header/navigation -->
            <div x-data="{ isOpen: false }" class="flex justify-between px-4 py-2 bg-gray-800 lg:px-8 lg:py-2">
                <div class="flex items-center">
                    <h3 class="text-2xl font-bold text-white">
                        <a href="{{ url('/') }}">
                            {{ config('app.name', 'Laravel') }}
                        </a>
                    </h3>
                </div>

                <!-- left header section -->
                <div class="flex items-center justify-between">
                    <button @click="isOpen = !isOpen" type="submit">
                        <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-white lg:hidden" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M4 6h16M4 12h16M4 18h16" />
                        </svg>
                    </button>
                    <div class="hidden ext-white 6space-x-6 lg:inline-block">
                        <a class="px-4 py-1 text-base no-underline border-b-2 hover:bg-indigo-300 hover:text-cool-gray-900 rounded-3xl"
                            href="{{ url('/') }}">Home</a>


                        <a class="px-4 py-1 text-sm no-underline border-b-2 hover:bg-indigo-300 hover:text-cool-gray-900 rounded-3xl"
                            href="">Housing</a>

                        <a class="px-4 py-1 text-base no-underline border-b-2 hover:bg-indigo-300 hover:text-cool-gray-900 rounded-3xl"
                            href="{{ url('/blog') }}">Blog</a>

                        {{-- 
                            
                            <a class="px-4 py-1 text-base no-underline border-b-2 hover:bg-indigo-300 hover:text-cool-gray-900 rounded-3xl"
                            href="">Notification</a> --}}

                        <button
                            class="relative px-1 py-4 text-gray-400 transition duration-150 ease-in-out border-2 border-transparent rounded-full hover:border-b-2 hover:text-cool-gray-100 focus:outline-none focus:text-gray-500"
                            aria-label="Cart">
                            <svg class="w-6 h-6 pb-0 mb-0" xmlns="http://www.w3.org/2000/svg" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                            </svg>
                            <span class="absolute inset-0 object-right-top -mr-6">
                                <div
                                    class="inline-flex items-center px-1.5 py-0.5 border-2 border-white rounded-full text-xs font-semibold leading-4 bg-red-500 text-white">
                                    6
                                </div>
                            </span>
                        </button>



                        @guest
                            <a class="px-4 py-1 text-base no-underline border-b-2 hover:bg-indigo-300 hover:text-cool-gray-900 rounded-3xl"
                                href="{{ route('login') }}">{{ __('Login') }}</a>
                            @if (Route::has('register'))
                                <a class="text-base no-underline border-b-2 hover:bg-indigo-300 hover:text-cool-gray-900 rounded-3xl"
                                    href="{{ route('register') }}">{{ __('Register') }}</a>
                            @endif
                        @else


                            <div x-data="{dropdownMenu: false}" class="relative lg:inline-block">
                                <!-- Dropdown toggle button -->
                                <button @click="dropdownMenu = ! dropdownMenu"
                                    class="px-2 py-1 text-base no-underline hover:bg-indigo-300 hover:text-cool-gray-900 rounded-3xl ">
                                    <span class="sr-only">{{ Auth::user()->name }}</span>
                                    <img class="w-8 h-8 rounded-full"
                                        src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=facearea&amp;facepad=4&amp;w=256&amp;h=256&amp;q=60"
                                        alt="avatar">
                                </button>
                                <!-- Dropdown list -->
                                <div x-show="dropdownMenu"
                                    class="absolute right-0 py-2 mt-2 bg-white bg-gray-100 rounded-md shadow-xl w-44">
                                    <a href="#"
                                        class="block px-4 py-2 text-sm text-gray-300 text-gray-700 hover:bg-gray-400 hover:text-white">
                                        Your Profile
                                    </a>

                                    <a href="#"
                                        class="block px-4 py-2 text-sm text-gray-300 text-gray-700 hover:bg-gray-400 hover:text-white">
                                        Settings
                                    </a>
                                    <a href="#"
                                        class="block px-4 py-2 text-sm text-gray-300 text-gray-700 hover:bg-gray-400 hover:text-white">
                                        Reports
                                    </a>
                                    <a href="{{ route('logout') }}"
                                        class="block px-4 py-2 text-sm text-gray-300 text-gray-700 hover:bg-gray-400 hover:text-white"
                                        onclick="event.preventDefault();document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                        class="hidden">
                                        {{ csrf_field() }}
                                    </form>
                                </div>
                            </div>



                            {{-- <span class="px-4 py-1 border-b-2 rounded-3xl">{{ Auth::user()->name }}</span>

                            <a href="{{ route('logout') }}"
                                class="px-4 py-1 text-base no-underline border-b-2 hover:bg-indigo-300 hover:text-cool-gray-900 rounded-3xl"
                                onclick="event.preventDefault();
                                                                                document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                                {{ csrf_field() }}
                            </form> --}}
                        @endguest






                    </div>

                    <!-- mobile navbar -->
                    <div class="mobile-navbar">
                        <!-- navbar wrapper -->
                        <div class="fixed left-0 w-full p-5 text-black bg-white rounded-lg shadow-xl top-16"
                            x-show="isOpen" @click.away=" isOpen = false">
                            <div class="flex flex-col space-y-6">
                                {{-- <a href="#" class="text-sm text-black">Menub1</a>
                        <a href="#" class="text-sm text-black">Menub2</a>
                        <a href="#" class="text-sm text-black">Menub3</a>
                        <a href="#" class="text-sm text-black">Menub3</a> --}}

                                <a class="px-4 py-1 text-sm no-underline border-b-2 hover:bg-indigo-300 hover:text-cool-gray-900 rounded-3xl"
                                    href="/">Home</a>

                                <a class="px-4 py-1 text-sm no-underline border-b-2 hover:bg-indigo-300 hover:text-cool-gray-900 rounded-3xl"
                                    href="">Housing</a>

                                <a class="px-4 py-1 text-sm no-underline border-b-2 hover:bg-indigo-300 hover:text-cool-gray-900 rounded-3xl"
                                    href="/blog">Blog</a>

                                <button
                                    class="relative px-1 py-4 text-gray-400 transition duration-150 ease-in-out border-2 border-transparent rounded-full hover:border-b-2 hover:text-cool-gray-100 focus:outline-none focus:text-gray-500"
                                    aria-label="Cart">
                                    <svg class="w-6 h-6 pb-0 mb-0" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 17h5l-1.405-1.405A2.032 2.032 0 0118 14.158V11a6.002 6.002 0 00-4-5.659V5a2 2 0 10-4 0v.341C7.67 6.165 6 8.388 6 11v3.159c0 .538-.214 1.055-.595 1.436L4 17h5m6 0v1a3 3 0 11-6 0v-1m6 0H9" />
                                    </svg>
                                    <span class="absolute inset-0 object-right-top -mr-6">
                                        <div
                                            class="inline  px-1.5 py-0.5 border-2 border-white rounded-full text-xs font-semibold leading-4 bg-red-500 text-white">
                                            6
                                        </div>
                                    </span>
                                </button>

                                @guest
                                    <a class="px-4 py-1 text-sm no-underline border-b-2 hover:bg-indigo-300 hover:text-cool-gray-900 rounded-3xl"
                                        href="{{ route('login') }}">{{ __('Login') }}</a>
                                    @if (Route::has('register'))
                                        <a class="text-sm no-underline border-b-2 hover:bg-indigo-300 hover:text-cool-gray-900 rounded-3xl"
                                            href="{{ route('register') }}">{{ __('Register') }}</a>
                                    @endif
                                @else
                                    <div x-data="{dropdownMenu: false}" class="relative lg:inline-block">
                                        <!-- Dropdown toggle button -->
                                        <button @click="dropdownMenu = ! dropdownMenu"
                                            class="px-2 py-1 text-base no-underline hover:bg-indigo-300 hover:text-cool-gray-900 rounded-3xl ">
                                            <span class="sr-only">{{ Auth::user()->name }}</span>
                                            <img class="w-8 h-8 rounded-full"
                                                src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?ixlib=rb-1.2.1&amp;ixid=eyJhcHBfaWQiOjEyMDd9&amp;auto=format&amp;fit=facearea&amp;facepad=4&amp;w=256&amp;h=256&amp;q=60"
                                                alt="avatar">
                                        </button>
                                        <!-- Dropdown list -->
                                        <div x-show="dropdownMenu"
                                            class="relative right-0 py-2 mt-2 bg-white bg-gray-100 rounded-md shadow-xl w-44">
                                            <a href="#"
                                                class="block px-4 py-2 text-sm text-gray-300 text-gray-700 hover:bg-gray-400 hover:text-white">
                                                Your Profile
                                            </a>

                                            <a href="#"
                                                class="block px-4 py-2 text-sm text-gray-300 text-gray-700 hover:bg-gray-400 hover:text-white">
                                                Settings
                                            </a>
                                            <a href="#"
                                                class="block px-4 py-2 text-sm text-gray-300 text-gray-700 hover:bg-gray-400 hover:text-white">
                                                Reports
                                            </a>
                                            <a href="{{ route('logout') }}"
                                                class="block px-4 py-2 text-sm text-gray-300 text-gray-700 hover:bg-gray-400 hover:text-white"
                                                onclick="event.preventDefault();document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                                class="hidden">
                                                {{ csrf_field() }}
                                            </form>
                                        </div>
                                    </div>
                                @endguest
                            </div>
                        </div>
                    </div>
                    <!-- end mobile navbar -->
                </div>
                <!-- right header section -->

            </div>





            {{-- <div class="container flex items-center justify-between px-6 mx-auto">
                <div>
                    <a href="{{ url('/') }}" class="text-lg font-semibold text-gray-100 no-underline">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div>

                <nav class="px-4 space-x-4 text-sm text-gray-300 sm:text-base">
                    <div class="grid grid-cols-1 m-auto border-gray-700 w-fill sm:grid-flow-col">
                        <a class="px-4 py-1 no-underline hover:bg-indigo-300 hover:text-cool-gray-900 rounded-3xl"
                            href="/">Home</a>

                        <a class="px-4 py-1 no-underline hover:bg-indigo-300 hover:text-cool-gray-900 rounded-3xl"
                            href="/blog">Blog</a>

                        <a class="px-4 py-1 no-underline hover:bg-indigo-300 hover:text-cool-gray-900 rounded-3xl"
                            href="">Notification</a>

                        @guest
                            <a class="px-4 py-1 no-underline hover:bg-indigo-300 hover:text-cool-gray-900 rounded-3xl"
                                href="{{ route('login') }}">{{ __('Login') }}</a>
                            @if (Route::has('register'))
                                <a class="no-underline hover:bg-indigo-300 hover:text-cool-gray-900 rounded-3xl"
                                    href="{{ route('register') }}">{{ __('Register') }}</a>
                            @endif
                        @else
                            <span class="px-4 py-1 ">{{ Auth::user()->name }}</span>

                            <a href="{{ route('logout') }}"
                                class="px-4 py-1 no-underline hover:bg-indigo-300 hover:text-cool-gray-900 rounded-3xl"
                                onclick="event.preventDefault();
                                                        document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                                {{ csrf_field() }}
                            </form>
                        @endguest
                    </div>
                </nav>

            </div> --}}
        </header>
        <div>
            @yield('content')
        </div>
        <div>
            @include('layouts.footer')
        </div>
    </div>
</body>

</html>

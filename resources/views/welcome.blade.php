<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel App') }}</title>

    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        /* ===== Animated SaaS Background ===== */
        body {
            background: linear-gradient(-45deg, #0f172a, #1e293b, #0b1220, #111827);
            background-size: 400% 400%;
            animation: gradientFlow 18s ease infinite;
        }

        @keyframes gradientFlow {
            0% { background-position: 0% 50%; }
            50% { background-position: 100% 50%; }
            100% { background-position: 0% 50%; }
        }

        /* ===== Glass Effect (CLEAN SINGLE DEFINITION) ===== */
        .glass {
            background: rgba(255, 255, 255, 0.06);
            backdrop-filter: blur(18px);
            -webkit-backdrop-filter: blur(18px);
            border: 1px solid rgba(255, 255, 255, 0.08);
            box-shadow: 0 10px 30px rgba(0,0,0,0.25);
            border-radius: 14px;
        }

        .light-glass {
            background: rgba(255, 255, 255, 0.75);
            backdrop-filter: blur(14px);
            -webkit-backdrop-filter: blur(14px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        /* Smooth hover */
        .hover-pop {
            transition: all 0.25s ease;
        }
        .hover-pop:hover {
            transform: translateY(-2px);
        }
    </style>
</head>

<body class="text-white min-h-screen flex flex-col">

<!-- NAV -->
<nav class="glass mx-4 mt-4 flex items-center justify-between px-6 py-4 sticky top-0 z-50">

    <a href="{{ url('/') }}" class="text-lg font-semibold tracking-tight">
        {{ config('app.name', 'Laravel App') }}
    </a>

    <div class="flex items-center gap-6 text-sm">

        <a href="{{ url('/') }}" class="opacity-80 hover:opacity-100 transition">Home</a>

        @auth
            <a href="{{ url('/dashboard') }}" class="opacity-80 hover:opacity-100 transition">Dashboard</a>
            <a href="{{ url('/notifications') }}" class="opacity-80 hover:opacity-100 transition">Notifications</a>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="text-red-400 hover:text-red-300 transition">
                    Logout
                </button>
            </form>
        @else
            <a href="{{ route('login') }}" class="opacity-80 hover:opacity-100 transition">Login</a>

            @if (Route::has('register'))
                <a href="{{ route('register') }}"
                   class="px-4 py-1 rounded-full glass hover-pop">
                    Register
                </a>
            @endif
        @endauth

    </div>
</nav>

<!-- HERO -->
<main class="flex-1 flex items-center justify-center px-6 py-16">

    <div class="glass max-w-3xl w-full p-12 text-center hover-pop">

        <h1 class="text-4xl md:text-5xl font-bold mb-5 leading-tight">
            Enterprise Notification System
        </h1>

        <p class="text-sm md:text-base opacity-80 mb-10 max-w-xl mx-auto">
            A scalable Laravel SaaS platform for managing Email, SMS, and In-App notifications with analytics, audit logs, and real-time event tracking.
        </p>

        <div class="flex gap-4 justify-center flex-wrap">

            @auth
                <a href="{{ url('/dashboard') }}"
                   class="px-6 py-3 rounded-full glass hover-pop">
                    Open Dashboard
                </a>

                <a href="{{ url('/notifications') }}"
                   class="px-6 py-3 rounded-full glass hover-pop">
                    View Notifications
                </a>
            @else
                <a href="{{ route('login') }}"
                   class="px-6 py-3 rounded-full glass hover-pop">
                    Get Started
                </a>
            @endauth

        </div>
    </div>

</main>

<!-- FOOTER -->
<footer class="text-center text-xs opacity-60 py-6">
    © {{ date('Y') }} {{ config('app.name', 'Laravel App') }}. Built for scalability.
</footer>

</body>
</html>
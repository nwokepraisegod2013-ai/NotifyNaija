<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Notification System</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            background: radial-gradient(circle at top, #0f172a, #020617);
            color: white;
        }
    </style>
</head>

<body class="min-h-screen">

<!-- NAVBAR -->
<nav class="p-4 flex justify-between items-center border-b border-white/10 bg-black/30 backdrop-blur">
    <h1 class="font-bold">📡 Notification System</h1>

    <div class="space-x-4 text-sm">

        <a href="{{ route('notifications.index') }}" class="hover:text-blue-400">
            Dashboard
        </a>

        <a href="{{ route('notifications.index') }}" class="hover:text-blue-400">
            Notifications
        </a>

    </div>
</nav>

<!-- PAGE CONTENT -->
<main class="p-6">

    @yield('content')

</main>

</body>
</html>
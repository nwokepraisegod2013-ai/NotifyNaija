<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Notification Dashboard</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: ui-sans-serif, system-ui;
        }
    </style>
</head>

<body class="bg-gradient-to-br from-black via-gray-950 to-gray-900 text-white min-h-screen">

<!-- BACKGROUND GLOW -->
<div class="fixed inset-0 overflow-hidden pointer-events-none">
    <div class="absolute w-[600px] h-[600px] bg-purple-600/20 blur-3xl rounded-full top-[-200px] left-[-200px]"></div>
    <div class="absolute w-[500px] h-[500px] bg-blue-600/20 blur-3xl rounded-full bottom-[-200px] right-[-200px]"></div>
</div>

<!-- TOP NAVIGATION -->
<nav class="relative flex justify-between items-center px-6 py-4 border-b border-white/10 bg-black/30 backdrop-blur-xl">

    <div class="font-bold text-lg">
        📡 Notification System
    </div>

    <div class="flex gap-5 text-sm">

        <a href="{{ route('notifications.index') }}" class="hover:text-blue-400">
            Dashboard
        </a>

        <a href="{{ route('notifications.index') }}" class="hover:text-blue-400">
            Notifications
        </a>

        <a href="#" class="hover:text-blue-400">
            Analytics
        </a>

        <a href="#" class="hover:text-blue-400">
            Settings
        </a>

    </div>

</nav>

<div class="relative max-w-6xl mx-auto p-6">

    <!-- HEADER -->
    <div class="flex items-center justify-between mb-8">

        <div>
            <h1 class="text-3xl font-bold">Notification System</h1>
            <p class="text-gray-400 text-sm">
                Backend-driven real-time notification dashboard
            </p>
        </div>

        <div class="flex gap-3">

            <!-- FIXED NAV BUTTON -->
            <a href="{{ route('notifications.index') }}"
               class="px-4 py-2 rounded-xl bg-white/10 hover:bg-white/20 transition border border-white/10">
                Refresh
            </a>

            <span class="px-4 py-2 rounded-xl bg-green-500/20 border border-green-500/30">
                Online
            </span>

        </div>

    </div>

    <!-- GRID LAYOUT -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

        <!-- SEND PANEL -->
        <div class="md:col-span-1">

            <div class="backdrop-blur-xl bg-white/5 border border-white/10 rounded-2xl p-5 shadow-xl">

                <h2 class="text-lg font-semibold mb-4">Send Notification</h2>

                <form class="space-y-3">

                    <input type="text" placeholder="User ID"
                        class="w-full bg-black/30 border border-white/10 rounded-xl p-3">

                    <input type="text" placeholder="Title"
                        class="w-full bg-black/30 border border-white/10 rounded-xl p-3">

                    <textarea rows="4" placeholder="Message"
                        class="w-full bg-black/30 border border-white/10 rounded-xl p-3"></textarea>

                    <select class="w-full bg-black/30 border border-white/10 rounded-xl p-3">
                        <option>Email</option>
                        <option>SMS</option>
                        <option>Push</option>
                    </select>

                    <button type="button"
                        class="w-full bg-blue-600 hover:bg-blue-700 transition rounded-xl p-3 font-semibold">
                        Send Notification
                    </button>

                </form>

            </div>

        </div>

        <!-- FEED -->
        <div class="md:col-span-2">

            <div class="backdrop-blur-xl bg-white/5 border border-white/10 rounded-2xl p-5">

                <!-- HEADER -->
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-lg font-semibold">Live Notifications</h2>

                    <div class="flex gap-2 text-xs">
                        <span class="px-3 py-1 bg-green-500/20 rounded-full">Active</span>
                        <span class="px-3 py-1 bg-white/10 rounded-full">0 Unread</span>
                    </div>
                </div>

                <!-- FILTERS -->
                <div class="flex gap-2 mb-4">
                    <button class="px-3 py-1 rounded-lg bg-white/10">All</button>
                    <button class="px-3 py-1 rounded-lg bg-white/5">Email</button>
                    <button class="px-3 py-1 rounded-lg bg-white/5">SMS</button>
                    <button class="px-3 py-1 rounded-lg bg-white/5">Push</button>
                </div>

                <!-- LIST -->
                <div class="space-y-3">

                    <div class="p-4 rounded-xl bg-white/5 border border-white/10">
                        <div class="flex justify-between">
                            <h3 class="font-semibold">System Ready</h3>
                            <span class="text-xs text-gray-400">now</span>
                        </div>

                        <p class="text-sm text-gray-300 mt-1">
                            Your notification system is fully operational.
                        </p>

                        <!-- FIXED NAV LINK -->
                        <div class="mt-3">
                            <a href="{{ route('notifications.index') }}"
                               class="text-blue-400 text-xs hover:underline">
                                Open Dashboard →
                            </a>
                        </div>
                    </div>

                </div>

            </div>

        </div>

    </div>

</div>

</body>
</html>
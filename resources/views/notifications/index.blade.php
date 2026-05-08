<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Notification Dashboard</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body {
            background: radial-gradient(circle at top, #0f172a, #020617);
            color: white;
        }

        .glass {
            background: rgba(255, 255, 255, 0.06);
            backdrop-filter: blur(18px);
            border: 1px solid rgba(255, 255, 255, 0.08);
        }

        .glow {
            box-shadow: 0 0 40px rgba(59,130,246,0.15);
        }
    </style>
</head>

<body class="min-h-screen flex">

<!-- SIDEBAR -->
<aside class="w-64 p-6 glass glow">
    <h1 class="text-xl font-bold mb-8">📡 Notification System</h1>

    <nav class="space-y-4 text-sm">

        <a href="{{ route('notifications.index') }}"
           class="block hover:text-blue-400">
            📬 All Notifications
        </a>

        <a href="#"
           class="block hover:text-blue-400">
            📊 Analytics
        </a>

        <a href="#"
           class="block hover:text-blue-400">
            🔔 Real-time Feed
        </a>

        <a href="#"
           class="block hover:text-blue-400">
            🧠 Audit Logs
        </a>

        <a href="#"
           class="block hover:text-blue-400">
            ⚙️ Settings
        </a>

    </nav>
</aside>

<!-- MAIN CONTENT -->
<main class="flex-1 p-8">

    <!-- HEADER -->
    <div class="flex justify-between items-center mb-6">

        <h2 class="text-2xl font-bold">Dashboard</h2>

        <!-- FIXED BUTTON NAVIGATION -->
        <a href="{{ route('notifications.index') }}"
           class="px-4 py-2 rounded-lg glass hover:bg-blue-500/20 transition">
            ➕ Send Notification
        </a>

    </div>

    <!-- STATS -->
    <div class="grid grid-cols-3 gap-4 mb-8">

        <div class="glass p-4 rounded-xl">
            <p class="text-sm text-gray-300">Total</p>
            <h3 class="text-2xl font-bold">
                {{ $notifications->count() ?? 0 }}
            </h3>
        </div>

        <div class="glass p-4 rounded-xl">
            <p class="text-sm text-gray-300">Latest</p>
            <h3 class="text-2xl font-bold">Live Feed</h3>
        </div>

        <div class="glass p-4 rounded-xl">
            <p class="text-sm text-gray-300">System</p>
            <h3 class="text-2xl font-bold text-green-400">Active</h3>
        </div>

    </div>

    <!-- NOTIFICATIONS LIST -->
    <div class="space-y-4">

        @forelse ($notifications as $n)

            <div class="glass p-5 rounded-xl hover:scale-[1.01] transition glow">

                <div class="flex justify-between items-center">
                    <h3 class="text-lg font-semibold">
                        {{ $n->title }}
                    </h3>

                    <span class="text-xs text-gray-400">
                        #{{ $n->id }}
                    </span>
                </div>

                <p class="text-gray-300 mt-2">
                    {{ $n->message }}
                </p>

                <div class="mt-4 flex justify-between items-center">

                    <!-- FIXED ROUTE -->
                    <a href="{{ route('notifications.show', $n->id) }}"
                       class="text-blue-400 hover:underline text-sm">
                        View Details →
                    </a>

                    <span class="text-xs text-gray-500">
                        {{ $n->created_at }}
                    </span>

                </div>

            </div>

        @empty

            <div class="glass p-6 rounded-xl text-center text-gray-400">
                No notifications yet.
            </div>

        @endforelse

    </div>

</main>

</body>
</html>
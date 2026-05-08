<div class="glass p-6 rounded-xl shadow-lg hover:shadow-xl transition">

    <!-- Header -->
    <div class="flex items-center justify-between mb-5">
        <h2 class="text-lg font-semibold">Analytics Overview</h2>

        <span class="text-xs opacity-60">
            Real-time SaaS Intelligence
        </span>
    </div>

    <!-- LIVE STREAM COUNTER -->
    <div class="mb-6 p-4 rounded-lg bg-white/5 dark:bg-black/20 border border-white/10">
        <p class="text-xs opacity-60">Live Notifications (WebSocket)</p>

        <p id="live-notifications" class="text-2xl font-bold text-white">
            {{ $totalNotifications }}
        </p>
    </div>

    <!-- METRICS GRID (CACHE-FIRST VALUES) -->
    <div class="grid grid-cols-2 md:grid-cols-3 gap-4 text-sm">

        <!-- Users -->
        <div class="p-3 rounded-lg bg-white/5 border border-white/10">
            <p class="opacity-60 text-xs">Total Users</p>
            <p class="text-lg font-semibold">{{ $totalUsers }}</p>
        </div>

        <!-- Notifications -->
        <div class="p-3 rounded-lg bg-white/5 border border-white/10">
            <p class="opacity-60 text-xs">Notifications</p>
            <p class="text-lg font-semibold">
                {{ $totalNotifications }}
            </p>
        </div>

        <!-- Sent -->
        <div class="p-3 rounded-lg bg-white/5 border border-white/10">
            <p class="opacity-60 text-xs">Sent</p>
            <p class="text-lg font-semibold text-green-400">
                {{ $sentNotifications }}
            </p>
        </div>

        <!-- Failed -->
        <div class="p-3 rounded-lg bg-white/5 border border-white/10">
            <p class="opacity-60 text-xs">Failed</p>
            <p class="text-lg font-semibold text-red-400">
                {{ $failedNotifications }}
            </p>
        </div>

        <!-- Pending -->
        <div class="p-3 rounded-lg bg-white/5 border border-white/10">
            <p class="opacity-60 text-xs">Pending</p>
            <p class="text-lg font-semibold text-yellow-400">
                {{ $pendingNotifications }}
            </p>
        </div>

        <!-- Delivery Rate -->
        <div class="p-3 rounded-lg bg-white/5 border border-white/10">
            <p class="opacity-60 text-xs">Delivery Rate</p>
            <p class="text-lg font-semibold">
                {{ number_format($deliveryRate, 2) }}%
            </p>
        </div>

        <!-- 🧠 SYSTEM HEALTH (INTELLIGENCE LAYER) -->
        <div class="p-3 rounded-lg bg-white/5 border border-white/10">
            <p class="opacity-60 text-xs">System Health</p>

            <p class="text-lg font-semibold
                @if($healthScore > 80) text-green-400
                @elseif($healthScore > 50) text-yellow-400
                @else text-red-400
                @endif">
                {{ number_format($healthScore, 1) }}%
            </p>
        </div>

    </div>
</div>
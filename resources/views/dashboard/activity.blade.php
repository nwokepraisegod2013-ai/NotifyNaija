<div class="glass p-6 rounded-xl hover:shadow-xl transition">

    <div class="flex items-center justify-between mb-4">
        <h2 class="text-lg font-semibold">Live Activity Feed</h2>

        <span class="text-xs opacity-60">
            Latest {{ $events->count() }} events
        </span>
    </div>

    <div class="space-y-3 text-sm max-h-80 overflow-y-auto pr-2">

        @forelse($events as $event)

            <div class="flex items-start gap-3 p-3 rounded-lg bg-white/5 dark:bg-black/20 border border-white/10">

                <!-- Status Dot -->
                <span class="mt-1 h-2 w-2 rounded-full 
                    @if($event->event_type === 'sent') bg-green-400
                    @elseif($event->event_type === 'failed') bg-red-400
                    @else bg-blue-400
                    @endif">
                </span>

                <!-- Content -->
                <div class="flex-1">
                    <p class="font-medium">
                        🔔 {{ ucfirst($event->event_type) }}
                    </p>

                    @if($event->payload)
                        <p class="text-xs opacity-70 mt-1">
                            {{ Str::limit($event->payload, 80) }}
                        </p>
                    @endif
                </div>

                <!-- Time -->
                <span class="text-xs opacity-50 whitespace-nowrap">
                    {{ $event->created_at->diffForHumans() }}
                </span>

            </div>

        @empty

            <div class="text-center py-10 opacity-60">
                No activity yet. Events will appear here in real-time.
            </div>

        @endforelse

    </div>
</div>
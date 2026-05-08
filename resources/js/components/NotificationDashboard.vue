<template>
<div class="flex h-screen bg-black text-white">

    <!-- SIDEBAR -->
    <div class="w-64 bg-white/5 backdrop-blur-xl border-r border-white/10 p-5">
        <h1 class="text-xl font-bold mb-8">📡 Notification Hub</h1>

        <nav class="space-y-3">
            <button class="w-full text-left hover:bg-white/10 p-2 rounded">
                Dashboard
            </button>
            <button class="w-full text-left hover:bg-white/10 p-2 rounded">
                Send Notification
            </button>
            <button class="w-full text-left hover:bg-white/10 p-2 rounded">
                Audit Logs
            </button>
        </nav>
    </div>

    <!-- MAIN -->
    <div class="flex-1 p-6 overflow-auto">

        <!-- HEADER -->
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold">Live Notifications</h2>

            <button @click="sendTest"
                class="px-4 py-2 bg-blue-500/80 hover:bg-blue-500 rounded-xl">
                Send Test
            </button>
        </div>

        <!-- GRID -->
        <div class="grid grid-cols-3 gap-4">

            <!-- LIVE STREAM -->
            <div class="col-span-2 bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-4">
                <h3 class="mb-3 font-semibold">Realtime Feed</h3>

                <div v-for="n in notifications" :key="n.id"
                    class="p-3 mb-2 bg-white/10 rounded-lg hover:bg-white/20 transition">
                    <p class="font-bold">{{ n.title }}</p>
                    <p class="text-sm opacity-70">{{ n.message }}</p>
                </div>
            </div>

            <!-- STATS -->
            <div class="bg-white/5 backdrop-blur-xl border border-white/10 rounded-2xl p-4">
                <h3 class="font-semibold mb-3">Stats</h3>

                <p>Total: {{ notifications.length }}</p>
                <p>Live Mode: ON</p>
                <p class="text-green-400">Pusher Connected</p>
            </div>

        </div>

        <!-- TOAST -->
        <div v-if="toast.show"
             class="fixed bottom-5 right-5 bg-green-500 text-white px-4 py-2 rounded-xl shadow-xl">
            {{ toast.message }}
        </div>

    </div>
</div>
</template>

<script>
import axios from 'axios';

export default {
    data() {
        return {
            notifications: [],
            toast: {
                show: false,
                message: ''
            }
        }
    },

    mounted() {
        this.fetchNotifications();

        // REAL-TIME LISTENER
        window.Echo.channel('notifications')
            .listen('NotificationEvent', (e) => {
                this.notifications.unshift(e.notification);
                this.showToast('New Notification Received');
            });
    },

    methods: {
        fetchNotifications() {
            axios.get('/api/notifications')
                .then(res => {
                    this.notifications = res.data.data.data;
                });
        },

        sendTest() {
            axios.post('/api/notifications/send', {
                user_id: 1,
                title: 'Test Alert',
                message: 'This is a live notification',
                channel: 'email'
            }).then(() => {
                this.showToast('Notification Sent');
            });
        },

        showToast(msg) {
            this.toast.message = msg;
            this.toast.show = true;

            setTimeout(() => {
                this.toast.show = false;
            }, 3000);
        }
    }
}
</script>
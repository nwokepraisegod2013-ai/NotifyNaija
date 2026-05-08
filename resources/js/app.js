import './bootstrap';

import Alpine from 'alpinejs';
window.Alpine = Alpine;
Alpine.start();

/**
 * 📡 REAL-TIME BROADCASTING (Laravel Echo + Pusher)
 */
import Echo from 'laravel-echo';
import Pusher from 'pusher-js';

window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: import.meta.env.VITE_PUSHER_APP_KEY,
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
    forceTLS: true,
});

/**
 * 🔥 LIVE NOTIFICATION LISTENER
 */
window.Echo.channel('notifications')
    .listen('.notification.sent', (e) => {
        console.log('Live update:', e);

        // 🧠 Update counter safely
        const counter = document.getElementById('live-notifications');

        if (counter) {
            counter.innerText = parseInt(counter.innerText || 0) + 1;
        }

        // Optional: trigger UI toast
        if (window.dispatchEvent) {
            window.dispatchEvent(new CustomEvent('notification-received', {
                detail: e
            }));
        }
    });
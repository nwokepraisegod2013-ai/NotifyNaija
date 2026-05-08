<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Notification Detail</title>

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

<body class="min-h-screen flex items-center justify-center p-10">

    <div class="w-full max-w-2xl glass glow rounded-xl p-8">

        <!-- HEADER -->
        <div class="flex justify-between items-center mb-6">

            <h1 class="text-2xl font-bold">
                {{ $notification->title }}
            </h1>

            <span class="text-xs text-gray-400">
                #{{ $notification->id }}
            </span>

        </div>

        <!-- MESSAGE -->
        <p class="text-gray-300 text-lg leading-relaxed mb-8">
            {{ $notification->message }}
        </p>

        <!-- FOOTER ACTIONS -->
        <div class="flex justify-between items-center">

            <!-- FIXED BACK NAVIGATION -->
            <a href="{{ route('notifications.index') }}"
               class="text-blue-400 hover:underline">
                ← Back to Notifications
            </a>

            <span class="text-xs text-gray-500">
                {{ $notification->created_at }}
            </span>

        </div>

    </div>

</body>
</html>
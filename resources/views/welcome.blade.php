<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        @vite('resources/css/app.css')

        <title>Respekt</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600,800&display=swap" rel="stylesheet" />

    </head>
    <body class="antialiased">
        <div class="relative sm:flex sm:justify-center sm:items-center min-h-screen bg-dots-darker bg-center bg-gray-100 dark:bg-gray-100 selection:bg-red-500 selection:text-white">

            <div class="max-w-7xl mx-auto p-6 lg:p-8">
                <h1 class="text-gray-800 text-3xl font-bold">Hei</h1>
                <p class="mt-4 text-gray-800text-xl leading-relaxed">
                    Velkommen til Respekt
                </p>
            </div>
        </div>
    </body>
</html>

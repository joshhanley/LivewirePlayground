<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Livewire Playground</title>

        <livewire:styles />
        <link href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css" rel="stylesheet">
        <style>
            [x-cloak] {
                display:none;
            }
        </style>
        @stack('styles')


        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.7.3/dist/alpine.min.js" defer></script>
    </head>
    <body class="antialiased">
        <livewire:main/>
        <livewire:scripts />
        @stack('scripts')
    </body>
</html>

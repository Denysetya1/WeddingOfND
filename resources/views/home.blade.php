<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

        <title>Nada & Deny Wedding Invitation</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
        <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet" />
        <link href="https://pbutcher.uk/flipdown/css/flipdown/flipdown.css" rel="stylesheet" />
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css'])
        <!-- Styles -->
        @livewireStyles
    </head>
    <body class="font-sans antialiased">
        <div class=" fixed h-full w-full bg-neutral-100" style="z-index: 9999;display:block;" id="loading">
            <div class=" absolute" style="top: 50%;left: 50%;transform: translate(-50%, -50%);">
                <div class="bounceball"></div>
                <div class="text-loading">MEMUAT</div>
            </div>
        </div>
        @livewire('home', [$data, $uslug])
        <div class="min-h-screen">
        </div>

        @stack('modals')

        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://pbutcher.uk/flipdown/js/flipdown/flipdown.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.8/clipboard.min.js"></script>
        @vite('resources/js/app.js')
        @livewireScripts
        <script>
            const wait = (delay = 0) => new Promise(resolve => setTimeout(resolve, delay));

            const setVisible = (elementOrSelector, visible) =>
            (typeof elementOrSelector === 'string'
                ? document.querySelector(elementOrSelector)
                : elementOrSelector
            ).style.display = visible ? 'block' : 'none';
            setVisible('#loading', true);

            document.addEventListener('DOMContentLoaded', () =>
            wait(2000).then(() => {
                setVisible('#loading', false);
            })
            );
            document.addEventListener('DOMContentLoaded', () =>
            wait(4000).then(() => {
                setVisible('#close', true);
            })
            );
        </script>
        @yield('page-script2')
        @yield('page-script')
        @stack('scripts')
    </body>
</html>

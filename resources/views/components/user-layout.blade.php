<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'SweetMart' }}</title>

    {{-- LOAD CSS & JS --}}
    @vite([
        'resources/css/app.css',
        'resources/js/app.js'
    ])
</head>

<body class="bg-softgray">

    @include('layouts.navigation')

    <main class="min-h-screen">
        {{ $slot }}
    </main>

    @include('layouts.footer')

</body>
</html>
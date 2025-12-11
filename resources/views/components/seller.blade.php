<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Seller • {{ $title ?? '' }}</title>

    @vite([
        'resources/css/app.css',
        'resources/css/seller.css',
        'resources/js/app.js'
    ])
</head>

<body class="bg-gray-100">

    {{-- SIDEBAR --}}
    @include('seller.partials.sidebar')

    {{-- MAIN AREA --}}
    <main class="seller-main">
        <h1 class="text-2xl font-bold mb-6">{{ $title ?? '' }}</h1>
        {{ $slot }}
    </main>

</body>
</html>
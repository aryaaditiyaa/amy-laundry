<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title ?? null }} - AMY LANDRY</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="antialiased relative">

<div class="relative min-h-screen">
    @if(auth()->user()?->role === 'admin')
        @include('components.navbar')
        @include('components.sidebar')
    @endif

    @yield('content')
</div>

@include('components.toast')

</body>

@stack('script')
</html>

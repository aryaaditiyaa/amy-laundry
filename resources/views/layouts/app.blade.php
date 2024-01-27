<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title ?? null }} - HOME LAUNDRY</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body class="antialiased relative">

@include('components.navbar')
@if(auth()->user()?->role === 'admin')
    @include('components.sidebar')
@endif

<div class="relative min-h-screen">
    @yield('content')
</div>
@include('components.footer')

@include('components.toast')

</body>
@stack('script')
</html>

<!doctype html>
<html :class="{ 'theme-dark': dark }" x-data="data()" lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bot Telegram CAMABA SNBT 2023 || {{ $title }}</title>
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.css" /> --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">

    <link rel="stylesheet" href="{{ asset('/css') }}/style.navbar.css">
    <link rel="stylesheet" href="{{ asset('/css') }}/style.css">
    <link rel="stylesheet" href="{{ asset('/public/pages') }}/../assets/css/tailwind.output.css" />
    <link rel="shortcut icon" href="{{ asset('/icon') }}/favicon.ico" type="image/x-icon">

    <script src="{{ asset('/public/pages') }}/../assets/js/init-alpine.js"></script>
    <script src="{{ asset('/public') }}/assets/js/charts-pie.js" defer></script>
    <script src="{{ asset('/public') }}/assets/js/charts-lines.js" defer></script>

    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.x.x/dist/alpine.min.js" defer></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.9.3/Chart.min.js" defer></script> --}}
</head>

<body>

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="google-site-verification" content="84zQHhyDiKJvI4Vp1oomWGcNw48_FEtc0HalOxAWWZw" />
    <meta name="author" content="Oasys Edutech Indonesia">
    <meta name="description"
        content="Sistem AI yang cerdas untuk membantu guru mendapatkan referensi kreatif dan mempermudah administrasi akademik dengan cepat!">
    <meta name="keywords" content="brainys, oasys, brainys oasys, login oasys, login brainys" />
    <meta property="og:title" content="Brainys - Log In" />
    <meta name="author" content="Oasys Edutech Indonesia">
    <link rel="canonical" href="https://brainys.oasys.id/login">




    <title>@yield('title', 'Brainys – Permudah Administrasi Akademik Guru, Tingkatkan Kualitas Pembelajaran!')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ url('images/newicon.png') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
</head>

<body>
    <main>
        @yield('content')
    </main>
</body>

</html>

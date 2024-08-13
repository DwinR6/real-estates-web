<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title inertia>{{ config('app.name', 'JC & DGD Urbano') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/feather-icons/4.28.0/feather.min.js"
        integrity="sha512-7x3zila4t2qNycrtZ31HO0NnJr8kg2VI67YLoRSyi9hGhRN66FHYWr7Axa9Y1J9tGYHVBPqIjSE1ogHrJTz51g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <!-- logo -->
    <link rel="icon" href="{{ Vite::asset('resources/image/logo-jc.jpg') }}" type="image/x-icon"
        class="rounded-full h-4 w-10">

    <link rel="icon" href="{{ Vite::asset('resources/image/logo-dgd.jpg') }}" type="image/x-icon"
        class="rounded-full h-4 w-10">
    <!-- Scripts -->
    @routes
    @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
    @inertiaHead


</head>


<body class="font-sans antialiased">

    @inertia

    <script>
        feather.replace();
    </script>

</body>



</html>

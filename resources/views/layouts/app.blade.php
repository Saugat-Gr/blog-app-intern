<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BlogSite</title>

    @vite(['resources/css/app.css','resources/js/app.js'])
</head>

<body>

@include('includes.header')

<div class="container-sm">
    @yield('content')
</div>

<script>
    window.flash = @json(session('toastr'));
</script>

@stack('scripts')   {{-- scripts run AFTER vite --}}

</body>
</html>
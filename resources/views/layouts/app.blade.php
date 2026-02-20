<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ env('APP_NAME', 'DEMO') }}</title>
    @vite('resources/css/app.css')
</head>
<body>

@include('includes.header')

  <div class="container-sm">
    @yield('content')
</div>

    @vite('resources/js/app.js')
</body>
</html>
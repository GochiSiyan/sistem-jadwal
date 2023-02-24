<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
    <title>Sistem Jadwal</title>
</head>
<body>
    <h1>Sistem Jadwal</h1>
    <div>
        <a href="/">Home</a>
        <a href="/jadwal">Jadwal</a>
        <a href="/user">User</a>
    </div>
    @if ($errors)
        <div class="text-red-500">
            {{$errors}}
        </div>
    @endif
    <hr>
    {{ $slot }}
</body>
</html>
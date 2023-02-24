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
    <div class="bg-slate-100 p-2">
        <h1 class="flex justify-center text-3xl font-bold">Sistem Jadwal</h1>
        <div class="flex justify-center gap-1">
            <a href="/" class="hover:underline hover:text-blue-600 p-1 rounded bg-teal-200">Home</a>
            <a href="/jadwal" class="hover:underline hover:text-blue-600 p-1 rounded bg-teal-200">Jadwal</a>
            <a href="/user" class="hover:underline hover:text-blue-600 p-1 rounded bg-teal-200">User</a>
        </div>
            @foreach ($errors->all() as $error => $message)
                <div class="text-red-500 bg-slate-300 rounded-md flex justify-center mt-2 p-1">
                    {{$message}}
                </div>
            @endforeach
    </div>
    <div class="p-2">
        {{ $slot }}
    </div>
</body>
</html>
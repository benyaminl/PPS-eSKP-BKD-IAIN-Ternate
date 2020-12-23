# Mock Up ESKP dan BKD PPS ITS Magister SI 2020

ini adalah project mock up mata kuliah PPS magister SI ITS 2020. Menggunakan Laravel sebagai tools untuk mockup. Laravel ini menggunakan paket Composer lain yaitu AdminLTE

## Config
Pada bagian ini akan dijelaskan singkat untuk config

### Menu Listener
Untuk ubah menu, bisa dilihat pada https://github.com/jeroennoten/Laravel-AdminLTE/wiki/8.-Menu-Configuration#841-config-on-service-provider

### Halaman extends
Halamn berada di `/resources/view/<nama view>.blade.php`. Untuk template halaman bisa sebagai berikut 
```blade
@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <p>Welcome to this beautiful admin panel.</p>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
```

Lebih lengkap lihat https://github.com/jeroennoten/Laravel-AdminLTE/wiki/4.-Usage
<!-- layouts/app.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}"></head>
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}"></head>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/login_register3.css') }}">
   

    <script src="{{ asset('js/bootstrap.js') }}"></script>

<body >
    
    @include('interface.header')
    <div class="container">
        @yield('content')
    </div>
    @include('interface.footer')
    <script src="{{ asset('js/script.js') }}"></script>
    <script src="{{ asset('js/jqery_3.7.1.js') }}"></script>
    <script src="{{ asset('js/login_register.js') }}"></script>
    <script src="https://kit.fontawesome.com/64d58efce2.js" crossorigin="anonymous"></script>
</body>
</html>

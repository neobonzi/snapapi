<!doctype html>
<html lang="en">
    <head>
        <title>SnapHunt API Admin Control Panel v1.0</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script type="text/javascript" src="{{ URL::asset('js/jquery-1.10.2.js') }}"></script>
        <link href="{{ URL::asset('css/bootstrap.min.css') }}" rel="stylesheet">
    </head>
    <body>

    	<div class="container">
    		@yield('content')
        </div>
    </body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/css/app.css">
    <script src="/js/app.js "></script>
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>AMR Task </title>
    <style>
.center {
  display: flex;
  justify-content: center;
  align-items: center;
  height: 100vh;
}

    </style>
</head>
<body onload="startTime()">
    <div class="bg-white container-fluid">
        @yield('content')
    </div>
</body>
</html>

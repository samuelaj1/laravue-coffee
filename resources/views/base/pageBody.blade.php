<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coffee Shop Sales</title>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap for styling -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Vue 2 -->
    {{--    <script src="https://cdn.jsdelivr.net/npm/vue@2.6.14/dist/vue.js"></script>--}}
    <script src="{{asset('/vue.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>


</head>
<body>
@yield('body')
</body>
</html>

<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Styles -->
    <script src="https://unpkg.com/vue"></script>
    <style>

    </style>
</head>
<body>
    <div id="app">
        @{{message}}
    </div>


    <script type="text/javascript">
    var app = new Vue({
          el: '#app',
          data: {
            message: 'Hello Vuejs!'
        }
    })
    </script>
</body>
</html>
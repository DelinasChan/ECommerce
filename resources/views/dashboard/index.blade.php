<!DOCTYPE html>
<html lang="">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <meta name="csrf_token" content="{{ csrf_token() }}"/>
    <title>後台</title>

    <link rel="stylesheet" href="/static/dashboard/css/index.css" />
    
  </head>
  <body>

    <div id="app"></div>

<script src="{{mix('static/dashboard/js/index.js')}}"></script>
</body>
</html>

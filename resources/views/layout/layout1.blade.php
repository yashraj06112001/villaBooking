
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
      
        #heading{
           background-color:#f23f5a;
            font-size:100px; 
            padding:20px;
            color:blue;
        }
        @yield('pagecss');
    </style>
</head>
<body>
    <div id="main">
        <div id="heading">
            <p>Villa Booking</p>
        </div>
        <div id="content">
            @yield('content');

        </div>
    </div>
</body>
</html>
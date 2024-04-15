@extends('layout.layout1')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        #booked{
            font-size:70px;
            color:darkgreen;
            text-decoration: underline;
            text-decoration-style:red ;
        }
    </style>
</head>
<body>
    @section('content')
    <div id="booked">
        <p>Your booking has been made!!!!!!!</p>
    </div>
    @endsection
</body>
</html>
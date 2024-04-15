@extends('layout.layout1')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    @session('content')
    <form>
        <label>Name</label>
        <input type="text" name="name" >
        <p>change -></p>
        <select >
            <option value="Booked">Booked</option>
            <option value="Not_Booked">Not_Booked</option>
        </select>

    </form>
    @endsession
</body>
</html>
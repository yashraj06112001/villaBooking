<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            font-family: 'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
            background-color: #f0f0f0; /* New background color outside the main content */
            margin: 0; /* Remove default margin */
            padding: 0; /* Remove default padding */
        }

        #main {
            margin: auto;
            max-width: 600px;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin-top: 50px;
        }

        input,
        select {
            margin: 10px 0;
            width: 100%;
            padding: 10px;
            border: 1px solid #ced4da;
            border-radius: 5px;
            font-size: 16px;
            box-sizing: border-box;
        }

        label {
            margin: 10px 0;
            display: block;
        }

        button {
            margin: 20px 0;
            padding: 10px 20px;
            background-color: #007bff;
            border: none;
            border-radius: 5px;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: #0056b3;
        }

        #post {
            margin: 20px 0;
            padding: 20px;
            background-color: #f8f9fa;
            border-radius: 10px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }

        #post_name {
            color: #dc3545;
            font-size: 24px;
            margin-bottom: 10px;
        }

        #post_about {
            color: #007bff;
            font-size: 18px;
            margin-bottom: 10px;
        }

        #post_info {
            color: #6c757d;
            font-size: 16px;
            margin-bottom: 10px;
        }

        img {
            max-width: 100%;
            height: auto;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    @extends('layout.layout1')

    @section('content')
    <div id="main">
    <form id="myForm" action="{{route('newsearchPost')}}" method="POST">
    @csrf
    <label for="category"><b>Category</b></label>
    <select id="category" name="category" required>
        <option value="" disabled selected hidden>Choose category</option>
        <option value="Holiday Villa">Holiday Villa</option>
        <option value="Rental Villa">Rental Villa</option>
        <option value="Villas for Sale">Villas for Sale</option>
    </select>

    <label for="sub_category"><b>Sub-category</b></label>
    <select id="sub_category" name="sub_category">
        <option value="" disabled selected hidden>Choose sub-category</option>
        <option value="Townhouse">Townhouse</option>
        <option value="Condo">Condo</option>
        <option value="Flat">Flat</option>
        <option value="Raw House">Raw House</option>
        <option value="Villa">Villa</option>
    </select>

    <label for="checkin"><b>Add Check-in Date</b></label>
    <input type="date" id="checkin" name="checkin" min="<?php echo date('Y-m-d'); ?>" required>

    <label for="checkout"><b>Check-out Date</b></label>
    <input type="date" name="checkout" id="checkout" min="<?php echo date('Y-m-d', strtotime('+1 day')); ?>" required>

    <button type="button" onclick="myFormSubmit()">Find</button>

    <button type="button" onclick="clearForm()">Clear</button>
</form>

    </div>

    @if(isset($posts) && count($posts) > 0)
    <div>
        @foreach($posts as $post)
        <div id="post">
            <div id="post_name">{{ $post->name }}</div>
            <div id="post_about">{{ $post->about }}</div>
            <div id="post_info">Total number of guests allowed to check in: {{$post->total_number_of_guest}}</div>
            @if($post->image)
            <img src="{{ $post->image }}" alt="Property Image">
            @else
            <p>No image available</p>
            @endif
            <form action="{{route('booking')}}" id="bookingForm" method="post">
                @csrf
                @if(isset($checkin)&&isset($checkout))
                <input type="hidden" name="post_name" value="{{$post->name}}">
                <input type="hidden" name="checkinData" value="{{$checkin}}">
                <input type="hidden" name="checkoutData" value="{{$checkout}}">
                <button id="post_book" type='submit'><b>Book</b></button>
                @endif
            </form>
        </div>
        @endforeach
    </div>
    @elseif(isset($message))
    <p>{{ $message}}</p>
    @endif
    @endsection

</body>
<script>
    function clearForm() {
        document.getElementById('myForm').reset();
    }

    function myFormSubmit(event) {
        let checkinDate = document.getElementById('checkin').value;
        let checkoutDate = document.getElementById('checkout').value;

        if (checkinDate >= checkoutDate) {
            alert('Check-in date must be before Check-out date');
            return false;
        } else {
            document.getElementById('myForm').submit();
        }
    }
</script>
</html>

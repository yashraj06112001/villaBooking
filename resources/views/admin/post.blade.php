@extends('layout.layout1')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    @section('pagecss')
        label {
            font-size: 20px;
            margin: 10px;
            opacity: 0.7;
            font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
        }

        input, select, textarea {
            width: 100%;
            padding: 10px;
            margin: 10px 0;
            border: 1px solid #ced4da;
            border-radius: 5px;
            font-size: 16px;
            box-sizing: border-box;
        }

        button {
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

        #headingPost {
            opacity: 0.3;
            font-size: 40px;
            margin-bottom: 20px;
            font-weight: bold;
        }
    @endsection
</head>
<body>
    @section('content')
    <div id="main">
        <div id="headingPost">
            <h1>Lets Post!!!!</h1>
        </div>
        <form action="{{route('postController')}}" method="post" enctype="multipart/form-data">
            @csrf
            <label for="name">Name of the property:</label>
            <input type="text" id="name" name="name" required>
            <label for="about">About:</label>
            <textarea id="about" name="about" rows="5" required></textarea>
            <label for="category">Enter its category:</label>
            <select id="category" name="category" required>
                <option value="" disabled selected hidden>Category</option>
                <option value="Holiday Villa">Holiday Villa</option>
                <option value="Rental Villa">Rental Villa</option>
                <option value="Villas for Sale">Villas for Sale</option>
            </select>
            <label for="sub_category">Select its sub-category:</label>
            <select id="sub_category" name="sub_category" required>
                <option value="" disabled selected hidden>Sub-category</option>
                <option value="Townhouse">Townhouse</option>
                <option value="Condo">Condo</option>
                <option value="Flat">Flat</option>
                <option value="Raw House">Raw House</option>
                <option value="Villa">Villa</option>
            </select>
            <label for="total_number_of_guest">Enter the maximum number of guests:</label>
            <input type="number" id="total_number_of_guest" name="total_number_of_guest" required>
            <label for="image">One picture of your property:</label>
            <input type="file" id="image" name="image" accept=".jpg, .jpeg, .png" required>
            <button type="submit">Post</button>
        </form>
        @if(session()->has('message'))
            <p>{{ session('message') }}</p>
        @endif
    </div>
    @endsection
</body>
</html>

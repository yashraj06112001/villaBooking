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
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>
@extends('layout.layout1')

@section('content')
<div id="main">
<form id="myForm" action="{{route('newsearchPost')}}" method="POST">
@csrf
<label for="category"><b>Category</b></label>
<select id="category" name="category" onchange="change()" required>
    <option value="" disabled selected hidden>Choose category</option>
    <option value="Holiday Villa">Holiday Villa</option>
    <option value="Rental Villa">Rental Villa</option>
    <option value="Villas for Sale">Villas for Sale</option>
</select>

<label for="sub_category"><b>Sub-category</b></label>
<select id="sub_category" onchange="change()"  name="sub_category">
    <option value="" disabled selected hidden>Choose sub-category</option>
    <option value="Townhouse">Townhouse</option>
    <option value="Condo">Condo</option>
    <option value="Flat">Flat</option>
    <option value="Raw House">Raw House</option>
    <option value="Villa">Villa</option>
</select>
<label for="total">Total Visitors</label>
<input type="number" id='total' name="total" >
<label for="checkin"><b>Add Check-in Date</b></label>
    <input type="date" id="checkin" name="checkin" min="<?php echo date('Y-m-d'); ?>" required>

    <label for="checkout"><b>Check-out Date</b></label>
    <input type="date" name="checkout" id="checkout" min="<?php echo date('Y-m-d', strtotime('+1 day')); ?>" required>
<button type="button" onclick="clearForm()">Clear</button>
</form>
<br>
<div id="posts"></div>
@endsection
</body>
<script>
   
    function clearForm() {
        document.getElementById('myForm').reset();
        change();
    }

    function change() {
        const cat = document.getElementById('category').value;
        const sub_cat = document.getElementById('sub_category').value;
        const total=document.getElementById('total').value;
        const checkin=document.getElementById('checkin').value;
        const checkout=document.getElementById('checkout').value;
        console.log(sub_cat);
        const xhr = new XMLHttpRequest;
        const url = "{{route('selectedOptionHandler')}}";
        xhr.open('post', url, true);
        xhr.setRequestHeader('Content-Type', 'application/json');
        const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        xhr.setRequestHeader('X-CSRF-TOKEN', token);
        const params = {
            category: cat,
            sub_category: sub_cat,
            total:total,
            checkin:checkin,
            checkout:checkout
        }
        xhr.send(JSON.stringify(params));
        xhr.onload = function () {
            if (xhr.status >= 200 && xhr.status < 300) {
                const response = JSON.parse(xhr.responseText); // Parse the JSON response
                console.log(response.posts);
                const posts = response.posts;
                if(posts.length==0)
                {
                    console.log("it has no length");
                }
                // Clear existing posts
                document.getElementById('posts').innerHTML = '';

                // Loop through posts and append them to the #posts div
                posts.forEach(post => {
                    const postElement = document.createElement('div');
                    postElement.id = 'post';
                    postElement.innerHTML = `
                        <div id="post_name">${post.name}</div>
                        <div id="post_about">${post.about}</div>
                        <div id="post_info">Total Visitors: ${post.total_number_of_guest}</div>
                        <img src="${post.image}" alt="Property Image">
                        <form action="{{route('booking')}}" id="bookingForm" method="post">
                        @csrf
                        <input type="hidden" name="post_name" value="${post.name}">
                        <input type="hidden" name="checkinData" value="${checkin}">
                        <input type="hidden" name="checkoutData" value="${checkout}">
                        <button id="post_book" type='submit'><b>Book</b></button>
                    </form>
                    `;
                    document.getElementById('posts').appendChild(postElement);
                });
            } else {
                console.error('Request failed with status:', xhr.status);
            }
        };

        xhr.onerror = function () {
            console.error('Request failed');
        };
    }
    
    function clearForm() {
        document.getElementById('myForm').reset();
        document.getElementById('posts').textContent = '0';
    }
 
</script>
<script>
      document.addEventListener('DOMContentLoaded', function() {
    const total = document.getElementById('total');
    total.addEventListener('input', function () {
        const inputValue = parseFloat(total.value);

        if (!isNaN(inputValue)) {
            // Call your existing change function
            change();
        }
    });
});
</script>
</html>

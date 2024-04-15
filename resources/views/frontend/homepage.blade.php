@extends('layout.layout1')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        input{
            margin:10px;
            width:200px;
            font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
        }
        label{
            margin:30px;
        }
        select{
            margin:20px;
            width:200px;
            font-family:'Franklin Gothic Medium', 'Arial Narrow', Arial, sans-serif;
        }
        #post_name{
            color:red;
            font-size:60px;
            padding:20px;
            border-radius: 30px;
            border-style: groove;
            border-color:black;
            
        }
        #post_about{
            color:blue;
            font-size:40px;
            padding:10px;
            border-radius: 50px;
            border-style: groove;
            border-color:black;
        }
        #post_info{
            color:violet;
            font-size:30px;
            padding:10px;
            border-radius: 10px;
            border-style: groove;
            border-color:black;
        }
        #post{
            margin:20px;
            border-width: 40px;
            border-style: groove;
            
        }
        option{
            font-size:20px;
        }
        select{
            font-size:20px;
            width: fit-content;
        }
       
        button:hover{
            color:white;
            font-size:30px;
            border-style:none;
            border-radius: 40px;
            background-color: lightgreen;
        }
        button{
            font-size:20px;
            background-color: darkgreen;
            border-style: none;
            color:white;
        }
    </style>
</head>
<body>
    @section('content')
    <div id="main">
        <form id="myForm" action="{{route('search')}}" method="post" >
            @csrf
        <select id="category" name="category" required>
            <option value="" disabled selected hidden ><b>category</b></option>
            <option value="Holiday Villa">Holiday Villa</option>
            <option value="Rental Villa">Rental Villa,</option>
            <option value="Villas for Sale">Villas for Sale</option>
        </select>
       
        <select id="sub_category" name="sub_category" required>
            <option value="" disabled selected hidden ><b>sub-category</b></option>
            <option value="Townhouse">Townhouse</option>
            <option value="Condo">Condo</option>
            <option value="Flat">Flat</option>
            <option value="Raw House">Raw House</option>
            <option value="Villa">Villa</option>
        </select>

        <label for="checkin" ><b>add check in Date</b></label>
        <input type="date" id="checkin" name="checkin" min="<?php echo date('Y-m-d'); ?>" required>
        
        <label for="checkout"><b>check out date</b></label>
        <input type="date" name="checkout" id="checkout" min="<?php echo date('Y-m-d', strtotime('+1 day')); ?>"  requored>
        <br>
        <!-- <input type="submit" value="submit"> -->
        <button type="button" onclick="myFormSubmit()">Find</button>
        <button type="button" onclick="clearForm()">Clear</button>
        </form>
    </div>
    <div>
    @if(session('posts') && count(session('posts')) > 0)
        @foreach(session('posts') as $post)
        <div id="post">
            <div id="post_name">{{ $post->name }}</div> 
            <br>
            <div id="post_about">{{ $post->about }}</div> 
            <br>
            <div id="post_info">Total number of guests allowed to checkin are => {{$post->total_number_of_guest}}</div>
            <br>
            @if($post->image)
            <img src="{{ $post->image }}" alt="Property Image">
        @else
            <p>No image available</p>
        @endif
            <br>
            <form action="{{route('booking')}}" id="bookingForm" method="post">
            @csrf
                <input type="hidden" name="post_name" value="{{$post->name}}">
                <input type="hidden" name="checkinData" value="{{session('checkin')}}">
                <input type="hidden" name="checkoutData" value="{{session('checkout')}}">
            <button id="post_book" type='submit'><b>Book</b></button>
            </form>
            <br>
        </div>
        @endforeach
    @elseif(session('message'))
        <p>{{ session('message') }}</p>
    @endif
    </div>
    @endsection
   
</body>
<script>
  
    function clearForm() {
        
        document.getElementById('myForm').reset();
    }
   
   
    function myFormSubmit(event)
    {  
       
        let checkinDate = document.getElementById('checkin').value;
        let checkoutDate = document.getElementById('checkout').value;

        if (checkinDate >= checkoutDate) {
            alert('Check-in date must be before Check-out date');
            return false; 
        }
       
       else{
        document.getElementById('myForm').submit();
       
       }
        
    }
       
      
   
  
                   
</script>
</html>
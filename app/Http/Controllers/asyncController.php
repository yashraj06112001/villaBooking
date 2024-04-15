<?php

namespace App\Http\Controllers;

use App\Models\adminPost;
use Illuminate\Http\Request;
use App\Models\bookings;
class asyncController extends Controller
{
    //
    function selectedOptionHandler(Request $req)
    {
//         $category = $req->input('category');
//          $sub_category = $req->input('sub_category');
//          $total=$req->input('total');
//       if($total==null)
//       {
//         if ($category == null && $sub_category != null) {
//             $posts = adminPost::where('sub_catagory', $sub_category)->get();
//         } 
//         elseif ($category != null && $sub_category == null) {
//             $posts = adminPost::where('category', $category)->get();
//         } 
//         else if($category!=null && $sub_category!=null){
//             $posts = adminPost::where('sub_catagory', $sub_category)->where('category', $category)->get();
//         }
//         else{
//             $posts = adminPost::where('total_number_of_guest','>=',$total)->get();
//         }
    
//         if ($posts->isEmpty()) {
//             return response()->json(['message' => 'No Post']);
//         } else {
//             return response()->json(['posts' => $posts]);
//         }
//       }
//    else{
//     if ($category == null && $sub_category != null) {
//         $posts = adminPost::where('sub_catagory', $sub_category)->where('total_number_of_guest','>',$total)->get();
//     } elseif ($category != null && $sub_category == null) {
//         $posts = adminPost::where('category', $category)->where('total_number_of_guest','>',$total)->get();
//     } else  if($category!=null && $sub_category!=null){
//         $posts = adminPost::where('sub_catagory', $sub_category)->where('total_number_of_guest','>',$total)->where('category', $category)->get();
//     }
//     else{
//         $posts = adminPost::where('total_number_of_guest','>=',$total)->get();
//     }
 
//    }
      
      $category=$req->input('category');
      $sub_category=$req->input('sub_category');
      $total=$req->input('total');
      $checkin=$req->input('checkin');
      $checkout=$req->input('checkout');
      $booking =new bookings;
      if($total==null)
      {
        if($category==null && $sub_category!=null)
        {
            $posts = adminPost::where('sub_catagory', $sub_category)->get();
            if ($posts->isEmpty()) {
            
                return response()->json(['message' => 'No Post']);
            } else {
                foreach($posts as $key => $post)
                {
                    $name=$post->name;
                    $book=$booking::where('property_name',$name)
                  ->where('checkin','<=',$checkin)
                  ->where('checkout','>',$checkin)
                  ->where('checkin','<=', $checkout)
                  ->where('checkout','>',$checkout)
                  ->get();
                    if($book->count()!=0)
                    {
                        unset($posts[$key]);
                    }
                    
                }
                return response()->json(['posts' => $posts]);
            }

            
        }
        else if($category!=null && $sub_category==null)
        {
            $posts = adminPost::where('category', $category)->get();
            if ($posts->isEmpty()) {
                
                return response()->json(['message' => 'No Post']);

            } else {
                foreach($posts as $key => $post)
                {
                    $name=$post->name;
                    $book=$booking::where('property_name',$name)
                  ->where('checkin','<=',$checkin)
                  ->where('checkout','>',$checkin)
                  ->where('checkin','<=', $checkout)
                  ->where('checkout','>',$checkout)
                  ->get();
                    if($book->count()!=0)
                    {
                        unset($posts[$key]);
                    }
                    
                }
                return response()->json(['posts' => $posts]);
            }
        }
        else if($category!=null && $sub_category!=null)
        {
            $posts = adminPost::where('sub_catagory', $sub_category)->where('category', $category)->get();
            if ($posts->isEmpty()) {
                return response()->json(['message' => 'No Post']);
            } else {
                foreach($posts as $key => $post)
                {
                    $name=$post->name;
                    $book=$booking::where('property_name',$name)
                  ->where('checkin','<=',$checkin)
                  ->where('checkout','>',$checkin)
                  ->where('checkin','<=', $checkout)
                  ->where('checkout','>',$checkout)
                  ->get();
                    if($book->count()!=0)
                    {
                        unset($posts[$key]);
                    }
                    
                }
                return response()->json(['posts' => $posts]);
            }
        }
        else
        {
            $posts = adminPost::where('total_number_of_guest','>=',$total)->get();
            if ($posts->isEmpty()) {
                return response()->json(['message' => 'No Post']);
            } else {
                foreach($posts as $key => $post)
                {
                    $name=$post->name;
                    $book=$booking::where('property_name',$name)
                  ->where('checkin','<=',$checkin)
                  ->where('checkout','>',$checkin)
                  ->where('checkin','<=', $checkout)
                  ->where('checkout','>',$checkout)
                  ->get();
                    if($book->count()!=0)
                    {
                        unset($posts[$key]);
                    }
                    
                }
                return response()->json(['posts' => $posts]);
            }
        }
      }
      
      

      else
      {
        if($category==null && $sub_category!=null)
        {
          $posts=adminPost::where('sub_catagory',$sub_category)->where('total_number_of_guest','>',$total)->get();
          if ($posts->isEmpty()) {
            return response()->json(['message' => 'No Post']);
        } else {
            foreach($posts as $key => $post)
            {
                $name=$post->name;
                $book=$booking::where('property_name',$name)
              ->where('checkin','<=',$checkin)
              ->where('checkout','>',$checkin)
              ->where('checkin','<=', $checkout)
              ->where('checkout','>',$checkout)
              ->get();
                if($book->count()!=0)
                {
                    unset($posts[$key]);
                }
                
            }
            return response()->json(['posts' => $posts]);
        }
        }
        else if($category!=null && $sub_category==null)
        {
            $posts=adminPost::where('catagory',$category)->where('total_number_of_guest','>',$total)->get();
            if ($posts->isEmpty()) {
                return response()->json(['message' => 'No Post']);
            } else {
                foreach($posts as $key => $post)
                {
                    $name=$post->name;
                    $book=$booking::where('property_name',$name)
                  ->where('checkin','<=',$checkin)
                  ->where('checkout','>',$checkin)
                  ->where('checkin','<=', $checkout)
                  ->where('checkout','>',$checkout)
                  ->get();
                    if($book->count()!=0)
                    {
                        unset($posts[$key]);
                    }
                    
                }
                return response()->json(['posts' => $posts]);
            }
        }
        else if($category!=null && $sub_category!=null)
        {
            $posts=adminPost::where('sub_catagory',$sub_category)->where('category',$category)->where('total_number_of_guest','>',$total)->get();
            if ($posts->isEmpty()) {
                return response()->json(['message' => 'No Post']);
            } else {
                foreach($posts as $key => $post)
                {
                    $name=$post->name;
                    $book=$booking::where('property_name',$name)
                  ->where('checkin','<=',$checkin)
                  ->where('checkout','>',$checkin)
                  ->where('checkin','<=', $checkout)
                  ->where('checkout','>',$checkout)
                  ->get();
                    if($book->count()!=0)
                    {
                        unset($posts[$key]);
                    }
                    
                }
                return response()->json(['posts' => $posts]);
            }
        }
        else
        {
            $posts=adminPost::where('total_number_of_guest','>',$total)->get();
            if ($posts->isEmpty()) {
                return response()->json(['message' => 'No Post']);
            } else {
                foreach($posts as $key => $post)
                {
                    $name=$post->name;
                    $book=$booking::where('property_name',$name)
                  ->where('checkin','<=',$checkin)
                  ->where('checkout','>',$checkin)
                  ->where('checkin','<=', $checkout)
                  ->where('checkout','>',$checkout)
                  ->get();
                    if($book->count()!=0)
                    {
                        unset($posts[$key]);
                    }
                    
                }
                return response()->json(['posts' => $posts]);
            }
        }
      }
      
  }
}

<?php

namespace App\Http\Controllers;

use App\Models\bookings;
use App\Models\adminPost;
use Illuminate\Http\Request;

class operationController extends Controller
{
    //
    function savePost(Request $req)
    {   
        $imagePath = null;

        // Handle file upload
        if ($req->hasFile('image')) {
            $image = $req->file('image');
            $imageName = $image->getClientOriginalName();
            $image->move(public_path('images'), $imageName);
            $imagePath = 'images/' . $imageName;
        }
    
    

        $post=new adminPost;
        $post->name=$req->name;
        $post->about=$req->about;
        $post->total_number_of_guest=$req->total_number_of_guest;
        $post->category=$req->category;
        $post->sub_catagory=$req->sub_category;
        $post->image=$imagePath ;
        $post->booked_notbooked="Not_Booked";
    $posted=$post->save();
    if($posted)
    {
        return redirect()->route('post')->with('message', 'Posted successfully');;
    }
    else{
        return redirect()->route('post')->with('message', 'not posted');;
    }
      
    }
    function searchPost(Request $req)
    {
        $category=$req->category;
        $sub_category=$req->sub_category;
        $checkin=$req->checkin;
        $checkout=$req->checkout;
        $booking=new bookings;
        $posts=adminPost::where('category',$category)->where('sub_catagory',$sub_category)->where('booked_notbooked','Not_Booked')->get();
        if($posts->count()==0)
        {
            return redirect()->back()->with('message',"No more data found");
        }
        foreach($posts as $key => $post)
        {
            $name=$post->name;
            $book=$booking::where('property_name',$name)
          ->where('checkin','<=',$checkin)
          ->where('checkout','>',$checkin)->get();
            if($book->count()!=0)
            {
                unset($posts[$key]);
            }
            
        }
        if($posts->count()>0)
        {
            return redirect()->back()->with(['posts'=>$posts,
        'checkin'=>$checkin,
        'checkout'=>$checkout    
    ]);
        }
        else{
            return redirect()->back()->with('message',"No more data found");
        }
        
    }

    function booking(Request $request)
    {
        $post_name=$request->post_name;
        $post=new adminPost;
        $booking=new bookings;
        $booking->property_name=$request->post_name;
        $booking->checkin=$request->checkinData;
        $booking->checkout=$request->checkoutData;
        $booking->save();
        return redirect()->route('confirmpage');
    }
}

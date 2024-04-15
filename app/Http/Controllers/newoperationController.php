<?php

namespace App\Http\Controllers;
use App\Models\adminPost;
use App\Models\bookings;
use Illuminate\Http\Request;

class newoperationController extends Controller
{
    //
    function homepageShow()
    {
        $post=new adminPost;
        $posts=$post->all();
        return view('frontend.newHomepage',['posts'=>$posts]);
    }

    public function newsearchPost(Request $req)
    {
        // Retrieve form data
        $category = $req->input('category');
        $subCategory = $req->input('sub_category');
        $checkin = $req->input('checkin');
        $checkout = $req->input('checkout');

        // Initialize bookings model
        $booking = new bookings;

        // Query admin posts based on category and subcategory (if provided)
        if($category==NULL)
        {
            $postsQuery = adminPost::where('booked_notbooked', 'Not_Booked');
            $posts = $postsQuery->get();
            $availablePosts = [];
            foreach ($posts as $post) {
                $bookings = $booking->where('property_name', $post->name)
                    ->where('checkin', '<=', $checkin)
                    ->where('checkout', '>', $checkin)
                    ->get();
                
                if ($bookings->isEmpty()) {
                    $availablePosts[] = $post;
                }
            }
    
            // Check if any posts are available
            if (empty($availablePosts)) {
                // Redirect using POST method
                return view('frontend.newHomepage',['message'=>"No more Posts right Now"]);
            }
    
            // Return view with available posts
            return view('frontend.newHomepage', [
                'posts' => $availablePosts,
                'checkin' => $checkin,
                'checkout' => $checkout
            ]);

        }

        $postsQuery = adminPost::where('category', $category)
            ->where('booked_notbooked', 'Not_Booked');

        if (!empty($subCategory)) {
            $postsQuery->where('sub_catagory', $subCategory);
        }

        $posts = $postsQuery->get();

        // Filter posts based on booking availability
        $availablePosts = [];
        foreach ($posts as $post) {
            $bookings = $booking->where('property_name', $post->name)
                ->where('checkin', '<=', $checkin)
                ->where('checkout', '>', $checkin)
                ->get();
            
            if ($bookings->isEmpty()) {
                $availablePosts[] = $post;
            }
        }

        // Check if any posts are available
        if (empty($availablePosts)) {
            // Redirect using POST method
            return view('frontend.newHomepage',['message'=>"No more Posts right Now"]);
        }

        // Return view with available posts
        return view('frontend.newHomepage', [
            'posts' => $availablePosts,
            'checkin' => $checkin,
            'checkout' => $checkout
        ]);
    }
}

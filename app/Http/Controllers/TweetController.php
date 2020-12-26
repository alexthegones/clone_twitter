<?php

namespace App\Http\Controllers;

use App\Models\Tweet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;

class TweetController extends Controller
{
    public function index()
    {
        $tweets = Tweet::with('user')
            ->orderBy('created_at','desc')
            ->get();


        return Inertia::render('Tweets/Index', [
            'tweets' => $tweets
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => ['exists:users,id'],
            'content' => ['required', 'max:280']
        ]);

        Tweet::create([
            'user_id' => auth()->user()->id,
            'content' => $request->input('content')
        ]);

        return Redirect::route('tweet.index');
    }
}

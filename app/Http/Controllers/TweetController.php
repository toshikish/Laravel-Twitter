<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Tweet;

class TweetController extends Controller
{
    public function __construct()
    {
        
    }

    /**
     * Display a list of all of the user's tweet.
     *
     * @param  Request  $request
     * @return Response
     */
    public function index(Request $request)
    {
        $tweets = Tweet::where('active', 1)->orderBy('updated_at', 'desc')->get();
        return view('tweets', ['tweets' => $tweets]);
    }

    /**
     * Create a new tweet.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'tweet' => 'required|max:255',
        ]);

        $request->user()->tweets()->create(['tweet' => $request->tweet, 'active' => true]);

        return redirect('/');
    }

    /**
     * Destroy the given tweet.
     *
     * @param  Request  $request
     * @param  Tweet  $tweet
     * @return Response
     */
    public function destroy(Request $request, Tweet $tweet)
    {
        $this->authorize('destroy', $tweet);

        $tweet->delete();

        return redirect('/');
    }

}

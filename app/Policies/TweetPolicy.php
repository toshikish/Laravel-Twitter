<?php

namespace App\Policies;

use App\User;
use App\Tweet;
use Illuminate\Auth\Access\HandlesAuthorization;

class TweetPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the given user can delete the given tweet.
     *
     * @param  User  $user
     * @param  Tweet  $tweet
     * @return bool
     */
    public function destroy(User $user, Tweet $tweet)
    {
        return $user->id === $tweet->user_id;
    }
}

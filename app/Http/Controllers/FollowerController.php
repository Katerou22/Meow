<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Follower;


class FollowerController extends Controller
{
    public function follow($followId, Follower $follower)
    {
        $user = auth()->user();

            $follower->create([
                'follow_id' => $followId,
                'user_id' => $user->id,
            ]);





        return back();
    }

    public function unfollow($followId,Follower $follower)
    {
        $user = auth()->user();

        Follower::where('follow_id',$followId)->where('user_id',$user->id)->delete();

        return back();


    }
}

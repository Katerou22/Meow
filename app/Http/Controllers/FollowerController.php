<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Follower;


class FollowerController extends Controller
{
    public function follow(Request $request, Follower $follower)
    {
        $user = auth()->user();

            $follower->create([
                'follow_id' => $request->follow_id,
                'user_id' => $user->id,
            ]);





        return redirect('home');
    }

    public function unfollow(Request $request)
    {

    }
}

<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use File;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function addAvatar(Request $request)
    {
        $user = auth()->user();
        $file = $request->file('photo');

        $user->avatar()->create([
            'avatar' => "/users/avatar/{$name}"
        ]);




        $file->move('users/avatar', 'avatar');

        if(isset($name2)){
            if(Storage::exists("users/avatar/{$name2}"));
            {
                File::delete("users/avatar/{$name2}");
            }
        }

        if(isset($name2)){
            return view('/home');
        }

        $name2 = $name;

    }
    public function index()
        {
            return view('/avatar');
        }

}

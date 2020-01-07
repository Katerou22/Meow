<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use App\User;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function addAvatar(Request $request)
    {
        $file = $request->file('photo');
        // $name = time() . $file->getClientOriginalName();
        $user = auth()->user();
        $path = "users/{$user->id}";

        $file->move($path, 'avatar.jpg');

        // if(isset($name2)){
        //     if(Storage::exists("users/avatar/{$name2}"));
        //     {
        //         File::delete("users/avatar/{$name2}");
        //     }
        // }

        // if(isset($name2)){
        //     return view('/home');
        // }


        // $name2 = $name;
        return redirect('home');

    }
    public function index()
        {
            return view('/avatar');
            echo "salam";
        }

}

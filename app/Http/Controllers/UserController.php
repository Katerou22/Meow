<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use App\User;

use Illuminate\Http\Request;

class UserController extends Controller
{

    public function addAvatar(Request $request)
    {
        $file = $request->file('avatar');
        // $name = time() . $file->getClientOriginalName();
        $user = auth()->user();
        $path = "users/{$user->id}";

        $file->move($path, 'avatar.jpg');

        return redirect('home');

    }


}

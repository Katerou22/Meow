<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\User;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = auth()->user();
        if(Storage::disk('local_public')->exists("users/{$user->id}/avatar.jpg")){
            return view('home');
        }
        else {
            Storage::disk('local_public')->copy("users/avatar.jpg", "users/{$user->id}/avatar.jpg");
            return view('home');
        }


    }
}

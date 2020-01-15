<?php

    namespace App\Http\Controllers;
    use Illuminate\Support\Facades\Storage;
    use Illuminate\Http\Request;
    use App\User;
    use Illuminate\Support\Facades\DB;
    use App\Tweet;
    use App\Follower;

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
                $setavatar = true;
                return view('home',compact('setavatar'));
            }
            else {
                $setavatar = false;
                return view('home',compact('setavatar'));
            }


        }
    }

<?php

    namespace App\Http\Controllers;
    use App\User;

	use Illuminate\Http\Request;

	class TweetController extends Controller {
		public function tweet(Request $request) {
			$request->validate([
				                   'body' => 'required',
			                   ]);

			auth()->user()->tweets()->create([
				                        'body' => $request->body,
			                        ]);
			return view('home');
        }


	}

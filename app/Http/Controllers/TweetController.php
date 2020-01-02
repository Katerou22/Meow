<?php

	namespace App\Http\Controllers;

	use Illuminate\Http\Request;

	class TweetController extends Controller {
		public function tweet(Request $request) {
			$request->validate([
				                   'body' => 'required',
			                   ]);

			$user = auth()->user();

			$user->tweets()->create([
				                        'body' => $request->body,
			                        ]);

			return back();
		}
	}

<?php

    namespace App\Http\Controllers;
    use App\User;
    use App\Tweet;
    use Illuminate\Support\Facades\DB;
	use Illuminate\Http\Request;

	class TweetController extends Controller {
		public function tweet(Request $request) {
			$request->validate([
				                   'body' => 'required',
			                   ]);

			auth()->user()->tweets()->create([
				                        'body' => $request->body,
                                    ]);


            $user = auth()->user();
            $tweet = DB::table('tweets')->orderBy('id','desc')->first();
            if($request->file('photo') !== null) {

                $file = $request->file('photo');
                $path = "users/$user->id/";
                $file->move($path, "{$tweet->id}.jpg");
                $tweet->photo = "$path/$tweet->id.jpg";
                DB::table('tweets')->where('id', $tweet->id)->update(['photo' => "$path/$tweet->id.jpg"]);



            }
            return redirect('home');
        }
	}

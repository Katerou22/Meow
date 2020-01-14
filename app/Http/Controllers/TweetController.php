<?php

    namespace App\Http\Controllers;
    use App\User;
    use App\Tweet;
    use Illuminate\Support\Facades\DB;
    use Illuminate\Http\Request;
    use Storage;

	class TweetController extends Controller {
		public function tweet(Request $request) {
            $user = auth()->user();

			$request->validate([
				                   'body' => 'required',
			                   ]);

			$tweet = $user->tweets()->create([
				                        'body' => $request->body,
                                    ]);

            if($request->file('photo')->isValid()) {

                $file = $request->file('photo');
                $path = "users/$user->id";
                $file->move($path, "$tweet->id.jpg");
                $tweet->photo = "$path/$tweet->id.jpg";
                DB::table('tweets')->where('id', $tweet->id)->update(['photo' => "$path/$tweet->id.jpg"]);



            }
            return redirect('home');
        }

        public function delete($tweetId)
        {
            $user = auth()->user();
            $path = "users/$user->id/$tweetId.jpg";

            Tweet::where('id',$tweetId)->delete();

            if(Storage::disk('local_public')->exsits($path))
            {
                Storage::disk('local_public')->delete($path);
                return back();
            }
            return back();
        }

        public function edit(Request $request)
        {
            $user = auth()->user();
            $tweet = $user->tweets()->create([
                                        'body' =>$request->body
                                    ]);
            if($request->file('photo')->isValid())
            {
                $file = $request->file('photo');
                $path = "users/$user->id";
                $file->move($path, "$tweet->id.jpg");
                $tweet->photo = "$path/$tweet->id.jpg";

                return back();
            }

            return back();
        }
	}

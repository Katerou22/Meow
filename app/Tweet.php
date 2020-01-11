<?php

	namespace App;

	use Illuminate\Database\Eloquent\Model;

	class Tweet extends Model {
		protected $fillable = [
			'user_id',
			'body',
		];

		public function user() {
			return $this->belongsTo(User::class);
        }

        public function photos()
        {
            return $this->hasMany(Photo::class);
        }
	}

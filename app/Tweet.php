<?php

	namespace App;

	use Illuminate\Database\Eloquent\Model;

	class Tweet extends Model {
		protected $fillable = [
			'user_id',
			'body',
		];

		public function user() {
			$this->belongsTo(User::class);
		}
	}

<?php

	use Illuminate\Database\Migrations\Migration;
	use Illuminate\Database\Schema\Blueprint;
	use Illuminate\Support\Facades\Schema;

	class CreateTweetsTable extends Migration {

		public function up() {
			Schema::create('tweets', function (Blueprint $table) {
                $table->bigIncrements('id');
                $table->string('avatar')->nullable();


				$table->integer('user_id')->unsigned();
				$table->foreign('user_id')->references('id')->on('users');


				$table->string('body',1024);



				$table->timestamps();
			});
		}

		/**
		 * Reverse the migrations.
		 *
		 * @return void
		 */
		public function down() {
			Schema::dropIfExists('tweets');
		}
	}

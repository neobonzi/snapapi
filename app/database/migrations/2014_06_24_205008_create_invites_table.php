<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateInvitesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('invites', function(Blueprint $table)
		{
			$inviteStatus = Config::get('constants.invite_status');
			$table->increments('id');
			$table->timestamps();
			$table->integer('group')->unsigned();
			$table->integer('from')->unsigned();
			$table->integer('to')->unsigned();
			$table->foreign('group')->references('id')->on('groups');
			$table->foreign('from')->references('id')->on('users');
			$table->foreign('to')->references('id')->on('users');
			$table->enum('status', $inviteStatus)->default($inviteStatus[0]);
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('invites');
		Schema::drop('user_invites');
	}

}

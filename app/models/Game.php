<?php

class Game extends Eloquent {

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'games';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array();

	public function name() {
		return $this->name;
	}

	public function users() {
		return $this->belongsTo('Group');
	}

	public function theme() {
		return $this->hasOne('Theme');
	}

}
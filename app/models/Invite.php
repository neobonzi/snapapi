<?php

class Invite extends Eloquent {
	protected $fillable = [];

	public function user() {
		return $this->belongsTo('User');
	}

	public function group() {
		return $this->belongsTo('Group');
	}
}
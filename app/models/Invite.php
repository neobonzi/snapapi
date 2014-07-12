<?php

class Invite extends Eloquent {
	protected $fillable = ['from', 'to', 'group'];

	public function id() {
		return $this->id;
	}

	public function from() {
		return $this->belongsTo('User', 'from');
	}

	public function to() {
		return $this->belongsTo('User', 'to');
	}

	public function getStatusAttribute($value) {
		return $value;
	}

	public function setStatusAttribute($value) {
		$this->attributes['status'] = $value;
	}

	public function group() {
		return $this->belongsTo('Group');
	}
}
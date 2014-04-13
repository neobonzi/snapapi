<?php namespace Support\Validation;
class UserValidator extends \Illuminate\Validation\Validator {
	/**
	 * @var Error Messages
	 */ 
	public $messages = [
		'required' => "The :attribute field is required",
		'username.min' => ":attribute must be between :min and :max characters.",
		'username.max' => ":attribute must be between :min and :max characters.",
		'unique' => ":attribute already registered.",
		'email' => "Email must be well formed."
	];

	/**
	 * @var User account validation rules.
	 */ 
	public $rules = [
		'username' => 'required|min:3|max:20|unique:users',
		'password' => 'required|min:8|max:20|unique:users',
		'email' => 'required|email|unique:users'
	];
}
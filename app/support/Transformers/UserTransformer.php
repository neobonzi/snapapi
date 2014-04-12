<?php namespace Support\Transformers;

class UserTransformer extends Transformer {

	/**
	 *	Transform a single user
	 *
	 *  @param User $user
	 *  @return array
	 */
	public function transform($user) {
		return [
			'username' => $user['username'],
			'email' => $user['email']
		];
	}


}
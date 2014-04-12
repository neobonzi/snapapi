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
			'uid' => $user['id'],
			'username' => $user['username'],
			'email' => $user['email']
		];
	}


}
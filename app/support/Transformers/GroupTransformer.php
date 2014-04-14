<?php namespace Support\Transformers;

class GroupTransformer extends Transformer {

	/**
	 *	Transform a single group
	 *
	 *  @param User $user
	 *  @return array
	 */
	public function transform($group) {
		return [
			'id' => $group['id'],
			'name' => $group['name']
		];
	}


}
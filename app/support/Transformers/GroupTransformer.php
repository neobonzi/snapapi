<?php namespace Support\Transformers;

class GroupTransformer extends Transformer {

	/**
	 *	Transform a single group
	 *
	 *  @param User $user
	 *  @return array
	 */
    public function transform($group) {
        $userTransformer = new UserTransformer;
        $groupMembers = $group->users->all();
        $members = $userTransformer->transformCollection($groupMembers);
	     return [
			'id' => $group['id'],
            'name' => $group['name'],
            'members' => $members
		  ];
	}


}

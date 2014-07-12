<?php 
namespace Support\Transformers;
use App\Models\Group;
use App\Models\User;

class InviteTransformer extends Transformer {

	/**
	 *	Transform a single invitation
	 *
	 *  @param Invite $invite
	 *  @return array
	 */
    public function transform($invite) {
        $groupName = \Group::find($invite->group)->name;
        $fromName = \User::find($invite->from)->username;
        $toName = \User::find($invite->to)->username;
	     return [
			'id' => $invite['id'],
            'date' => $invite['created_at'],
            'group_id' => $invite['group'],
            'group_name' => $groupName,
            'from_id' => $invite['from'],
            'from_name' => $fromName,
            'to_id' => $invite['to'],
            'to_name' => $toName,
            'status' => $invite['status']
		  ];
	}


}

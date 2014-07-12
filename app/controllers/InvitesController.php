<?php

use Support\Transformers\InviteTransformer;

class InvitesController extends APIController {
	protected $inviteTransformer;

	private $inviteMessages = [
	];

	private $inviteRules = [
	];

	function __construct(InviteTransformer $inviteTransformer) {
		$this->inviteTransformer = $inviteTransformer;
		// $this->beforeFilter('auth.token', ['except' => ['getGroups', 'index', 'store', 'destroy']]);
	}

	/**
	 * Creates a new invitation
	 * @param int $to 
	 * @return void
	 */
	public function sendInvite($to)
	{
		$from = e(Input::get('from'));
		$gid = e(Input::get('gid'));
		$invite = new Invite([
			'from' => $from,
			'to' => $to,
			'group' => $gid
		]);
		$invite->save();
	} 

	public function getInvites($uid)
	{
		if(Input::has('sent') && Input::get('sent') == 1)
		{
			return $this->sentInvites($uid);
		}
		else
		{
			return $this->invites($uid);
		}
	}

	protected function invites($uid)
	{
		$invites = User::find($uid)->invites->all();
		$transformedInvites = $this->inviteTransformer->transformCollection($invites);
		return $this->respond([
				'data' => $transformedInvites
			]);
	}

	protected function sentInvites($uid)
	{
		$sent_invites = User::find($uid)->sent_invites->all();
		$transformedInvites = $this->inviteTransformer->transformCollection($sent_invites);
		return $this->respond([
				'data' => $transformedInvites
			]);
	}

}

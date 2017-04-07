<?php

namespace App\Http\Controllers\Api;

use App\Http\Transformers\Api\UserTransformer;
use App\Models\UserGroup;

/**
 * @resource User
 *
 * @package App\Http\Controllers\Api
 */
class UserGroupUserController extends ApiController
{
	/**
	 * ProjectController constructor.
	 */
	public function __construct()
	{
		parent::__construct();
		
		// User group restrictions
		$this->middleware('verifyUserGroup:Developer,Support')->only('index');
	}

	/**
	 * User group user list
	 *
	 * @param string $userGroupId User Group ID
	 * @return \Dingo\Api\Http\Response
	 */
	public function index($userGroupId)
	{
		$userGroup = UserGroup::find($userGroupId);

		if (!$userGroup)
			return $this->response->errorNotFound();

		$paginator = $userGroup->users()->paginate();

		return $this->response->paginator($paginator, new UserTransformer());
	}
}

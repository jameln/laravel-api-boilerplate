<?php

namespace App\Http\Requests;

use App\Models\UserHasProject;

class StoreUserHasProjectRequest extends ApiRequest
{
	/**
	 * Get the validation rules that apply to the request.
	 *
	 * @return array
	 */
	public function rules()
	{
		return $this->filterWithModelConfiguration(UserHasProject::class, UserHasProject::getStoreRules());
	}
}

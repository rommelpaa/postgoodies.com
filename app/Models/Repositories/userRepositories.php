<?php

namespace App\Models\Repositories;
use App\Models\Entities\usersEntity;
use App\Models\Entities\userTypeEntity;
use App\Models\Entities\userInfoEntity;
use App\Models\Entities\companyEntity;
use App\Models\Entities\subscriptionEntity;
use Hash, Session, Cookie, DB;
class userRepositories
{
	protected $user;
	protected $user_type;
	protected $user_info;
	protected $company;
	function __construct(usersEntity $user, userTypeEntity $user_type, userInfoEntity $user_info, companyEntity $company)
	{
		$this->user   			= $user;
		$this->user_type   		= $user_type;
		$this->user_info		= $user_info;
		$this->company		    = $company;
	}

	function signup($data)
	{	
		$arr_returns               = array();
		$arr_returns['returns']	   = false;
		$this->user->email    	   = $data['email'];
		$this->user->username 	   = $data['username'];
		$this->user->password 	   = bcrypt($data['password']);
		$this->user->token         = $data['_token'];
		$this->user->is_active     = 1;
		$this->user->user_type_id  = $this->checkUserType(strtolower($data['usertype']));
		$save  = $this->user->save();

		if($save)
		{
			$arr_returns['returns']	   		= true;
			$user_id               			= $this->user->id;
			$this->user_info->user_id   	= $user_id;
			$this->user_info->firstname   	= $data['firstname'];
			$this->user_info->lastname   	= $data['lastname'];
			$this->user_info->phoneno   	= $data['phoneno'];
			$this->user_info->city   	    = $data['city'];
			$this->user_info->postalcode   	= $data['postalcode'];
			$this->user_info->save();

			//for company type users
			if($this->user->user_type_id==2)
			{
				$this->company->user_id 		= $user_id;
				$this->company->save();
			}
			//end here
			
			Session::put('users', array(
							'id'			=> $user_id,
							'email'			=> $this->user->email,
							'username'		=> $this->user->username,
							'user_type_id'  => $this->user->user_type_id
						));
		}

		return $arr_returns;
	}

	function checkUserType($name)
	{
		$results  = $this->user_type->where('name', $name)->first();
		if($results)
		{
			return $results->user_type_id;
		}
		return 3;
	}
	
}

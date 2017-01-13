<?php

namespace App\Models\Repositories;
use App\Models\Entities\usersEntity;
use Hash, Session, Cookie;
class authRepositories
{
	protected $users;
	function __construct(usersEntity $users)
	{
		$this->users   = $users;
	}

	function login($data)
	{
		$results  	 = $this->users->where('username',$data['username'])->where('is_active',1)->first();
		$arr_return  = array();

		$arr_return['returns']	= false;
		if(!empty($results))
		{
			if($results->user_type_id==1 || $results->user_type_id==2)
			{
				
				if(Hash::check($data['password'],$results->password))
				{
					$arr_return['returns']				= true;
					if(isset($data['rememberme']))
					{
						Cookie::queue('admin_user_id', $results->id, time() + 60*60*24*30);
					}
					Session::put('users', array(
								'id'			=> $results->id,
								'email'			=> $results->email,
								'username'		=> $results->username,
								'user_type_id'  => (int)$results->user_type_id
							));
					return $arr_return;
				}else
				{
					$arr_return['message']['password']	= array('Incorrect password, please make sure that you have entered the correct password.');
				}
			}else
			{
				$arr_return['message']['error']	= array('You dont have permission to login into this admin panel');
			}
			
		
		}else
		{
			$arr_return['message']['username']	    = array('Incorrect username or username does not exist!');
		}
		return $arr_return;
	}

	function getUserDetails($userID)
	{
		$userID      = (int)$userID;
		$results  	 = $this->users->where('id',$userID)->where('is_active',1)->first();
		return $results;
	}
}

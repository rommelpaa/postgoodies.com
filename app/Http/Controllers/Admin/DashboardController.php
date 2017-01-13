<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Admin\AdminController as AdminController;
use App\Models\Service\authService;
use Response, Request, Session, Redirect, Cookie;

class DashboardController extends AdminController
{	
	function __construct(authService $authUser)
	{
		$this->authUser  = $authUser;
		
		//this is to validate if user is already in login state.
		if(Cookie::has('admin_user_id'))
		{
			$results    = $this->authUser->getUserDetails(Cookie::get('admin_user_id'));
			Session::put('users', array(
							'id'			=> $results->id,
							'email'			=> $results->email,
							'username'		=> $results->username,
							'user_type_id'	=> $results->user_type_id
						));
		}
		
	}

	function index()
	{	
		if(Session::has('users'))
		{
			if(Session::get('users.user_type_id')==3)
			{
				return Redirect::to('/');
			}
			
		}
	   	return $this->renderPartial('admin.dashboard',$this->data);
	 
	}

}
?>
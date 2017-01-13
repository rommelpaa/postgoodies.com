<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Admin\AdminController as AdminController;
use App\Models\Service\authService;
use Response, Request, Session, Cookie, Redirect, URL;

class AuthController extends AdminController
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
			if(Session::get('users.user_type_id')==1 || Session::get('users.user_type_id')==2)
			{
				return Redirect::to('admin/dashboard');
			}else{
				return Redirect::to('/');
			}
			
		}
		if(!empty(Request::all()))
		{
			$results    = $this->authUser->login(Request::all());
			
			if($results['returns']){
				return Redirect::to('admin/dashboard');
			}else
			{
				return $this->renderPartial('admin.login',$this->data)->with('message', $results['message'])->with('alert_type','alert-danger');				
			}
		}
		$message    = array();
		$alert_type = '';
		if(Session::has('message') && Session::has('alert_type'))
		{
			$message  	 = Session::get('message');
			$alert_type  = Session::get('alert_type');
		}
		return $this->renderPartial('admin.login',$this->data)->with('message', $message)->with('alert_type',$alert_type);
	}

	function logout()
	{
		if(Session::has('users'))
		{
			Session::forget('users');	
		}

		if(Cookie::has('admin_user_id'))
		{
			setcookie('admin_user_id', '', time() - 30*30*24*60,'/');
		}

		return Redirect::to('admin/login')->with('message', array('logout' => array('You have successfully logout.')))->with('alert_type','alert-success');
		
	}

}
?>
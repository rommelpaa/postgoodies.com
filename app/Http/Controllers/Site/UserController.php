<?php

namespace App\Http\Controllers\Site;


use App\Http\Controllers\Site\SiteController as SiteController;
use App\Models\Service\userService;
use Response, Request, Session, Redirect, Cookie, URL;

class UserController extends SiteController
{	
	protected $user;
	function __construct(userService $user)
	{
		$this->user   = $user;
	}

	function index()
	{	
			 
	}
	
	function signup(){
		$data     = Request::all();
		$results  = $this->user->signup($data);
		
		$response = 500;
		if($results['returns'])
		{
			$response = 200;
		}	

		return Response::json($results, $response);
		
	}

}
?>
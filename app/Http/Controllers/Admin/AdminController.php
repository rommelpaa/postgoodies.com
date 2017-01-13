<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller as BaseController;
use Session, Cookie, Request, Redirect;
class AdminController extends BaseController
{	
	protected $data       = array();
	protected $common     = '';
	protected $authUser;

	function renderPartial($layout='layouts.main', $data = array())
	{	
		if(!Session::has('users') && Request::segment(2) !='login')
	   	{
	   	  	return Redirect::to('admin/login');
	   	}
		return view($layout, $data);
	}

}
?>
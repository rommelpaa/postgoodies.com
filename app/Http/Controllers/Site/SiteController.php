<?php

namespace App\Http\Controllers\Site;
use App\Http\Controllers\Controller as BaseController;
use Session, Cookie, Request, Redirect;
class SiteController extends BaseController
{	
	protected $data       = array();
	protected $common     = '';
	protected $authUser;

	function renderPartial($layout='layouts.main', $data = array())
	{	
		return view($layout, $data);
	}

}
?>
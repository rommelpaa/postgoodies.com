<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Admin\AdminController as AdminController;
use App\Models\Service\authService;
use App\Models\Service\reportsService;
use Response, Request, Session, Redirect, Cookie, URL;

class ReportsController extends AdminController
{	
	protected $reportsService;
	function __construct(authService $authUser, reportsService $reportsService)
	{
		$this->authUser  			= $authUser;
		$this->reportsService		= $reportsService;

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

	function index($action='', $id='')
	{
		
		if($action!="")
		{
			if(!empty(Request::all()))
			{
				$data    			 = Request::all();
				$id 				 = (Request::get('id')!="")?base64_decode(Request::get('id')):'';	
					
				$results             = $this->reportsService->reports($id, strtolower($action), $data);
				$alertType           = ($results['returns'])?'alert-success':'alert-danger';

				return Redirect::to('admin/reports/form/edit/'.$results['id'])
								->with('message',$results['message'])
								->with('alertType',$alertType);
			}


			$this->data['id']		 = $id;
			$this->data['action']    = strtolower($action);
			$id                      = ($id!='')?base64_decode($id):'';
			$results                 = $this->reportsService->reports($id, strtolower($action));

			if($results['returns'])
			{
				$this->data['reports']    = $results;
			}
			return $this->renderPartial('admin.reports-form',$this->data);
		}

	   	return $this->renderPartial('admin.reports',$this->data);
	}

	function getReports()
	{
		$data    = Request::all();
		$results = $this->reportsService->getReports($data);
		
		return Response::json($results);
	}
}
?>
<?php

namespace App\Http\Controllers\Company;
use App\Http\Controllers\Controller as BaseController;
use App\Models\Service\authService;
use App\Models\Service\companyService;
use Response, Session, Cookie, Request, Redirect;
class CompanyController extends BaseController
{	
	protected $data       = array();
	protected $common     = '';
	protected $authUser;
	protected $company;

	function __construct(authService $authUser, companyService $company)
	{
		$this->authUser  = $authUser;
		$this->company   = $company;
		
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
			if(Session::get('users.user_type_id')!=2)
			{
				return view('errors.404');
			}
		}
		
		$data    = Request::all();

		if(!empty($data))
		{
			$response = 500;
			$results  = $this->company->saveCompany($data);

			if($results['returns'])
			{
				$response = 200;
			}	
			return Response::json($results, $response);
		}

		$results    = $this->company->getCompany();
		if(!empty($results))
		{
			$data['company']    = $results;
		}

		$data['industry']       = array(
									'Company Industry',
									'Accounting',
									'Advertising and PR',
									'Aerospace',
									'Agriculture/Forestry/Fishing',
									'Architectural and Design Services',
									'Automotive',
									'Banking and Finance',
									'Broadcasting/Music/Film',
									'Business Services and Consulting',
									'Charity/Not-For-Profit',
									'Computers/Hardware/Software',
									'Construction',
									'Digital and Media',
									'Education',
									'Energy and Utilities',
									'Engineering',
									'Entertainment',
									'Fashion and Textiles',
									'Government and Defence',
									'Healthcare',
									'Hospitality and Food Services',
									'Hotels and Accomodation',
									'Household Services',
									'Information Technology',
									'Insurance',
									'Legal',
									'Management Consulting Services',
									'Manufacturing, FMCG and Facilities Management',
									'Mining/Metals/Minerals',
									'Other',
									'Personal Care and Cosmetics',
									'Pharmaceuticals and Medical Devices',
									'Real Estate and Property Management',
									'Recruitment and Staffing',
									'Retail',
									'Security and Surveillance',
									'Sports and Physical Recreation',
									'Telecommunications',
									'Transport',
									'Travel and Tourism',
									'Waste Management',
									'Wholesale Trade and Import-Export',
									'Work from Home'
								  );

		return $this->renderPartial('admin.company.company', $data);
	}

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
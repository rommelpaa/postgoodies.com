<?php

namespace App\Http\Controllers\Site;


use App\Http\Controllers\Site\SiteController as SiteController;
use App\Models\Service\companyService;
use Response, Request, Session, Redirect, Cookie, URL;

class CompanyController extends SiteController
{	
	protected $company;
	function __construct(companyService $company)
	{
		$this->company    = $company;
	}
	function index()
	{	

		//pull all company that is active
		if(Request::has('search') || Request::has('industry'))
		{
			$data     = Request::all();
			$results  = $this->company->getAllCompany($data);
		}

		$this->data['industry']       = array(
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

		return $this->renderPartial('site.company',$this->data);
	}
	
}
?>
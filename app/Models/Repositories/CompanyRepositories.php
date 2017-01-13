<?php

namespace App\Models\Repositories;
use App\Models\Entities\companyEntity;
use Hash, Session, Cookie;
class CompanyRepositories
{
	protected $company;
	function __construct(companyEntity $company)
	{
		$this->company   = $company;
	}

	function saveCompany($data)
	{
		$fileupload    = $data['companyIconUpload'];

		//get the company id
		$userID        = Session::get('users.id');
		$rsCompany     = $this->company->where('user_id','=', $userID)->first();
		if(empty($rsCompany))
		{
			$this->company->user_id   = $userID;
			$this->company->save();
			$rsCompany  = $this->company;
		}
		

		$filename         = "";

		if(!empty($fileupload))
		{
			$uploadDIR    = base_path('public/uploads/company/'.$rsCompany->id);
			
			if(!is_dir($uploadDIR))
			{
				mkdir($uploadDIR, 0755, true);
			}
			if($fileupload->isValid())
			{
				$filename     = date('U').preg_replace('/\s+/','_',$fileupload->getClientOriginalName());
				$extension    = $fileupload->getClientOriginalExtension();
				$size         = $fileupload->getSize();
				$mime         = $fileupload->getMimeType();
				$fileupload->move($uploadDIR,$filename);

				$rsCompany->logo    		= $filename;
			}
		}
		
		$rsCompany->name    		= $data['name'];
		$rsCompany->business_no    	= $data['businessno'];
		$rsCompany->email    		= $data['email'];
		$rsCompany->description    	= $data['description'];
		$rsCompany->address    		= $data['address'];
		$rsCompany->city    		= $data['city'];
		$rsCompany->country    		= $data['country'];
		$rsCompany->postalcode    	= $data['postalcode'];
		$rsCompany->industry    	= $data['industry'];
		$rsCompany->contact_person  = $data['contact_person'];
		$rsCompany->contact_no    	= $data['contactno'];
		$result    = $rsCompany->update();
		
		$arr_results 			   = array();
		$arr_results['returns']    = false;

		if($result)
		{
			$arr_results['returns']    = true;
		}

		return $arr_results;	
	}
	function getCompany()
	{
		$results    = $this->company->where('user_id','=',Session::get('users.id'))->first();
		return $results;
	}
	function getAllCompany($data)
	{
		$filter    = $this->company;
		if(!empty($data))
		{
			if($data['search']!="")
			{
				$filter    = $filter->where("name", "LIKE","%".$data['search']."%");
			}
			if($data['industry']!="")
			{
				$filter    = $filter->where('industry','=',trim($data['industry']));
			}
		}
		$results    = $filter->where('is_active','=',1);
		$count      = $results->count();
		$paginate   = $results->paginate();
		$results    = $results->get();
		
		return $results;
	}
}

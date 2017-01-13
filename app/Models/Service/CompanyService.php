<?php

namespace App\Models\Service;
use App\Models\Repositories\CompanyRepositories;
use Mail, Cookie, Validator, Request;

class CompanyService 
{
    private $repo;

    function __construct(CompanyRepositories $repo)
    {
        $this->repo   = $repo;       
    }

    function saveCompany($data)
    {
    	$arr_return['returns'] 		   = false;

        $rules    	= array(
        				'name'    			=> 'required',
        				'email'				=> 'required|email',
        				'description'		=> 'required|min:30|max:300',
        				'address'			=> 'required',
        				'city'				=> 'required',
        				'postalcode'		=> 'required',
        				'country'			=> 'required',
        				'industry'			=> 'required',
        				'contact_person' 	=> 'required',
        				'contactno'			=> 'required'
        			);
        $validator  = Validator::make($data, $rules);
        if($validator->fails())
        {
        	if(!empty($validator->errors()->messages()))
            {
            	foreach($validator->errors()->messages() as $key => $row)
	            {
	                $arr_return['message'][$key]  = $row[0];
	            }
            }
            return $arr_return;
        }

        $results    = $this->repo->saveCompany($data);

        if($results['returns'])
        {
        	$arr_return['returns'] 		       = true;
        	$arr_return['message']['success']  = "Record Save";	
        }else
        {
        	$arr_return['message']['error']  = "There's was a problem in saving your company details. Please contact the web admin";
        }
        return $arr_return;

    }

    function getCompany()
    {
    	$results    = $this->repo->getCompany();
    	return $results;
    }

    function getAllCompany($data)
    {
    	$results    = $this->repo->getAllCompany($data);
    	return $results;
    }
}

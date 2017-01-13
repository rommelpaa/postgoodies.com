<?php

namespace App\Models\Service;
use App\Models\Repositories\userRepositories;
use Mail, Cookie, Validator, Request;

class userService 
{
    private $repo;

    function __construct(userRepositories $repo)
    {
        $this->repo   = $repo;       
    }

    function signup($data)
    {
    	$arr_return                    = array();
    	$arr_return['returns'] 		   = false;

    	$rules    = array(
        				'firstname'    => 'Required',
        				'lastname'     => 'Required',
        				'email'        => 'Required|email|unique:users',
        				'phoneno'      => 'Required',
        				'username'	   => 'Required|unique:users',
        				'password'     => 'Required|min:8|confirmed'
        		   );
        $validator  = Validator::make($data, $rules);
        
        if($validator->fails() || !preg_match('/^(?=.*[a-zA-Z])((?=.*?\d)|(?=.*?[!@#$%^&*(),._+]))[A-Za-z\d!@#$%^&*(),._+]{8,20}$/i', $data['password']))
        {
            if(!empty($validator->errors()->messages()))
            {
            	foreach($validator->errors()->messages() as $key => $row)
	            {
	                $arr_return['message'][$key]  = $row[0];
	            }
            }
            if(!preg_match('/^(?=.*[a-zA-Z])((?=.*?\d)|(?=.*?[!@#$%^&*(),._+]))[A-Za-z\d!@#$%^&*(),._+]{8,20}$/i', $data['password']))
            {
            	$arr_return['message']['password']  = 'Please provide a valid password';
            }
            return $arr_return;
        }

        $results    = $this->repo->signup($data);

        if($results['returns'])
        {
        	$arr_return['returns'] 		     = true;
        }else
        {
        	$arr_return['message']['error']  = "There's was a problem in registering your account please contact the web admin for the support.";
        }
        return $arr_return;

    }
}

<?php

namespace App\Models\Service;
use App\Models\Repositories\authRepositories;
use Mail, Cookie, Validator, Request;

class authService 
{
    private $repo;

    function __construct(authRepositories $repo)
    {
        $this->repo   = $repo;       
    }

    function login($data)
    {
        
        $arr_return = array();
        $rules      = array(
                        'username'  => 'required',
                        'password'  => 'required|min:8'
                      );
        $validator  = Validator::make($data, $rules);
        
        if($validator->fails())
        {
            $arr_return['returns']  = false;
            foreach($validator->errors()->messages() as $key => $row)
            {
                $arr_return['message'][$key]  = $row;
            }
            return $arr_return;
        }

        $results    = $this->repo->login($data);
        return $results;

    }

    function getUserDetails($userID)
    {
        $results    = $this->repo->getUserDetails($userID);
        return $results;
    }
}

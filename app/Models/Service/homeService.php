<?php

namespace App\Models\Service;
use App\Models\Repositories\homeRepositories;
use Mail, Cookie, Validator, Request;

class homeService 
{
    private $repo;

    function __construct(homeRepositories $repo)
    {
        $this->repo   = $repo;       
    }

    function getCharity()
    {
        return $this->repo->getCharity();
    }
}

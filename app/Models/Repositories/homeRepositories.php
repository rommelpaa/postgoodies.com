<?php

namespace App\Models\Repositories;
use App\Models\Entities\charityEntity;
use Hash, Session, Cookie;
class homeRepositories
{
	protected $charity;
	function __construct(charityEntity $charity)
	{
		$this->charity   = $charity;
	}

	function getCharity()
	{
		return $this->charity->where('status',1)->get();
	}
}

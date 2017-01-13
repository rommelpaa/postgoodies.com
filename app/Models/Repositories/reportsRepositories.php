<?php

namespace App\Models\Repositories;
use App\Models\Entities\reportsEntity;
use Hash, Session, Cookie, DB;
class reportsRepositories
{
	protected $reports;
	function __construct(reportsEntity $reports)
	{
		$this->reports   = $reports;
	}

	function reports($data, $id='', $action='add')
	{
		$arr_return['returns']	 = false;
		$results    		= $this->reports;
		if($action=='edit')
		{
			$results             = $results->find($id);
		}
		$results->title    		 = $data['title'];
		$results->description    = $data['description'];
		$results->amount         = $data['amount'];
		$save    = $results->save();
		if($save)
		{
			$arr_return['returns']	 = true;
			$arr_return['id']		 = $results->id;
		}
		return $arr_return;
	}

	function getReports($data = array())
	{
		$results    = $this->reports;
		if(!empty($data['id']))
		{
			$results = $results->where('id',$data['id']);
		}
		$results    = $results->orderBy('created_at', 'Desc')->get();
		return $results;
	}
	
}

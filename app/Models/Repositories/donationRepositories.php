<?php

namespace App\Models\Repositories;
use App\Models\Entities\donationsEntity;
use App\Models\Entities\charityEntity;
use Hash, Session, Cookie, DB;
class donationRepositories
{
	protected $donations;
	protected $charity;
	function __construct(donationsEntity $donations, charityEntity $charity)
	{
		$this->donations   = $donations;
		$this->charity     = $charity;
	}

	function getDonations($data)
	{
		$results    = DB::table(DB::raw('donations as d, charity as c'))
		 				->select(DB::raw('d.id, d.email, d.charity_id, d.firstname, d.lastname, d.phoneno, d.country, d.city, d.amount, d.currency, d.payType, d.payKey, d.status as donate_status, d.created_at, c.name, c.description, c.status as charity_status'))
		 				->whereRaw('c.id=d.charity_id AND c.status=1')
		 				->get();
		return $results;
	}

	function saveDonate($data)
	{

		$arr_return                = array();
		$arr_return['returns']     = false;

		$this->donations->charity_id    = $data['charity'];
		$this->donations->firstname     = $data['firstname'];
		$this->donations->lastname      = $data['lastname'];
		$this->donations->email      	= $data['email'];
		$this->donations->phoneno      	= $data['phoneno'];
		$this->donations->city      	= $data['city'];
		$this->donations->postalcode    = $data['postalcode'];
		$this->donations->country      	= $data['country'];
		$this->donations->amount      	= $data['amount'];
		$this->donations->currency      = $data['currency'];
		$this->donations->payType      	= 'PayPal';
		$this->donations->status      	= 'Pending';
		
		$save   = $this->donations->save();
		if($save)
		{
			$arr_return['returns']     	= true;
			$arr_return['dID']			= $this->donations->id;
			$arr_return['charity']     	= $this->charity->find($data['charity'])->first()->toArray();
		}
		return $arr_return;
	}

	function updateDonate($id, $payKey, $status='Complete')
	{
		$arr_return                = array();
		$arr_return['returns']     = false;

		$updateDonate        	= $this->donations->find($id);
		$updateDonate->payKey = $payKey;
		$updateDonate->status = $status;

		$save    = $updateDonate->save();

		return $save;

	}
}

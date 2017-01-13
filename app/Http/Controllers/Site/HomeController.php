<?php

namespace App\Http\Controllers\Site;


use App\Http\Controllers\Site\SiteController as SiteController;
use App\Models\Service\homeService;
use App\Models\Service\donationService;
use Response, Request, Session, Redirect, Cookie, URL;

class HomeController extends SiteController
{	
	protected $home;
	protected $donation;
	function __construct(homeService $home, donationService $donation)
	{
		$this->home    		= $home;
		$this->donation     = $donation;
	}

	function index()
	{	
		
		$hashtag    = 'postgoodies';
		// $igResults  = json_decode(file_get_contents('https://www.instagram.com/explore/tags/'.$hashtag.'/?__a=1'));

		if(!empty($igResults->tag->top_posts->nodes))
		{
			$igNodes	= $igResults->tag->top_posts->nodes;
			array_pop($igNodes); //Remove the last array

			$cnt        = 0;
			foreach($igNodes as $key => $row)
			{
				if($cnt > 3)
					break;
				
				$owner = json_decode(file_get_contents('http://api.instagram.com/oembed?url=https://www.instagram.com/p/'.$row->code.'/', true));
				$this->data['data']['instagram']['fields'][$key]   = array(
																	'ig_link'		=> 'https://www.instagram.com/p/'.$row->code.'/',
																	'img_src'		=> $row->thumbnail_src,
																	'likes'			=> $row->likes->count,
																	'comments'		=> $row->comments->count,
																	'caption'		=> $row->caption,
																	'created_time'	=> $row->date,
																	'is_video'		=> $row->is_video,
																	'user'			=> array(
																							'title'			=> $owner->title,
																							'author_name'   => $owner->author_name,
																							'thumbnail_url'	=> $owner->thumbnail_url,
																							'author_id'		=> $owner->author_id,
																							'author_url'	=> $owner->author_url,
																							'type'			=> $owner->type
																					   ),
																	'id'			=> $row->id
																 );
				$cnt++;
			}

		}else
		{
			$this->data['data']['instagram']['error_message']		= 'No results found!';
		}

		//validate paypal process
		if(Request::has('success'))
		{
			$this->data['message']['alertType']	= 'alert-danger';

			$PayPal    	   = Request::all();
			if(Request::get('success') && Request::has('paymentId'))
			{
				$results   = $this->donation->paypalValidate($PayPal);

				if($results['returns'])
				{
					$this->data['message']['alertType']	= 'alert-success';
				}
				$this->data['message']['paypal']	= $results['message'];
				
			}else
			{
				//cancel transaction
				$results   = $this->donation->paypalCancel($PayPal);
				$this->data['message']['paypal']	= "You have cancelled your transaction with paypal with reference number of ".Request::get('token');
			}
		}

		return $this->renderPartial('site.home',$this->data);	 
	}
	
	function donate(){
		$data     = Request::all();

		$results  = $this->donation->saveDonate($data);
		
		$response = 500;
		if($results['returns'])
		{
			$response = 200;
		}	

		return Response::json($results, $response);
		
	}

}
?>
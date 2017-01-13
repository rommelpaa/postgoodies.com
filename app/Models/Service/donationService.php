<?php

namespace App\Models\Service;
use App\Models\Repositories\donationRepositories;
use Mail, Cookie, Validator, Request, URL;

use Paypal;

class donationService 
{
    private $repo;
    private $_apiContext;
    function __construct(donationRepositories $repo)
    {
        $this->repo             = $repo;       
        $this->_apiContext      = PayPal::ApiContext(
                                    config('services.paypal.client_id'),
                                    config('services.paypal.secret')
                                  );

        $this->_apiContext->setConfig(array(
            'mode' => 'sandbox',
            'service.EndPoint' => 'https://api.sandbox.paypal.com',
            'http.ConnectionTimeOut' => 30,
            'log.LogEnabled' => true,
            'log.FileName' => storage_path('logs/paypal.log'),
            'log.LogLevel' => 'FINE'
        ));


    }

    function getDonations($data)
    {
        $results    = $this->repo->getDonations($data);
        $arr_return = array();

        $arr_return['returns'] = false;
        if(!empty($results))
        {
            $arr_return['returns'] = true;
            $arr_return['results'] = $results;
        }
        return $arr_return;
    }
    function saveDonate($data)
    {
        $arr_return = array();
        
        $arr_return['returns']  = false;

        $rules      = array(
                        'charity'           => 'required',
                        'firstname'         => 'required',
                        'lastname'          => 'required',
                        'email'             => 'required|email',
                        'phoneno'           => 'required|numeric',
                        'city'              => 'required',
                        'postalcode'        => 'required',
                        'country'           => 'required',
                        'amount'            => 'required',
                        'currency'          => 'required',
                        'agreement'         => 'required'   
                      );
        $validator  = Validator::make($data, $rules);
        if($validator->fails())
        {
            foreach($validator->errors()->messages() as $key => $row)
            {
                $arr_return['message'][$key]  = $row[0];
            }
            return $arr_return;
        }

        $results    = $this->repo->saveDonate($data);
        if($results)
        {
            $arr_return['returns']  = true;
            $baseUrl                = URL::to('/');

            $description            = $results['charity']['description'];
            $donationAmount         = $data['amount'];
            $dID                    = str_replace('=','',base64_encode($results['dID']));

            $payer = PayPal::Payer();
            $payer->setPaymentMethod('paypal');

            $amount = PayPal::Amount();
            $amount->setCurrency(strtoupper($data['currency']));
            $amount->setTotal($donationAmount); // This is the simple way,
            // you can alternatively describe everything in the order separately;
            // Reference the PayPal PHP REST SDK for details.

            $transaction = PayPal::Transaction();
            $transaction->setAmount($amount);
            $transaction->setDescription($description);

            $redirectUrls = PayPal::RedirectUrls();
            $redirectUrls->setReturnUrl(URL::to("/?success=true&did=$dID"));
            $redirectUrls->setCancelUrl(URL::to("/?success=cancel&did=$dID"));

            $payment = PayPal::Payment();
            $payment->setIntent('sale');
            $payment->setPayer($payer);
            $payment->setRedirectUrls($redirectUrls);
            $payment->setTransactions(array($transaction));

            $response = $payment->create($this->_apiContext);
            $redirectUrl = $response->links[1]->href;

            $arr_return['approvalUrl']    = $redirectUrl;

            return $arr_return; 
        }
        return $arr_return['message']['paypal']     = "Error, there's something wrong in donating. Please contact the web admin.";
    }

    function paypalValidate($data)
    {
        $arr_return = array();
        $arr_return['returns']  = false;

        $dID              = base64_decode($data['did'].'=');
        $paymentId        = $data['paymentId'];
        
        try
        {
            $payment          = PayPal::getById($data['paymentId'], $this->_apiContext);
            $paymentExecution = PayPal::PaymentExecution();
            $paymentExecution->setPayerId($data['PayerID']);
            
            $executePayment   = $payment->execute($paymentExecution, $this->_apiContext);

            $results          = $this->repo->updateDonate($dID, $paymentId, 'Completed');
            if($results)
            {
                $arr_return['returns']     = true;
                $arr_return['message']     = "You have successfully donated using your paypal account with reference number : ".$data['paymentId'].". Thank You and God Blessed";
            }else
            {
                $arr_return['message']     = "Error, there's something wrong in donating. Please contact the web admin.";
            }
            
        }catch(PayPal\Exception\PayPalConnectionException $e){
            $errors                        = json_decode($e->getData(), true);
            $arr_return['message']         = $errors['message'];
        }
        return $arr_return;
    }

    function paypalCancel($data)
    {
        $dID        = base64_decode($data['did'].'=');
        $results    = $this->repo->updateDonate($dID, $data['token'], 'Canceled');
        return $results;
    }
}   

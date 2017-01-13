<?php

namespace App\Models\Service;
use App\Models\Repositories\reportsRepositories;
use Mail, Cookie, Validator, Request, URL;
class reportsService 
{
    private $repo;
    private $_apiContext;
    function __construct(reportsRepositories $repo)
    {
        $this->repo             = $repo;
    }

    function reports($id='', $action='add', $data = array())
    {
        $arr_return                 = array();
        $arr_return['returns']      = false;

        if(!empty($data))
        {
            $rules         = array(
                                'title'         => 'Required',
                                'description'   => 'Required',
                                'amount'        => 'Required'
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
            
            $results    = $this->repo->reports($data, $id, $action);
            if($results['returns'])
            {
                $event                                  = ($action=='edit')?'Update':'Save';
                $arr_return['returns']                  = true;
                $arr_return['id']                       = base64_encode($results['id']);
                $arr_return['message']['Status']        = "Record ".$event;
                return $arr_return;
            }
            return $arr_return['message']['Error']      = "Please contact the admin.";
            
        }

        if($action=='edit')
        {
            if($id!='')
            {
                $results    = $this->repo->getReports(array('id'=>$id));
                if(!empty($results))
                {
                    $arr_return['returns']      = true;
                    $arr_return['results']      = $results;
                    return $arr_return;
                }
            }
        }
        return $arr_return;
    }

    function getReports($data)
    {
        $results    = $this->repo->getReports($data);
        $arr_return = array();

        $arr_return['returns'] = false;
        if(!empty($results))
        {
            $arr_return['returns'] = true;
            $arr_return['results'] = $results;
        }
        return $arr_return;
    }

}   

<?php
/**
 * Created by PhpStorm.
 * User: odavila
 * Date: 25/09/15
 * Time: 10:52
 */

namespace Modules\Kiu;


use GuzzleHttp\Client;
use Illuminate\Support\Facades\Config;

class Kiu_DataResolv
{
    protected function send($xml)
    {
        $data = [
            'user'      => Config::get('odavila.Kiu_USER'),
            'password'  => Config::get('odavila.Kiu_PASSWD'),
            'request'   => $xml
        ];

        $client = new Client();
        $response = $client->request('POST', Config::get('odavila.Kiu_URL'), [
            'form_params' => $data,
            'verify' => false
        ]);

        if($response->getStatusCode() === 200) {

            $data_res = new \stdClass();

            $data_res->xml = $response->getBody();
            $data_res->obj = $this->XML_to_Obj($response->getBody());

            return $data_res;
        }
    }

    private function XML_to_Obj($xml)
    {

        $response_xml = simplexml_load_string($xml);

        $json = json_encode($response_xml);
        $obj = json_decode($json);
        
        return $obj;
    }


}
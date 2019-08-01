<?php
namespace  App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;

class TestController extends Controller
{
	public function __construct($value = '') {
		# code...
	}
    public function test(){
        $dep = 3;
        $url = 'http://restapi.amap.com/v3/config/district?key=5f6d1733b6b08927f8c44f9fd70e1026&subdistrict=' . $dep;
        $client = new Client();
        $response = $client->get($url)->getBody();
        $data = json_decode($response,true);
        dd($data);
            $res = \GuzzleHttp\json_decode($response->getBody());

            $data = $res->districts[0]->districts;

    }
}

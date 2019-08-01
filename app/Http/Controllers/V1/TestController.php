<?php
namespace  App\Http\Controllers\V1;

use App\Http\Controllers\Controller;

class TestController extends Controller
{
	public function __construct($value = '') {
		# code...
	}
    public function test(){
       return dirname(__DIR__);
    }
}

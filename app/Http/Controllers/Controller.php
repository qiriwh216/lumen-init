<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController
{
    public function __construct(Request $request)
    {
        if (env('APP_DEBUG')) {
            \Log::debug("\n\n");
            \Log::debug('请求路由：' . $request->url());
            $requestParameters = $request->all();
            if (!empty($requestParameters)) {
                \Log::debug('请求参数：' . var_export($requestParameters, true));
            } else {
                \Log::debug('请求参数：无');
            }
        }
    }
}

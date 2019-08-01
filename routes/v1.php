<?php
$router->group(['prefix' => 'v1'], function () use ($router) {
    $router->get('test','TestController@test');
    $router->get('redis','TestController@redis');
});

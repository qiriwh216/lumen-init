<?php
$router->group(['prefix' => 'v1'], function () use ($router) {
    $router->get('/',function(){
       return 111;
    });
});

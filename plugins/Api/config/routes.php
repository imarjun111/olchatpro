<?php

use Cake\Routing\Router;
Router::plugin ( 'Api', [ 'path' => '/v1' ] ,function  ( $routes )   {
    
    $routes->extensions(['json']);
    
    $routes->fallbacks('DashedRoute');
});
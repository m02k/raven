<?php
namespace App\app;

class Middleware
{
    public function __construct(Router $router){
        $router->hasMiddleware();
    }
}




?>
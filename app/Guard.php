<?php
namespace App\app;

class Guard
{
    public function __construct(){
        $auth =[
            'User' => 'GUEST',
            'id' => session_id()
        ];
        echo($auth['User']);
        return;
    }
    
}







?>

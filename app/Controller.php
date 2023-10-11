<?php
namespace App\app;

class Controller
{
    /**
    * @param $view Enter your view filename without .php extension
    * @param array $params Pass Data from controller to view \n['value'=>$value] access from view $value
    * @param $password Input String Password returns hash 
    *
    */
    public function render($view, $params=[])
    {
        /*
        @param $view your view file;
        */
        return Application::$app->router->renderView($view, $params);
    }

    public function redirect($path){
        return Application::$app->response->redirect($path);
    }

    public function back(){
        return Application::$app->response->back();
    }

    public function hash($password){
        return password_hash($password, PASSWORD_DEFAULT);
    }

    /**
    * @param $error Render error message https://www.example.com
    *
    */
    public function abort($error){

        return Application::$app->router->rendeContent($error);
    }
    
    // public function with($message){
    //     return $message;
    // }
    
}







?>

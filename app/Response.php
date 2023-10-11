<?php
namespace App\app;

class Response
{
    public function setStatusCode(int $code)
    {
        http_response_code($code);
    }

    public function redirect($path){
        header("location: $path");
    }

    public function back(){
        // try {
        //     $previous = $_SERVER['HTTP_REFERER'];
        //     header("location: $previous");
        // } catch (\Throwable $th) {
        //     return Application::$app->router->rendeContent($th);
        // }
        echo($_SERVER['HTTP_REFERER']);
        if(isset($_SERVER['HTTP_REFERER'])){
            $previous = $_SERVER['HTTP_REFERER'];
            header("location: $previous");
        }
        else{
            return $this->redirect('/');
        }
        
    }
}




?>
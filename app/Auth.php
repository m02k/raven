<?php
namespace App\app;
use App\models\USERS;

class Auth
{
    public static Auth $auth;

    public function __construct(){
        self::$auth = $this;
    }

    public function user(){
        return $_SESSION['user'];
    }

    public function isAuth(){
        if ($_SESSION['user']['auth']==true) {
            return true;
        }
        return false;
    }

    public function isGuest(){
        if ($_SESSION['user']['auth']==false) {
            return true;
        }
        return false;
    }

    public function Attempt($email, $password, $status=0){
        if($_SESSION['user']['auth']==false){
            $user = new USERS();
            $info = $user->where('email',$email)->fetch();
            foreach($info as $key => $value){
                if(password_verify($password, $value['password'])){
                    session_regenerate_id();
                    $data = [
                        'firstname' => $value['firstname'],
                        'lastname' => $value['lastname'],
                        'email' => $value['email'],
                        'status' => $value['status'],
                        'user' => 'Auth',
                        'id' => session_id(),
                        'auth' => true
                    ];
                    $_SESSION['user'] = $data;
                    return true;
                }
            }
        }
        else{
            return false;
        }
        
    }

    public function logout(){
        if($_SESSION['user']['auth']==true){
            session_regenerate_id();
            $data = [
                'user' => 'GUEST',
                'id' => session_id(),
                'auth' => false
            ];
            $_SESSION['user'] = $data;
            return true;
        }
        else{
            return false;
        }


    }
    
}







?>

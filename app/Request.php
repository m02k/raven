<?php
namespace App\app;
use App\app\Application;

class Request
{
    public function getURL()
    {
        $path = $_SERVER['REQUEST_URI'] ?? '/';
        $position = strpos($path, '?');

        if($position === false)
        {
            return $path;
        }
        return substr($path, 0, $position);
    }

    public function Method()
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

    public function isGet()
    {
        return $this->Method() === 'get';
    }

    public function isPost()
    {
        return $this->Method() === 'post';
    }

    public function isPut()
    {
        return $this->Method() === 'put';
    }

    public function isDelete()
    {
        return $this->Method() === 'delete';
    }

    public function Input()
    {
        $body = [];
        if ($this->Method() === 'get') {
            foreach ($_GET as $key => $value) {
                $body[$key] = filter_input(INPUT_GET, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }

        if ($this->Method() === 'post') {
            foreach ($_POST as $key => $value) {
                $body[$key] = filter_input(INPUT_POST, $key, FILTER_SANITIZE_SPECIAL_CHARS);
            }
        }

        return $body;
    }


    public array $errors = [];
    public function Validate(array $data=[], array $val=[])
    {
        
        foreach($val as $key => $value)
        {
            foreach($data as $attr => $rule)
            {
                if($attr === $key)
                {
                    if($value === "required")
                    {
                        if(!$rule)
                        {
                            $this->errors[$attr]="$attr is required";

                        }
                    }
                    elseif($value === "filteremail")
                    {
                        if(!filter_var($rule, FILTER_VALIDATE_EMAIL))
                        {
                            $this->errors[$attr]="$attr must be valid email";

                        }
                    }
                }

            }
        }
        return $this->errors;
    }
    public function isValidate(){
        if ($this->errors==null || empty($this->errors)) {
            return true;
        }
    }
}




?>
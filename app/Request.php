<?php
namespace App\app;
use App\app\Application;

/**
 * Summary of Request
 */
class Request
{
    /**
     * Summary of getURL
     * @return mixed
     */
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

    /**
     * Summary of Method
     * @return string
     */
    public function Method()
    {
        return strtolower($_SERVER['REQUEST_METHOD']);
    }

    /**
     * Summary of isGet
     * @return bool
     */
    public function isGet()
    {
        return $this->Method() === 'get';
    }

    /**
     * Summary of isPost
     * @return bool
     */
    public function isPost()
    {
        return $this->Method() === 'post';
    }

    /**
     * Summary of isPut
     * @return bool
     */
    public function isPut()
    {
        return $this->Method() === 'put';
    }

    /**
     * Summary of isDelete
     * @return bool
     */
    public function isDelete()
    {
        return $this->Method() === 'delete';
    }

    /**
     * Summary of Input
     * @return array return $_GET or $_POST data.
     */
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

    /**
     * Summary of file
     * this is a protected function used only for references.
     * @return mixed
     */
    protected function file(){
        foreach($_FILES as $file => $value){
            $fileName = $file;
        }
        return $fileName;
    }

    /**
     * Summary of fileName
     * @return string return file filename.
     */
    public function fileName(){
        $fileName = $this->file();
        return pathinfo($_FILES[$fileName]['name'])['filename'];
    }

    /**
     * Summary of fileExtension
     * @return string return file extension.
     */
    public function fileExtension(){
        $fileName = $this->file();
        return pathinfo($_FILES[$fileName]['name'])['extension'];
    }

    /**
     * Summary of hasFile
     * @return bool check whether request contain a file or not.
     */
    public function hasFile(){
        $fileName = $this->file();
        return !empty($_FILES[$fileName]['name']);
    }

    /**
     * Summary of fileType
     * @return string return file type.
     */
    public function fileType(){
        $fileName = $this->file();
        return $_FILES[$fileName]['type'];
    }

    /**
     * Summary of fileSize
     * @return string return file size.
     */
    public function fileSize(){
        $fileName = $this->file();
        return $_FILES[$fileName]['size'];
    }

    /**
     * Summary of filePath
     * @return string return file path.
     */
    public function filePath(){
        $fileName = $this->file();
        return $_FILES[$fileName]['full_path'];
    }

    /**
     * Summary of fileTmp
     * @return string return file temp name.
     */
    public function fileTmp(){
        $fileName = $this->file();
        return $_FILES[$fileName]['tmp_name'];
    }

    /**
     * Summary of fileExists
     * @param string $path Checks whether a file or directory exists.
     * @return bool return true if file or directory exists.
     */
    public function fileExists($path){
        if (file_exists($path)) {
            return true;
        }
        else{
            return false;
        }
    }


    /**
     * Summary of fileSave
     * @param string $from The temporary filename of the uploaded file.
     * @param string $to The destination of the moved file.
     * @return bool return true if file is saved successfuly.
     */
    public function fileSave($from, $to){
        if (move_uploaded_file($from, $to)) {
            return true;
        }
        else{
            return false;
        }
    }


    /**
     * Summary of errors
     * @var array
     */
    public array $errors = [];
    /**
     * Summary of Validate
     * @param array $data
     * @param array $val
     * @return array
     */
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
    /**
     * Summary of isValidate
     * @return bool
     */
    public function isValidate(){
        if ($this->errors==null || empty($this->errors)) {
            return true;
        }
        else{
            return false;
        }
    }
}




?>

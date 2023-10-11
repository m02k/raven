<?php
namespace App\app;

class Schema
{
    public array $columns;
    public string $tableName;
    
    protected array $errors;

    public function create()
    {
        //Check Post
        if($this->errorCheck()===false){
            return $this->errors;
        }

        //Connection
        $db = \App\app\Application::$app->db;
        $query = $this->queryBuilder();
        $SQL = "CREATE TABLE $this->tableName ($query) ENGINE=INNODB;";
        $db->pdo->exec($SQL);
    }

    public function queryBuilder()
    {
        $group = [];
        foreach($this->columns as $column => $value)
        {
            $bind = $column.' '.$value;
            $group[] = $bind;
        }
        $query = implode(', ', $group);
        
        return $query;
    }


    public function errorCheck()
    {
        if (!isset($this->tableName)) {
            $this->errors[] = "Table Name is not Defined";
        }

        elseif(!isset($this->columns)){
            $this->errors[] = "Columns can not be empty";
        }

        elseif(!empty($this->errors)){
            return false;
        }
        else{
            return true;
        }
        return;

    }

    public function dropIfExists()
    {
        $db = \App\app\Application::$app->db;
        $SQL = "DROP TABLE $this->tableName";
        $db->pdo->exec($SQL);
    }
}







?>

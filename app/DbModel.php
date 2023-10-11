<?php
namespace App\app;

abstract class DbModel extends Model
{

    abstract public function tableName(): string;
    abstract public function attributes(): array;
    public array $whereProp;

    public function save()
    {
        $tableName = $this->tableName();
        $attributes = $this->attributes();
        $params = array_map(fn($attr) => ":$attr", $attributes);
        $statement = self::prepare("INSERT INTO $tableName (".implode(',',$attributes).") VALUES (".implode(',',$params).")");

        foreach ($attributes as $attribute) {
            $statement->bindValue(":$attribute", $this->{$attribute});
        }
        try {
            $statement->execute();
            return true;
        } catch (\Throwable $th) {
            if($th->getCode()==23000){
                return ['error'=>'Email is already Registered', 'code'=>23000];
            }
            else{
                return Application::$app->router->rendeContent($th->getMessage());
            }
        }

    }


    public function where($attribute, $value)
    {
        if (is_array($attribute)) {
            foreach($attribute as $key => $val){
                if (is_integer($value)) {
                    $this->whereProp[] = [$val => $value];
                }
                elseif (is_array($value)) {
                    $this->whereProp[] = [$val => "\"$value[$key]\""];
                    
                }
                elseif(is_string($value)){
                    $this->whereProp[] = [$val => "\"$value\""];
                }
                else{
                    return Application::$app->router->rendeContent("
                    WRONG DATATYPE
                    <br>
                    (\"WHERE\") accept only int and string;
                    ");
                }
            }
        }
        else{
            if (is_integer($value)) {
                $this->whereProp = [$attribute => $value];
            }
            elseif(is_string($value)){
                $this->whereProp = [$attribute => "\"$value\""];
            }
            else{
                return Application::$app->router->rendeContent("
                WRONG DATATYPE
                <br>
                (\"WHERE\") accept only int and string;
                ");
            }
        }
        return $this;
    }

    public function delete()
    {
        $tableName = $this->tableName();
        if (!empty($this->whereProp)) {
            foreach($this->whereProp as $key => $val){
                if (is_array($val)) {
                    foreach ($val as $where => $cond) {
                        $value[] = $cond;
                        $prop[] = $where;
                        
                        $conditions = [$prop,$value];
                    }
                    $conditions = array_map(fn($attr,$cond) => "$attr=$cond", $conditions[0],$conditions[1]);
                    $conditions = implode(' AND ',$conditions);
                    $SQL = "DELETE FROM $tableName WHERE $conditions";
                }
                else{

                    $prop = $key;
                    $value = $val;
                    $SQL =  "DELETE FROM $tableName WHERE $tableName.$prop = $value";
                }
                // $prop = $key;
                // $value = $val;
                // $SQL =  "DELETE FROM $tableName WHERE $tableName.$prop = $value";
                // $statement = self::prepare($SQL);
                // try {
                //     $statement->execute();
                //     return true;
                // } catch (\Throwable $th) {
                //     return Application::$app->router->rendeContent($th);
                // }
            }
            $statement = self::prepare($SQL);
            try {
                $statement->execute();
                return true;
            } catch (\Throwable $th) {
                return Application::$app->router->rendeContent($th);
            }
        }
        else {
            return Application::$app->router->rendeContent("
            WRONG METHOD
            <br>
            (\"WHERE\") is not Set;
            <br>
            Example:- \$Model->where('id',1)->delete();
            ");
        }

    }

    public function update()
    {
        $tableName = $this->tableName();
        if (!empty($this->whereProp)) {
            foreach($this->whereProp as $key => $val){
                if (is_array($val)) {
                    foreach ($val as $where => $cond) {
                        $value[] = $cond;
                        $prop[] = $where;
                        $RawAttributes = $this->attributes();
                        $attributes = [];
                        foreach($RawAttributes as $key => $val)
                        {
                            if (!empty($this->{$val})) {
                                $attributes[] = $val;
                            }
                        }
                        $params = array_map(fn($attr) => "$attr = :$attr", $attributes);
                        
                        
                        $conditions = [$prop,$value];
                    }
                    $conditions = array_map(fn($attr,$cond) => "$attr=$cond", $conditions[0],$conditions[1]);
                    $conditions = implode(' AND ',$conditions);
                    $statement = self::prepare("UPDATE $tableName SET ".implode(' , ',$params)." WHERE $conditions");
                    foreach ($attributes as $attribute) {
                        $statement->bindValue(":$attribute", $this->{$attribute});
                    }
                }
                else{

                    $prop = $key;
                    $value = $val;
                    $RawAttributes = $this->attributes();
                    $attributes = [];
                    foreach($RawAttributes as $key => $val)
                    {
                        if (!empty($this->{$val})) {
                            $attributes[] = $val;
                        }
                    }
                    $params = array_map(fn($attr) => "$attr = :$attr", $attributes);
                    $statement = self::prepare("UPDATE $tableName SET ".implode(' , ',$params)." WHERE $prop = $value");
                    foreach ($attributes as $attribute) {
                        $statement->bindValue(":$attribute", $this->{$attribute});
                    }
                }
            }
            try {
                    $statement->execute();
                    return true;
                } catch (\Throwable $th) {
                    return Application::$app->router->rendeContent($th);
                }
        }
        else {
            return Application::$app->router->rendeContent("
            WRONG METHOD
            <br>
            (\"WHERE\") is not Set;
            <br>
            Example:- \$Model->where('id',1)->update();
            ");
        }

    }

    public function fetchAll()
    {
        $tableName = $this->tableName();
        $SQL =  "SELECT * FROM $tableName";
        $statement = self::prepare($SQL);
        try {
            $statement->execute();
            $result = $statement->fetchAll(\PDO::FETCH_NAMED);
            return $result;
        } catch (\Throwable $th) {
            return Application::$app->router->rendeContent($th);
        }
    }

    public function fetch()
    {
        $tableName = $this->tableName();
        if (!empty($this->whereProp)) {
            foreach($this->whereProp as $key => $val){
                if (is_array($val)) {
                    foreach ($val as $where => $cond) {
                        $value[] = $cond;
                        $prop[] = $where;
                        
                        $conditions = [$prop,$value];
                    }
                    $conditions = array_map(fn($attr,$cond) => "$attr=$cond", $conditions[0],$conditions[1]);
                    $conditions = implode(' AND ',$conditions);
                    $SQL =  "SELECT * FROM $tableName WHERE $conditions";
                }
                else{

                    $prop = $key;
                    $value = $val;
                    $SQL =  "SELECT * FROM $tableName WHERE $tableName.$prop = $value";
                }
            }
            
            $statement = self::prepare($SQL);
            try {
                $statement->execute();
                $result = $statement->fetchAll(\PDO::FETCH_ASSOC);
                return $result;
            } catch (\Throwable $th) {
                return Application::$app->router->rendeContent($th);
            }
        }
        else {
            return Application::$app->router->rendeContent("
            WRONG METHOD
            <br>
            (\"WHERE\") is not Set;
            <br>
            Example:- \$Model->where('id',1)->fetch();
            ");
        }
    }

    public function prepare($SQL)
    {
        return Application::$app->db->pdo->prepare($SQL);
    }
    
}







?>

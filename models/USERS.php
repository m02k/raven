<?php
        namespace app\models;

        use App\app\DbModel;
        
        class USERS extends DbModel
        {
            /*

            STEP 1-> Create Properties of All Columns;
            STEP 2-> Create Attributes of All Columns;
            Ready to Go...

            */
            //Define Properties Below
            public string $id = '';
            public string $firstname = '';
            public string $lastname = '';
            public string $email = '';
            public string $status = '';
            public string $password = '';
            public string $created_at = '';
            public string $updated_at = '';



            public function tableName (): string
            {
                return "users";
            }
        
            public function register(){
                return parent::save();
            }

            public function attributes(): array
            {
                //Add Attributes Below
                return ['firstname', 'lastname', 'status', 'email', 'password'];
            }
        
        
        
        
        
        
        
        
        }
        ?>
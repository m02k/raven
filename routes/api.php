<?php
        use App\app\Application;
        /*
            Add your API routes here...
        */
        
        // This is example API route
         $app->router->get('/api', function(){
             $arr = [
                 'US' => 'Washington',
                 'UK' => 'London',
                 'Spain' => 'Mardid',
                 'Italy' => 'Rome',
                 'Pakistan' => 'Islamabad',
                 'India' => 'New Dehli'
             ];

             echo("<pre>");
             var_dump(json_encode($arr));
             echo("</pre>");
             return;
         });

?>

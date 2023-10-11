<?php
        use App\app\Application;
        /*
            Add your routes here...
        */
        
        // This is example index route
        $app->router->get('/', function(){
             return Application::$app->router->renderView('welcome');

        });

        








?>

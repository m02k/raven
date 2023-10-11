<?php
namespace App\app;

class Application
{
    public static string $ROOT_DIR;
    public static Application $app;
    public Router $router;
    public Request $request;
    public Response $response;
    public Database $db;
    public Middleware $middleware;
    public Auth $auth;

    public function __construct($rootPath, array $config)
    {
        self::$ROOT_DIR = $rootPath;
        self::$app = $this;
        $this->request = new Request();
        $this->response = new Response();
        $this->router = new Router($this->request, $this->response);
        $this->auth = new Auth();
    
        
        
        $this->db = new Database($config['db']);
    }

    public function run()
    {

        //$this->middleware = new Middleware($this->router);
        $this->router->hasMiddleware();
        $this->router->resolve();
    }
}




?>
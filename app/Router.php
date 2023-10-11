<?php
namespace App\app;

class Router
{
    public Request $request;
    public Response $response;
    protected array $routeMap = [];
    public array $MiddlewareMap = [];
    public function __construct(Request $request, Response $response)
    {
        $this->request = $request;
        $this->response = $response;
    }
    public function get($path, $callback)
    {
        $this->routeMap['get'][$path] = $callback;
    }

    public function post($path, $callback)
    {
        $this->routeMap['post'][$path] = $callback;
    }

    public function put($path, $callback)
    {
        $this->routeMap['put'][$path] = $callback;
    }

    public function delete($path, $callback)
    {
        $this->routeMap['delete'][$path] = $callback;
    }
    
    public function match($methods=[], $path, $callback)
    {
        foreach($methods as $method){
            $this->routeMap[$method][$path] = $callback;
        }
    }

    public function middleware($methods=[], $path, $callback, $middleware='')
    {
        foreach($methods as $method){
            $this->routeMap[$method][$path] = $callback;
            $this->MiddlewareMap[$method][$path] = $middleware;
        }
    }

    public function hasMiddleware(){
        $path = $this->request->getURL();
        $method = $this->request->Method();
        $callback = $this->MiddlewareMap[$method][$path] ?? false;
        if($callback === false)
        {
            return;
        }
        if (is_array($callback)) {
            $callback[0] = new $callback[0]();
        }

        return call_user_func($callback, $this->request);
    }

    public function resolve()
    {
        $path = $this->request->getURL();
        $method = $this->request->Method();
        $callback = $this->routeMap[$method][$path] ?? false;
        
        if($callback === false)
        {
            Application::$app->response->setStatusCode(404);
            return $this->rendeContent('error 404 not found');
        }
        
        if (is_string($callback)) {
            return $this->renderView($callback);
        }

        if (is_array($callback)) {
                $callback[0] = new $callback[0]();
        }
        
        return call_user_func($callback, $this->request);
        
    }

    public function renderView($view, $params=[])
    {
        foreach ($params as $key => $value) {
            $$key = $value;
        }
        include_once Application::$ROOT_DIR."/views/$view.php";
    }

    public function rendeContent($err)
    {
        $content = $err;
        include_once Application::$ROOT_DIR."/errors/layout.php";
        exit;
    }
}




?>

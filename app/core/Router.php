<?php
class Router {
    
    public function dispatch(){
        $url = $_GET['url'] ?? '/';

        $url = trim($url, '/');

        $parts = explode('/', $url);

        $controllerName = !empty($parts[0]) ? ucfirst($parts[0]) . 'Controller' : 'StudentController';

        $method = $parts[1] ?? 'login';
        
        $param = $parts[2] ?? null;

        $controllerFile = __DIR__ . '/../controllers/' . $controllerName . '.php';

        if (!file_exists($controllerFile)){
            die("controller not found");
        }
        require_once $controllerFile;

        $controller = new $controllerName();

        if (!method_exists($controller, $method)){
            die("method not found");
        }

        if ($param !== null){
            $controller->$method($param);
        }
        else{
            $controller->$method();
        }
    }
}
<?php
namespace Framework\Core;

class Router {

    protected $routes = [];

    public function addRoute($route,$controller,$action) {

        $this->routes[$route] = ['controller' => $controller,'action' => $action];
    }

    public function dispatch($uri) {
        
          // Remove query parameters
            $uri = strtok($uri, '?');
            
        if (array_key_exists($uri,$this->routes)) {
            
            $controller = $this->routes[$uri]['controller'];
            $action = $this->routes[$uri]['action'];

            $controller = new $controller();
            $controller -> $action();

        }else {
            throw new \Exception("No route found for URI: $uri");    
        }
    }
} 


// class Router{
//         protected $routes = [];

//         private function addRoute($route, $controller, $action, $method)
//         {

//             $this->routes[$method][$route] = ['controller' => $controller, 'action' => $action];
//         }

//         public function get($route, $controller, $action)
//         {
//             $this->addRoute($route, $controller, $action, "GET");
//         }

//         public function post($route, $controller, $action)
//         {
//             $this->addRoute($route, $controller, $action, "POST");
//         }

//         public function dispatch()
//         {
//             $uri = strtok($_SERVER['REQUEST_URI'], '?');
//             $method =  $_SERVER['REQUEST_METHOD'];

//             if (array_key_exists($uri, $this->routes[$method])) {
//                 $controller = $this->routes[$method][$uri]['controller'];
//                 $action = $this->routes[$method][$uri]['action'];
                
//                 // echo "Dispatching to $controller::$action\n";
//                 $controller = new $controller();
//                 $controller->$action();
//             } else {
//                 throw new \Exception("No route found for URI: $uri");
//             }
//         }
// }
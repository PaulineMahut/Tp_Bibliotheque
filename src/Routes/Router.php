<?php

namespace App\Routes;

class Router {

    public $url;
    public $routes = [];

    public function __construct($url)
    {

        $this->url = trim($url, '/');  //retirer les slash en debut et en fin d'url

    }

    public function get(string $path, string $action)
    {
        $this->routes['GET'][] = new Route($path, $action); //tableau get dans le tableau routes, 2 instance de la class route
    }

    public function post(string $path, string $action)
    {
        $this->routes['POST'][] = new Route($path, $action);
    }
     
    public function run()
    {
        foreach ($this->routes[$_SERVER['REQUEST_METHOD']] as $route) { //server=variable globale qui contient plusieurs clés, GET
            
            if ($route->matches($this->url)) {

                $route->execute();

            } // si la route match avec l'url, on appelle la route mais ce serait pla fonction la qui appelerait la bonne fonction avec le bon controller
        }

        return header('HTTP/1.0 404 NOR FOUND');

    }
}
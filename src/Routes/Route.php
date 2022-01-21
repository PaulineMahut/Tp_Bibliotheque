<?php

namespace App\Routes;

class Route {

    public $path;
    public $action;
    public $matches;
    
    public function __construct($path, $action)
    {

        $this->path = trim($path, '/');
        $this->action = $action;
        
    }

    public function matches(string $url)
    {

        $path = preg_replace('#:([\w]+)#', '([^/]+)', $this->path); //remplacer tout ce qui peut commencer par :, et qui serait ecrit par caractère alphanumérique, et ce serait répété plusieurs fois par tout ce qui n'est pas un /, et on fait ça dans le path ($this)
        $pathToMatch = "#^$path$#"; //englober le path en entier, ce sera une expression reguliere

        if (preg_match($pathToMatch, $url, $matches)) { // onveut tester ça dans l'url, matches est un tableau qui contient le paramètre voulu, s'interesser à la deuxieme clé du tableau qui aura l'id de notre post par exemple
            
            $this->matches = $matches;
            
            return true; // si ça marche

        } else {

        return false;

        }
    }

    public function execute()
    {

        $params = explode('@', $this->action);
        $controller = new $params[0](); // première clé du tableau params = controller, creer nvl instance de bloc controller
        $method = $params[1];        

        
        return isset($this->matches[1]) ? $controller->$method($this->matches[1]) : $controller->$method(); //la clé 1 contiendra notre idée, si c'est le cas, appelle controller, on appelle la methode et on lui passe le param, sinon on ne lui passe pas, donc retour homepage ou static paage
    }
    // verifie si il y a bien 25 par exemple, si il y est, il appel la methode show et lui passe la chaine de caractère 25
}
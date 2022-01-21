<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/** 
 * @ORM\Entity 
*/
final class Livre extends Volume {

    /** 
     * @ORM\Column(type="integer") 
    */
    private int $disponible = 1;


    public function __construct(string $titre, string $auteur) //du premier parent au dernier enfant
    {
        parent::__construct($titre, $auteur);

        // $this->disponible = $disponible; //this est l'instance en cours, pas obligé car par défaut, le livre n'est pas tt de suite emprunté
    }

    /**
     * Get the value of disponible
     */ 
    public function getDisponible() : int
    {
        return $this->disponible;
    }

    /**
     * Set the value of disponible
     *
     * @return  self
     */ 
    public function setDisponible(int $disponible) : self
    {
        $this->disponible = $disponible;

        return $this;
    }


    public function isEmpruntable() : bool
    {
        return $this->disponible;
    }
}


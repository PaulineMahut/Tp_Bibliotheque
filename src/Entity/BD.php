<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/** @ORM\Entity */
final class BD extends Volume {

    /** 
     * @ORM\Column(name="dessinateur", type="string", length="100") 
    */
    private string $dessinateur;

    public function __construct(string $titre, string $auteur, string $dessinateur)
    {
        parent::__construct($titre, $auteur);

        $this->dessinateur = $dessinateur;
    }


    /**
     * Get the value of dessinateur
     */ 
    public function getDessinateur() : string
    {
        return $this->dessinateur;
    }

    /**
     * Set the value of dessinateur
     *
     * @return  self
     */ 

    public function setDessinateur($dessinateur) : self
    {
        $this->dessinateur = $dessinateur;

        return $this;
    }
}
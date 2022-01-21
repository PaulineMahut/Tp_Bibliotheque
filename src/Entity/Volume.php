<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;


/** @ORM\MappedSuperclass */
abstract class Volume extends Document {

    /** 
     * @ORM\Column(type="string", length="100") 
    */
    private string $auteur;

    public function __construct(string $titre, string $auteur) 
    {
        parent::__construct($titre);

        $this->auteur= $auteur;
    }


    /**
     * Get the value of auteur
     */ 
    public function getAuteur() : string
    {
        return $this->auteur;
    }

    /**
     * Set the value of auteur
     *
     * @return  self
     */ 
    public function setAuteur($auteur)
    {
        $this->auteur = $auteur;

        return $this;
    }
}
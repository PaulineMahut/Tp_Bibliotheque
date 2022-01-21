<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/** @ORM\Entity */
final class Dictionnaire extends Volume {


    /**
     * @ORM\Column(type="string", length="100")
    */
    private string $editeur;

    public function __construct(string $editeur, string $auteur, string $titre)
    {
        parent::__construct($titre, $auteur);

        $this->editeur = $editeur;
    }

    public function getEditeur() : string
    {
        return $this->editeur;
    }

    public function setEditeur(string $editeur) : self
    {
        $this->name = $editeur;

        return $this;

    }
    
}
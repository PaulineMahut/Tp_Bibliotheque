<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/** @ORM\Entity */
final class Visitor extends Adherent {

    /** @ORM\Column(type="string") */
    private string $piece_identite;
    
    public function __construct(string $nom, string $prenom, int $piece_identite)
    {
        parent::__construct($nom, $prenom);

        $this->piece_identite = $piece_identite;
    }

    public function getPieceIdentite() : string
    {
        return $this->piece_identite;
    }

    public function setPieceIdentite(int $new_value) : self
    {
        $this->piece_identite = $new_value;

        return $this;
    }

    public function emprunterLivre(Livre $livre) : void 
    {

    }
}
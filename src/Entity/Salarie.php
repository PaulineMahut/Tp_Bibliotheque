<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;


/** 
 * @ORM\Entity 
*/
final class Salarie extends Adherent {
     

    /** @ORM\Column(name="numero_badge", type="integer") */
    private int $numero_badge;

    public function __construct(string $nom, string $prenom, int $numero_badge, string $email, string $password)
    {
        parent::__construct($nom, $prenom, $email, $password);

        $this->numero_badge = $numero_badge;
    }


    public function emprunterLivre (Livre $livre) : void {

    }

    /**
     * Get the value of numero_badge
     */ 
    public function getNumero_badge()
    {
        return $this->numero_badge;
    }

    /**
     * Set the value of numero_badge
     *
     * @return  self
     */ 
    public function setNumero_badge($numero_badge)
    {
        $this->numero_badge = $numero_badge;

        return $this;
    }
}
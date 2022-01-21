<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;


/** 
 * @ORM\Entity 
*/
final class Salarie extends Adherent {
     

    /** @ORM\Column(name="numero_badge", type="integer") */
    private int $numero_badge;

    /** @ORM\Column(name="livre", type="string") */
    private livre $livre;

    public function __construct(string $nom, string $prenom, int $numero_badge)
    {
        parent::__construct($nom, $prenom);

        $this->numero_badge = $numero_badge;
    }

    public function setNumeroBadge($numero_badge) : self
    {
        $this->numero_badge = $numero_badge;

        return $this;
    }


    public function emprunterLivre (Livre $livre) : void {

    }

    public function badge_emprunt () : bool {
        return $this->badge_emprunt;
    }

}
<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Id;

/** @ORM\MappedSuperclass      
 * @ORM\Table(name="document",uniqueConstraints={@ORM\UniqueConstraint(name="search_idx", fields={"titre", "auteur"})})
*/
abstract class Document {

    /**
     * @ORM\Column(type="string")
     */
    private string $titre;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private int $id;

    public function __construct(string $titre)
    {
        $this->titre = $titre; //this cible l'instance
    }
    
 


    /**
     * Get the value of titre
     */ 
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * Set the value of titre
     *
     * @return  self
     */ 
    public function setTitre($titre)
    {
        $this->titre = $titre;

        return $this;
    }
}
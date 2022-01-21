<?php

namespace App\Entity;

use App\Interfaces\UserInterface;

use Doctrine\ORM\Mapping as ORM;

/** @ORM\MappedSuperclass */
abstract class Adherent implements UserInterface{

    /** 
     * @ORM\Column(name="nom", type="string") 
    */
    private string $nom;

    /** 
     * @ORM\Column(name="prenom", type="string") 
    */
    private string $prenom;

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private int $id;
    

    public function __construct(string $nom, string $prenom)
    {
        $this->nom = $nom;
        $this->prenom = $prenom;

        $this->id = random_int(1, 99999);
    }

/** Get the value of id */

    public function getId() : int
    {
        return $this->id;
    }

   

    /**
     * Get the value of prenom
     */ 
    public function getPrenom() : string
    {
        return $this->prenom;
    }

    /**
     * Set the value of prenom
     *
     * @return  self
     */ 
    public function setPrenom(string $prenom) : self
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get the value of nom
     */ 
    public function getNom() : string
    {
        return $this->nom;
    }

    /**
     * Set the value of nom
     *
     * @return  self
     */ 
    public function setNom(string $nom) : self 
    {
        $this->nom = $nom;

        return $this;
    }


public function rendreLivre () : void {

    }

}
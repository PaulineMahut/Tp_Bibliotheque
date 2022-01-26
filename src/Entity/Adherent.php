<?php

namespace App\Entity;

use App\Interfaces\UserInterface;

use Doctrine\ORM\Mapping as ORM;

/** @ORM\Entity
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="discr", type="string")
 * @ORM\DiscriminatorMap({"salarie"="Salarie", "visitor"="Visitor"})
 */
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

    /** 
     * @ORM\Column(name="email", type="string") 
    */
    private string $email;

    /** 
     * @ORM\Column(name="password", type="string", length="255") 
    */
    private string $password;
    

    public function __construct(string $nom, string $prenom, string $email, string $password)
    {
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->email = $email;
        $this->password = password_hash($password, PASSWORD_DEFAULT);

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


    /**
     * Get the value of email
     */ 
    public function getEmail() : string 
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @return  self
     */ 
    public function setEmail(string $email) : self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of password
     */ 
    public function getPassword() : string
    {
        return $this->password;
    }

    /**
     * Set the value of password
     *
     * @return  self
     */ 
    public function setPassword(string $password) : self
    {
        $this->password = $password;

        return $this;
    }
}
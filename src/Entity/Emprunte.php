<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

use DateTimeImmutable;

/** @ORM\Entity */
class Emprunte {


    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private int $id;

    /**
     * @Orm\Column(type="datetime", name="date_emprunt")
     */
    private \DateTime $date_emprunt;

    /**
     * @ORm\Column(length="8", name="date_retour")
     */
    private \DateTime $date_retour;


    /**
     * @ORM\ManyToOne(targetEntity="Adherent") //plusieurs pour 1, plusieurs emprunt peuvent avoir 1 seul et meme membre
     * @ORM\JoinColumn(name="adherent_id", referencedColumnName="id") //précise le nom de la colonne de ref avec laquelle on fait la relation
     */
    private Adherent $adherent;


    /**
     * @ORM\ManyToOne(targetEntity="Livre") //plusieurs pour 1, plusieurs emprunt peuvent avoir 1 seul et meme mebre
     * @ORM\JoinColumn(name="livre_id", referencedColumnName="id")
     */
    private Livre $livre;

    public function __construct(\DateTime $date_emprunt, Adherent $adherent, Livre $livre) //qu'on on emprunte, pn a aussi un membre et un livre
    {
        $this->date_emprunt = $date_emprunt;
        $this->adherent = $adherent;
        $this->livre = $livre;

        $this->date_retour = $this->date_emprunt->modify("+2 weeks");

    }

    /**
     * Set the value of return date
     */
    public function prolongerDateRetour(int $day) : void 
    {
        $this->date_retour->modify("+$day days");
    }

    /**
     * Get the value of date_retour
     */ 
    public function getDate_retour() : \DateTime
    {
        return $this->date_retour;
    }

    /**
     * Set the value of date_retour
     *
     * @return  self
     */ 

    public function setDate_retour($date_retour)
    {
        $this->date_retour = $date_retour;

        return $this;
    }

    /**
     * Get the value of adherent
     */ 
    public function getAdherent()
    {
        return $this->adherent;
    }

    /**
     * Set the value of adherent
     *
     * @return  self
     */ 
    public function setAdherent($adherent)
    {
        $this->adherent = $adherent;

        return $this;
    }

    /**
     * Get the value of livre
     */ 
    public function getLivre() : Livre
    {
        return $this->livre;
    }

    /**
     * Set the value of livre
     *
     * @return  self
     */ 
    public function setLivre(Livre $livre) : self
    {
        $this->livre = $livre;

        return $this;
    }

    /**
     * Get the value of id
     */ 
    public function getId()
    {
        return $this->id;
    }

    /**
     * Get the value of date_emprunt
     */ 
    public function getDate_emprunt()
    {
        return $this->date_emprunt;
    }

    /**
     * Set the value of date_emprunt
     *
     * @return  self
     */ 
    public function setDate_emprunt(\DateTime $date_emprunt) : self
    {
        $this->date_emprunt = $date_emprunt;

        return $this;
    }
}
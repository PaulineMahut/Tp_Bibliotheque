<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/** @ORM\Entity */
final class Bibliotheque {

    private array $adherentList = [];

    private array $documentList = [];

    /**
     * @ ORM\Column(type="string", length="100")
     */
    private string $name; //nom de la librairie

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     */
    private int $id;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    public function getName() : string
    {
        return $this->name;
    }

    public function setName(string $name) : self
    {
        $this->name = $name;

        return $this;

    }

    public function ajouterAdherent (Adherent $adherent): self  // avec self, ajouter return $this;
    {
        array_push($this->adherentList, $adherent);
        return $this;
    }

    public function supprAdherent (Adherent $adherent) : self
    {
        foreach ($this->adherentList as $key => $adh) {

            if ($adherent->getId() === $adh->getId() ) { //compare id du membre param et celui de la boucle
                unset($this->adherentList[$key]);
            }
        }

        return $this;
        
    }

    public function ajouterDocument (Document $document) : self  //Document contient Journal | Volume | Livre | BD ..
    {
        array_push($this->documentList, $document); //cibler ce qu'il y a dans instance

        return $this;
    }




    public function supprDocument(Document $document)
    {
        foreach ($this->documentList as $key => $value) {         //une colonne key , une colonne value
            if ($document->getTitre() === $value->getTitre()) 
            {
                unset($this->documentList[$key]);                   //on prend la valeur entre crochet et on la supprime 
            }
        }
    }

    





    /**
     * Get the value of adherentList
     */ 
    public function getAdherentList(): array
    {
        return $this->adherentList;
    }

    /**
     * Get the value of documentList
     */ 
    public function getDocumentList() : array
    {
        return $this->documentList;
    }
}


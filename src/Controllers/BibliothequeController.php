<?php

namespace App\Controllers;

use App\Entity\Bibliotheque;
use App\Helpers\EntityManagerHelper;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping\ClassMetadata;

class BibliothequeController
{

    public function addBiblio()
    {
        
        $entityManager = EntityManagerHelper::getEntityManager();
        
        if (!empty($_POST["name"])) {
            $name = strip_tags($_POST["name"]);
            if (trim($_POST["name"]) === "" ) {
                
                $error = "Le champ doit être rempli";
                echo $error;
                die();
            }
            
            $bibliotheque = new Bibliotheque($name);
            
            $entityManager->persist($bibliotheque);
            $entityManager->flush();
        }
        include("./src/vues/addBibliotheque.php");
    }

    public function modifBiblio(string $sId)
    {
        $entityManager = EntityManagerHelper::getEntityManager(); //recupere une instance d'entitymanager
        $biblioRepo = new EntityRepository($entityManager, new ClassMetadata("App\Entity\Bibliotheque")); //creer instance de entityrepository

        $bibliotheque = $biblioRepo->find($sId); //recupere dans la bdd la bibliotheque avec cet id

        include("./src/vues/modifierBibliotheque.php"); //formulaire

        if (!empty($_POST["name"])) {
            $name = strip_tags($_POST["name"]);
            if (trim($_POST["name"]) === "" ) {

                $error = "Le champ doit être rempli";
                echo $error;
                die();
            }

            $bibliotheque->setName($bibliotheque);

            $entityManager->persist($bibliotheque);
            $entityManager->flush();
        }

        include("./src/vues/modifierBibliotheque.php"); //remettre a la fin comme ca affiche apres modification

    }

    public function deleteBibliotheque($sId)
    {
        $entityManager = EntityManagerHelper::getEntityManager(); //recupere une instance d'entitymanager
        $biblioRepo = new EntityRepository($entityManager, new ClassMetadata("App\Entity\Bibliotheque")); //creer instance de entityrepository

        $bibliotheque = $biblioRepo->find($sId); //recupere dans la bdd la bibliotheque avec cet id

        $entityManager->remove($bibliotheque);
        $entityManager->flush();

    }
}

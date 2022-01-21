<?php

namespace App\Controllers;

session_start();

use App\Helpers\EntityManagerHelper as Em;
use App\Models\AbstractRepository;
use Doctrine\ORM\Mapping\ClassMetadata;
use App\Entity\Visitor;

class VisiteurController {

    public function index()
    {
        echo "bonjour visiteur";

    }

    public function afficherVisiteurs()
    {
        $entityManager = Em::getEntityManager();
        $metadataClass = new ClassMetadata("App\Entity\Visitor");
        $livreRepo = new AbstractRepository($entityManager, $metadataClass);
        $aLivres = $livreRepo->findAll();
    }

    public function afficherFormulaire()
    {

        include './src/vues/formulaireVisitor.php';
        
    }


    const NEEDLES = [
        "nom",
        "prenom",
        "piece_identite"
    ];

    public static function addVisitor() {
            
        //Méthode Lory

        foreach (self::NEEDLES as $key => $value) { //appel tableau
            if (!array_key_exists($value, $_POST)) { //si array key devient faux, dire qu'il manque des choses, verifie si titre est rempli, puis auteur
                $_SESSION["error"]= "Il manque des champs à remplir";
                header("location: http://localhost/autoload/src/vues/formulaireVisitor.php");
                exit;
            }

            $_POST[$value]= htmlentities(strip_tags($_POST[$value])); //securiser, enlever balises html
            
        }

        $visitor = new Visitor($_POST["nom"], $_POST["prenom"], (int) $_POST["piece_identite"]);
        $entityManager =Em::getEntityManager();
        $entityManager->persist($visitor);
        $entityManager->flush();

        header("location: http://localhost/autoload/src/vues/formulaireVisitor.php");

        
        // $visitor = new Visitor("DUPONT", "James", 56456346353);
        //     $em->persist($visitor);
        //     $em->flush();
    
        }

}
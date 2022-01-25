<?php

namespace App\Controllers;

session_start();

use App\Helpers\EntityManagerHelper as Em;
use App\Models\AbstractRepository;
use Doctrine\ORM\Mapping\ClassMetadata;
use App\Entity\Visitor;
use App\Helpers\EntityManagerHelper;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;

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

        if (!empty($_POST)) { //si c'est vide on met l'erreur
        foreach (self::NEEDLES as $value) { //appel tableau
            if (!array_key_exists($value, $_POST)) { //si array key devient faux, dire qu'il manque des choses, verifie si titre est rempli, puis auteur
                $error= "Il manque des champs à remplir";
                include("./src/vues/formulaireVisitor.php");
                exit;
            }

            $_POST[$value]= htmlentities(strip_tags($_POST[$value])); //securiser, enlever balises html
            
        }

        $piece_identite = (int) $_POST["piece_identite"];

        $visitor = new Visitor($_POST["nom"], $_POST["prenom"], $piece_identite);
        
        $entityManager =Em::getEntityManager();
        $entityManager->persist($visitor);
        $entityManager->flush();

    }

    include("./src/vues/formulaireVisitor.php"); //renvoit vers le formulaire
    
    }


    public function modifierVisitor(string $sId)
    {

        $entityManager = EntityManagerHelper::getEntityManager();
        $visitorRepo = new EntityRepository($entityManager, new ClassMetadata("App\Entity\Visitor"));
        
        $visitor = $visitorRepo->find($sId);

        if (!empty($_POST)) {
            foreach (self::NEEDLES as $value) {
                if (!array_key_exists($value, $_POST)) {
                    $error = "Il manque des champs à remplir";
                    include(__DIR__. "/../vues/modifierVisitor.php");
                    exit;
                }
                
                $_POST[$value] = htmlentities(strip_tags($_POST[$value])); //supprime les balises html et php d'une chaîne
        }

        $visitor->setNom($_POST["nom"]);
        $visitor->setPrenom($_POST["prenom"]);
        $visitor->setPieceIdentite($_POST["piece_identite"]);

        $entityManager->persist($visitor);
        $entityManager->flush();
    }

    $visitorDatas = [];
    $visitorDatas["id"] = $visitor->getId();

    foreach (self::NEEDLES as $value) {
        $getteur = "get". ucfirst($value);
        if ($value === "piece_identite") {
            $getteur = "getPieceIdentite";
        }
        $visitorDatas[$value] = $visitor->$getteur();
    }

    include(__DIR__. "/../vues/modifierVisitor.php");
}

}
<?php

namespace App\Controllers;

use App\Entity\Livre;
use App\Helpers\EntityManagerHelper as Em;
use App\Models\AbstractRepository;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping\ClassMetadata;
use App\Helpers\SerializerHelper as Serializer;
use Exception;

class LivreController {

    const NEEDLES = [
        "titre",
        "auteur"
    ];

    public function index() {

        echo 'livre';
    }

    public function afficherLivres()
    {

        $entityManager = Em::getEntityManager();
        $metadataClass = new ClassMetadata("App\Entity\Livre");
        $livresRepo = new AbstractRepository($entityManager, $metadataClass); //respository= recuperer dans la bdd
        $aLivres = $livresRepo->findAll();
        // print(Serializer::getSerializer()->serialize($aLivres, 'json'));
        include './src/vues/livres.php';
    }



    public function showOne(string $sId)
    {

        $sId = (int) $sId;

        $entityManager = Em::getEntityManager();
        $metadataClass = new ClassMetadata("App\Entity\Livre");
        $livreRepo = new AbstractRepository($entityManager, $metadataClass);
        $oLivre = $livreRepo->find((int)$sId);
        print(Serializer::getSerializer()->serialize($oLivre, 'json'));
      
    }

    public function addLivre() {

        if (isset($_POST['titre'], $_POST['auteur'])) { //vérifier si les champs sont vide,sinon ne peut pas se créer, tester si c'est vide et renvoyer vers le formulaire
            $titre = $_POST['titre'];
            $auteur = $_POST['auteur'];
        } else
            throw new Exception("Champ vide"); //si vide, exception affichée
            
        $entityManager = Em::getEntityManager();

        $livre = new Livre($titre, $auteur);
        $entityManager->persist($livre);

        try {
            $entityManager->flush($livre);
            echo 'Livre ajouté !';
        } catch (\Throwable $th) {
            exit("Livre déjà ajouté");
        }
        
    }




    public function afficherFormulaire()
    {

        include './src/vues/formulaireLivre.php';
        
    }

    public function modifierFormulaire($id)
    {
        $entityManager = Em::getEntityManager();
        $metadataClass = new ClassMetadata("App\Entity\Livre");
        $livreRepo = new AbstractRepository($entityManager, $metadataClass);
        $livre = $livreRepo->find($id);

        include './src/vues/modifierLivre.php';


    }

    public function modifierbdd($id)
    {
        if (isset($_POST['titre'], $_POST['auteur'])) { //vérifier si les champs sont vide,sinon ne peut pas se créer, tester si c'est vide et renvoyer vers le formulaire
            $titre = $_POST['titre'];
            $auteur = $_POST['auteur'];
        } else
            throw new Exception("Champ vide");

            $entityManager = Em::getEntityManager();
            $metadataClass = new ClassMetadata("App\Entity\Livre");
            $livreRepo = new AbstractRepository($entityManager, $metadataClass);
            $livre = $livreRepo->find($id);

            $livre->setTitre($titre);
            $livre->setAuteur($auteur);
            try {
                $entityManager->flush();
                echo "Bien jouer bg";
            } catch (\Throwable $th) {
                echo $th->getMessage();
            }
    }

    // const NEED = [
    //     "nom",
    //     "prenom",
    //     "numero_badge"
    // ];

    // public function add()
    // {
    //     if (!empty($_POST)) { //si c'est vide on met l'erreur
    //     foreach (self::NEED as $value) {
    //         if (!array_key_exists($value, $_POST)) {
    //             $error = "Il manque des champs à remplir";
    //             include("./src/vues/formulaireVisitor.php");
    //             exit;
    //         }
    //         $_POST[$value] = htmlentities(strip_tags($_POST[$value]));
    //     }

    //     $numero_badge = (int) $_POST["numero_badge"];
    //     $visitor = new Visitor($_POST["nom"], $_POST["prenom"], $numero_badge);

    //     $entityManager = EntityManagerHelper::getEntityManager();
    //     $entityManager->persist($visitor);
    //     $entityManager->flush;
    // }

    // include("./src/vues/formulaireVisitor.php"); //renvoit vers le formulaire

    // }

 
    public function modifLivre(string $sId)
    {

    //     $sId = (int) $sId;

    //     $entityManager = EntityManagerHelper::getEntityManager();
    //     $livreRepo = new EntityRepository($entityManager, new ClassMetadata("App\Entity\Livre")); //contient une nouvelle instance de la classe entityrepository
        
    //     $livre = $livreRepo->find($sId);

    //     $livreDatas = [];

    //     foreach (self::NEEDLES as $value) { //pas de clé(key) car que des entiers
    //         $getteur = "get". ucfirst($value);
    //         if ($value === "badge_number") {
    //             $getteur = "getBadgeNumber";
    //         }
    //         $livreDatas[$value] = $livre->$getteur(); 
    //     }

    //     // $employeeDatas["id"] = $employee->getId();
    //     $_SESSION["livreDatas"] = $livreDatas;


    //     header("location: http://localhost/autoload/src/vues/modifierLivre.php");




        // $entityManager = Em::getEntityManager();
        // $metadataClass = new ClassMetadata("App\Entity\Livre");
        // $livresRepo = new AbstractRepository($entityManager, $metadataClass); //respository= recuperer dans la bdd
        // $aLivres = $livresRepo->findAll();
        
        // foreach ($aLivres as $k => $livre) { //parcours un tableau
        //     $title = $livre->getTitre();
        //     $author = $livre->getAuteur();
        //     print("<p>" . $title .' '. "<span style='font-weight:bold'>" . $author ."</span>" .' '. "<a href=''>". ' ' ."<p/><br/>" );

        // }

    }


    public function supprLivre($id)
    {
            $entityManager = Em::getEntityManager();
            $metadataClass = new ClassMetadata("App\Entity\Livre");
            $livreRepo = new AbstractRepository($entityManager, $metadataClass);
            $livre = $livreRepo->find($id);

            $entityManager->remove($livre);
            try {
                $entityManager->flush();
                echo'Livre Supprimé';
            } catch (\Throwable $th) {
                echo $th->getMessage();
            }
        
    }

}


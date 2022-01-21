<?php

namespace App\Controllers;

use App\Entity\Livre;
use App\Helpers\EntityManagerHelper as Em;
use App\Models\AbstractRepository;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping\ClassMetadata;
use App\Entity\Visitor;
use App\Helpers\SerializerHelper as Serializer;
use Exception;

class LivreController {

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
        foreach ($aLivres as $k => $livre) { //parcours un tableau
            $title = $livre->getTitre();
            $author = $livre->getAuteur();
            print("<p>" . $title .' '. "<span style='font-weight:bold'>" . $author ."</span>".' '. "<p/><br/>" );

        }
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
        } catch (\Throwable $th) {
            exit("Livre déjà ajouté");
        }
        
    }

    public function afficherFormulaire()
    {

        include './src/vues/formulaireLivre.php';
        
    }
 
    public function modifLivre($titre, $auteur)
    {

        include './src/vues/formulaireLivre.php';

        $entityManager = Em::getEntityManager();
        $metadataClass = new ClassMetadata("App\Entity\Livre");
        $livresRepo = new AbstractRepository($entityManager, $metadataClass); //respository= recuperer dans la bdd
        $aLivres = $livresRepo->findAll();
        
        foreach ($aLivres as $k => $livre) { //parcours un tableau
            $title = $livre->getTitre();
            $author = $livre->getAuteur();
            print("<p>" . $title .' '. "<span style='font-weight:bold'>" . $author ."</span>" .' '. "<a href=''>". ' ' ."<p/><br/>" );

        }

        try {
            $query = $conn->prepare("UPDATE `Livre` SET `titre` = :titre , `auteur`= :auteur  WHERE `user_id` = :user_id AND `id`= :article_id ");
            $response = $query->execute(['article_id' => $article_id, 'titre' => $titre, 'auteur' => $auteur, 'user_id' => $user_id]);
        } catch ( \PDOException $err) {
            $error_code = $err->getCode();
            $error_msg = $err->getMessage();
            $error["message"] .= $error_msg;
            $error["exist"] = true;
    
            return $error;
        }
        
        if (!$response) {
            $error["message"] .= "Une erreur s'est produite durant la mofication de l'article'";
            $error["exist"] = true;
            return $error;
        }

    }

    public function supprLivre()
    {

        
    }

}


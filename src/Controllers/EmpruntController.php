<?php

namespace App\Controllers;

use App\Entity\Adherent;
use App\Entity\BD;
use App\Entity\Bibliotheque;
use App\Entity\Dictionnaire;
use App\Entity\Document;
use App\Entity\Journal;
use App\Entity\Emprunte;
use App\Entity\Livre;

use App\Helpers\EntityManagerHelper;
use App\Models\AbstractRepository;
use DateTime;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping\ClassMetadata;

class EmpruntController {


    public function index()
    {
        $entityManager = EntityManagerHelper::getEntityManager();

        $this->addFake($entityManager); //this appelle la méthode

        $empruntRepo = new AbstractRepository($entityManager, new ClassMetadata("App\Entity\Emprunte"));
        
        $emprunts = $empruntRepo->findAll();

        foreach ($emprunts as $emprunt) {
            var_dump($emprunt->getAdherent()->getNom());
        }
    }

const NEEDLES = [
    "date",
    "adherent",
    "livre"
]; //crochets= cibler une clé dans un tableau

    public function addEmprunt()
    {

        if (empty($_POST)) { //vverifier le cas ou on arrive sur la page et il n'y a rien
            include("./src/vues/addEmprunt.php");
            die();
        }

        foreach (self::NEEDLES as $value) { //on a juste des valeurs et pas de clés, premier tour de bocule, value=date, 2eme=adherent ....
            
            $_POST[$value]= htmlentities(strip_tags(trim($_POST[$value]))); //securiser, enlever balises html
            if ($_POST[$value] === "") {
                $error ="Il manque de champs à remplir";
                include("./src/vues/addEmprunt.php");
                return $error;
            
            }
            if (!array_key_exists($value, $_POST)) { //si clé donnée n'exite pas dans le tableau $_POST(tableau associatif par défaut)
                $error ="Il manque de champs à remplir";
                include("./src/vues/addEmprunt.php");
                
            }

            
        }

        $entityManager = EntityManagerHelper::getEntityManager();

        $adherentRepo = new AbstractRepository($entityManager, new ClassMetadata("App\Entity\Adherent"));
        $adherent = $adherentRepo->find($_POST["adherent"]);

        $livreRepo = new AbstractRepository($entityManager, new ClassMetadata("App\Entity\Livre"));
        $livre = $livreRepo->find($_POST["livre"]); //find cherche un membre par rapport a l'id qu'il a dans la bdd

        $emprunt = new Emprunte(new DateTime(), $adherent, $livre);

        $entityManager->persist($emprunt);
        $entityManager->flush();
        
        include("./src/vues/addEmprunt.php");
        
        
    }
    
    public function modifEmprunt(string $id)
    {
        $entityManager = EntityManagerHelper::getEntityManager();
        
        $empruntRepo = new EntityRepository($entityManager, new ClassMetadata("App\Entity\Emprunt"));
        $adherentRepo = new EntityRepository($entityManager, new ClassMetadata("App\Entity\Adherent"));
        $livreRepo = new EntityRepository($entityManager, new ClassMetadata("App\Entity\Livre"));
        
        $oEmprunt = $empruntRepo->find($id); //recupere l'emprunt a l'aide de la bdd grace au repository, recuperer une instance de livre, avec id dans l'url
        
        
        
        // $oEmprunt->getAdherent() dans la vue
        
        if (empty($_POST)) { //vérifier si le tbleau $post est vide, boucle sur le formulaire POST, $post est censé avoir des champs, on peut les supprimer dans l'inspecteur, pour eviter ca
            foreach (self::NEEDLES as $value) { //c'est dans le tableau needles qu'il faut vérifier,
                
                $exist = array_key_exists($value, $_POST); // verifier si une clé existe dans le tableau, il veut la clé $value = date/adherent/livre dans le tableau, renvoit vrai ou faux
                if ($exist === false) {
                    echo "Erreur";
                    include("./src/vues/modifierEmprunt.php");
                    die(); //si une clé manque le programme s'arrete ici
                }

                $_POST[$value] = htmlentities(strip_tags($_POST[$value])); //les données arrivent dans $POST apres formulaire, on va les filtrer, recuperer valeur de date, la modifier et la remettre
            }
            
        
            
            
            if($_POST["adherent"] !== $oEmprunt->getAdherent()->getId() ) { //si ce qu'on me passe est different de l'id deja mis, alors on change
                
                $oAdherent = $adherentRepo->find($_POST["adherent"]); //recupere l'emprunt a l'aide de la bdd grace au repository, recuperer une instance de livre, avec id dans l'url
                $oEmprunt->setAdherent($oAdherent); //dans l'emprunt modfie un membre
            }

            if($_POST["livre"] !== $oEmprunt->getLivre()->getId() ) { //si ce qu'on me passe est different de l'id deja mis, alors on change
                
                $oLivre = $livreRepo->find($_POST["livre"]); //recupere l'emprunt a l'aide de la bdd grace au repository, recuperer une instance de livre, avec id dans l'url
                $oEmprunt->setLivre($oLivre);
            }

            if($_POST["date"] !== $oEmprunt->getDate_emprunt()->format("Y-m-d") ) { //on rentre dans le if si les 2 sont différents
                
                $oEmprunt->setDate_emprunt(DateTime::createFromFormat("Y-m-d", $_POST["date"])); //modifie la propriété, nouvelle valeur est dans POST
               
            }

            $entityManager->persist($oEmprunt);
            $entityManager->flush();
            
        }
        
        include("./src/vues/modifierEmprunt.php");
    }

    public function addFake()
    {
        
    }

}

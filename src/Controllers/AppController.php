<?php

namespace App\Controllers;

use App\Entity\Visitor;
use App\Entity\Emprunte;
use App\Entity\Livre;
use App\Helpers\EntityManagerHelper;
use App\Models\AbstractRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping\ClassMetadata;
use Exception;
use Laminas\Mail;

class AppController
{

    public static function index()
    {
    }


    // public static function AddVisitor($em) {
    //     $visitor = new Visitor("DUPONT", "James", 56456346353);
    //     $em->persist($visitor);
    //     $em->flush();

    // }

    // public static function getAllLivre()
    // {
    //     $entityManager = Em::getEntityManager();
    //     $metadataClass = new ClassMetadata("App\Entity\Livre");
    //     $livreRepo = new AbstractRepository($entityManager, $metadataClass);
    //     $aLivres = $livreRepo->findAll(); //tableau de livres
    //     // var_dump($aLivres);
    //     // exit;
    // }

    // public static function getAllEmprunt()
    // {
    //     $entityManager = Em::getEntityManager();
    //     $metadataClass = new ClassMetadata("App\Entity\Eprunte");
    //     $empruntRepo = new AbstractRepository($entityManager, $metadataClass);
    //     $aEmprunts = $empruntRepo->findAll(); //tableau des emprunts
    //     var_dump($aEmprunts);
    //     exit;
    // }

    const NEEDS = [
        'email',
        'password'
    ];

    public function login()
    {

        if (empty($_POST)) {
            include("./src/vues/login.php");
        }

        if (!empty($_POST)) {
            foreach (self::NEEDS as $value) {
                if (!array_key_exists($value, $_POST)) {
                    echo "La valeur n'existe pas";
                    die();
                }
                $_POST[$value] = trim(htmlentities(strip_tags($_POST[$value])));
                if ($_POST[$value] === "") {
                    echo "Pas d'espaces";
                    die();
                }
            }

            $entityManager = EntityManagerHelper::getEntityManager();
            $repo = new EntityRepository($entityManager, new ClassMetadata("App\Entity\Adherent"));

            $adherent = $repo->findBy(['email' => $_POST['email']]);

            if (empty($adherent)) {
                echo "Cet utilisateur n'existe pas";
                die();
            }

            if (password_verify($_POST['password'], $adherent[0]->getPassword()) === false) {
                echo "Mot de passe incorrect";
                die();
            }

            
            $_SESSION['email'] = $_POST['email'];
            $_SESSION['prenom'] = $adherent[0]->getPrenom();
            $_SESSION['type'] = strtolower(str_replace("App\Entity\\", "", get_class($adherent[0])));
            
            include("./src/vues/livres.php");
        }

    }
}

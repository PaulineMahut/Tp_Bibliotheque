<?php

namespace App\Controllers;

use App\Entity\Visitor;
use App\Entity\Emprunte;
use App\Entity\Livre;
use App\Helpers\EntityManagerHelper as Em;
use App\Models\AbstractRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Mapping\ClassMetadata;
use Exception;
use Laminas\Mail;

class AppController
{

    public static function index()
    {
        // $em = Em::getEntityManager();
        // require_once('bootstrap.php');
        // $em = $entityManager;

        // $livre = new Livre("Hunger Games", "Suzanne Collins");
        // $em->persist($livre);

        // $visitor = new Visitor("DUPONT", "James", 56456346353);
        // $em->persist($visitor);

        // $date = (new \DateTime())->format("d-m-Y h:i:s");

        // $emprunt1 = new Emprunte(new \DateTime(), $visitor, $livre);
        // $em->persist($emprunt1);
        
        // $em->flush();

        // try {
        //     $em->flush();
        // } catch (\Throwable $th) {
        //     self::SendMail();
        // }
        

        // try {
        //     $em->flush();
        // } catch (\Exception $err) {
            // print("Une erreur s'est produite, veuillez véfifier vos mails pour plus de détails");
            // $mail = new Mail\Message();
            // $mail->setBody("$err");
            // $mail->setFrom('pauline.mahut@free.fr', "Pzkjfnq");
            // $mail->addTo('pauline.mahut@free.fr', "Name of recipient");
            // $mail->setSubject('TestSubject');

            // $transport = new Mail\Transport\Sendmail();
            // var_dump($transport);
            // exit;
            // $transport->send($mail);
    //     }

    // }

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

}

        public function show()
        {
            # code...
        }
}



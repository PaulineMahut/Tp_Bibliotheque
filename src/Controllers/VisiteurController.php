<?php

namespace App\Controllers;

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

    public static function AddVisitor($em) {
            $visitor = new Visitor("DUPONT", "James", 56456346353);
            $em->persist($visitor);
            $em->flush();
    
        }
}
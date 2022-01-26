<?php

namespace App;

session_start();

require_once('vendor/autoload.php');

// require_once('bootstrap.php');

use App\Entity\Client;
use App\Entity\Adherent;
use App\Entity\Salarie;
use App\Entity\Bibliotheque;
use App\Entity\Document;
use App\Entity\Emprunte;
use App\Entity\Visitor;
use App\Entity\Journal;
use App\Entity\Livre;
use DateTime;
use DateTimeImmutable;
use App\Controllers\AppController;
use App\Routes\Router;
use App\Controllers\LivreController;


//date qu'on ne peut pas changer
// $journal = new Journal("Journal de 13h", new DateTimeImmutable());
// $journal->setDateParution();
// var_dump($journal);


// $book1 = new Livre("Alice aux pays des merveilles", "Disney");
// $biblio->AddDocument($book1)->supprDocument($book1);


// créer 2 emprunts de libre différents pour 2 visiteur

// $visitor = new Visitor("Dupont", "Jean", 546546546546);
// $book = new Livre("Alice au pays des merveilles ", "Disney");

// $emprunt1 = new Emprunte(new DateTime(), $visitor, $livre); //nouvelle date

// print($date_emprunt->getDate_retour()->format('d-m-Y h:i:s'));

// $emprunt1->prolongerDateRetour(355);

// print($date_emprunt->getDate_retour()->format('d-m-Y h:i:s'));

// $emprunt2 = new Emprunte(new DateTime(), $visitor, $livre);

// print($date_emprunt->getDate_retour()->format('d-m-Y h:i:s'));

// $emprunt2->prolongerDateRetour(62);


// $livre = new Livre("Et", "Dinsey");
// $entityManager->persist($livre);
// $entityManager->flush();

// $date_emprunt = new \DateTime('d-0-Y h:i:s');

// $format ="d M Y h:i:s";
// $date = \DateTime::createFromFormat($format, (new DateTime())->format($format)) (new DateTime())->format($format));


// CREER UN EMPRUNT ET L'ENREGISTRER EN BASE DE DONNEES

// $livre = new Livre("Hunger Games", "Suzanne Collins");
// $entityManager->persist($livre);

// $visitor = new Visitor("DUPONT", "James", 56456346353 );
// $entityManager->persist($visitor);

// $date = (new \DateTime())->format("d-m-Y h:i:s");

// $emprunt1 = new Emprunte(new \DateTime(), $visitor, $livre);
// $entityManager->persist($emprunt1);

// $entityManager->flush();


//Passer par un controler pour exécuter l'ajout d'un emprunt


// $page = new AppController();

// $page->index();

// AppController::index();

// AppController::getAllLivre();
// AppController::getAllEmprunt();

$router = new Router($_GET['url']);

if (!empty($_SESSION['type'])) {
    $_SESSION['type'] = "";
}
    switch ($_SESSION['type']) {
    case 'visitor':
        $router->get('/livres', 'App\Controllers\LivreController@afficherLivres');
        break;

    case 'salarie':
        break;

    default:
        $router->get('/addVisitor', 'App\Controllers\VisiteurController@addVisitor');
        $router->post('/addVisitor', 'App\Controllers\VisiteurController@addVisitor');

        $router->get('/modifierVisitor/:id', 'App\Controllers\VisiteurController@modifierVisitor');
        $router->post('/modifierVisitor/:id', 'App\Controllers\VisiteurController@modifierVisitor');

        $router->get('/addBiblio', 'App\Controllers\BibliothequeController@addBiblio');
        $router->post('/addBiblio', 'App\Controllers\BibliothequeController@addBiblio');

        $router->get('/biblio/:id', 'App\Controllers\BibliothequeController@modifBiblio');
        $router->post('/biblio/:id', 'App\Controllers\BibliothequeController@modifBiblio');

        $router->get('/addEmprunt', 'App\Controllers\EmpruntController@addEmprunt');
        $router->post('/addEmprunt', 'App\Controllers\EmpruntController@addEmprunt');

        $router->get('/emprunt/:id', 'App\Controllers\EmpruntController@modifEmprunt');
        $router->post('/emprunt/:id', 'App\Controllers\EmpruntController@modifEmprunt');

        $router->get('/deleteBibliotheque/:id', 'App\Controllers\BibliothequeController@deleteBiblio');


        $router->get('/', 'App\Controllers\AppController@login');
        $router->post('/', 'App\Controllers\AppController@login');

        $router->get('/', 'App\Controllers\AppController@index');


        $router->get('/livre/:id', 'App\Controllers\LivreController@showOne');

        $router->get('/modifierLivre/:id', 'App\Controllers\LivreController@modifierFormulaire');
        $router->post('/modifierLivre/:id', 'App\Controllers\LivreController@modifierbdd');

        $router->get('/ajoutLivre', 'App\Controllers\LivreController@afficherFormulaire');
        $router->post('/ajoutLivre', 'App\Controllers\LivreController@addLivre');

        $router->get('/supprimerLivre/:id', 'App\Controllers\LivreController@supprLivre');
        break;
}



// $router->get('/modifier', 'App\Controllers\LivreController@addLivre');
// $router->get('/modifier:id', 'App\Controllers\LivreController@modifLivre');
// $router->post('/modifier:id', 'App\Controllers\LivreController@modifLivre');



// $router->run('/book/:id', 'App\Entity\LivreController@show');

$router->run();

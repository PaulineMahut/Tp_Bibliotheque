<?

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

        if (isset($_POST['titre'], $_POST['auteur'])) {
            $titre = $_POST['titre'];
            $auteur = $_POST['auteur'];
        } else
            throw new Exception("Champ vide");
            
        $entityManager = Em::getEntityManager();
        $livre = new Livre($titre, $auteur);
        $entityManager->persist($livre);
        try {
            $entityManager->flush($livre);
        } catch (\Throwable $th) {
            exit("Livre déjà ajouté");
        }
        
    }

    public function afficher()
    {

        include './src/vues/formulaireLivre.php';
        
    }
 
    public function modifLivre()
    {

        include './src/vues/formulaireLivre.php';

        $entityManager = Em::getEntityManager();
        $metadataClass = new ClassMetadata("App\Entity\Livre");
        $livresRepo = new AbstractRepository($entityManager, $metadataClass); //respository= recuperer dans la bdd
        $aLivres = $livresRepo->findAll();
        
        foreach ($aLivres as $k => $livre) { //parcours un tableau
            $title = $livre->getTitre();
            $author = $livre->getAuteur();
            print("<p>" . $title .' '. "<span style='font-weight:bold'>" . $author ."</span>".' '. "<p/><br/>" );

        }
    }

    public function supprLivre()
    {

        
    }

}


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php foreach ($aLivres as $k => $livre) { //parcours un tableau
        $title = $livre->getTitre();
        $author = $livre->getAuteur();
        $id = $livre->getId();
        print("<p>" . $title . ' ' . "<span style='font-weight:bold'>" . $author . "</span>" . ' ' . "<p/>
        <a href='http://localhost/autoload/modifierLivre/$id'>Modifier</a>
        <a href='http://localhost/autoload/supprimerLivre/$id'>Supprimer</a>
        <br/>");
    }
    ?>
</body>

</html>
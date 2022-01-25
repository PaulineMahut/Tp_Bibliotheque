<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire d'ajout</title>
</head>

<body>
    <div>
        <?php
        if (array_key_exists("error", $_SESSION)) {
            echo $_SESSION["error"]; //qd il y a une variable qui n'existe pas
            unset($_SESSION["error"]); //pour reinitialiser, sinon l'erreur s'affichera toujours même si il n'y a pas d'erreur
        }
        ?>
    </div>
    <form method="post">
        <label for="nom">Nom</label>
        <input 
        type="text" 
        name="nom" 
        placeholder="Nom" 
        id="Nom">

        <label for="prenom">Prénom</label>
        <input 
        type="text" 
        name="prenom" 
        placeholder="Prénom" 
        id="Prenom">

        <label for="piece_identite">Pièce d'identité</label>
        <input 
        type="int" 
        name="piece_identite" 
        placeholder="Piece d'identité" 
        id="piece_identite">

        <input type="submit" name="submit">
    </form>
</body>

</html>
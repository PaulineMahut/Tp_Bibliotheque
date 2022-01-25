<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier un visiteur</title>
</head>

<body>
    <div>
        <?php 
            if (array_key_exists("error", $_SESSION)) {
               echo $_SESSION["error"];
               unset($_SESSION["error"]);
            }
        ?>
    </div>
    <?php 
        $id = isset($_SESSION["visitorDatas"]["id"]) ? $_SESSION["visitorDatas"]["id"] : "";
    ?>
    <form method="POST" id="form_controller">
        <label for="nom">NOM: </label>
        <input 
            type="text" 
            name="nom" 
            id="nom"
            value="<?php
               echo isset($_SESSION["visitorDatas"]["nom"]) 
               ? $_SESSION["visitorDatas"]["nom"] 
               : "";
            ?>"
       />

        <label for="prenom">PRENOM: </label>
        <input 
            type="text" 
            name="prenom" 
            id="prenom"
            value="<?php
               echo isset($_SESSION["visitorDatas"]["prenom"]) ? $_SESSION["visitorDatas"]["prenom"] : "";
            ?>"
        />

        <label for="piece_identite">PIECE D'IDENTITE: </label>
        <input 
            type="number" 
            name="piece_identite" 
            id="piece_identite"
            value="<?php
               echo isset($_SESSION["visitorDatas"]["piece_identite"]) ? $_SESSION["visitorDatas"]["piece_identite"] : "";
            ?>"
        />

        <input type="submit" value="ENREGISTRER LES MODIFICATIONS">
    </form>
</body>

</html>

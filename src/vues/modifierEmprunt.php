<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <form method="POST" action=<?="/autoload/emprunt:$id"?>>

<label for="date">Date</label>
<input type="date" name="date" value="<?= $oEmprunt->getDate_emprunt()->format("Y-m-d") ?>" required>

<label for="adherent">Id_Adherent</label>
<input type="text" name="adherent" value="<?= $oEmprunt->getAdherent()->getId() ?>" required /> 

<label for="livre">Id_Livre</label>
<input type="text" name="livre" value="<?= $oEmprunt->getLivre()->getId()?>" required>

<input type="submit" value="modifier">

    </form>
    
</body>
</html>
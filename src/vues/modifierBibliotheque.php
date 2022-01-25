<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <form method="POST" action='<?= "/autoload/modifierBibliotheque/$sID" ?>'>
    <input name="Nom" type="text" required value="<?php echo $bibliotheque->getName() ?>">
    <label for="Nom">NOM</label>
    <input type="submit" name="Modify">

    </form>
</body>
</html>
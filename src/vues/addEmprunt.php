<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter Emprunt</title>
</head>
<body>

<form method="POST" action="/autoload/addEmprunt" >
    
    <label for="date">Date</label>
    <input type="date" name="date">
   
    <label for="adherent">Id_Membre</label>
    <input type="number" name="adherent">

    <label for="livre">Id_Livre</label>
    <input type="number" name="livre">

    <input type="submit" value="Ajouter">


</form>
    
</body>
</html>
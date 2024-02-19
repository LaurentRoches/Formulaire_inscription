<?php
if (isset($_GET['message'])){
    if ($_GET['message'] == "erreur1") {
        $manque = "il manque quelque chose";
    };
    if ($_GET['message'] == "erreur2") {
        $format_mail = "ce n'est pas le bon format e-mail";
    };
    if ($_GET['message'] == "erreur3") {
        $taille_mdp = "Le mot de passe doit faire 8 characters";
    };
    if ($_GET['message'] == "erreur4") {
        $mdp_different = "Les mot de passe doivent être identiques";
    };
    if ($_GET['message'] == "erreur5") {
        $enregistrement = "Une erreur est survenue pendant l'enregistrement";
    };
    if ($_GET['message'] == "succes") {
        $succes = "Enregistrement effectué!";
    };
}else {

};


?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Inscription Newsletter</title>
  <link rel="stylesheet" href="./style.css" >
  <script src="./script.js" defer></script>
</head>
<body>
  <form action="./src/traitement.php" method="post" onsubmit="return Validation()">
    <h1>Formulaire d'inscription à la Newsletter</h1>
    <label for="nom">Nom :</label>
    <input type="text" id="nom" name="nom" required>
    <label for="prenom">Prénom :</label>
    <input type="text" id="prenom" name="prenom" required>
    <label for="mail">Mail :</label>
    <input type="email" id="mail" name="mail" required>
    <?php if (isset($format_mail)){
        echo "<div class = 'message echec'>" .$format_mail ."</div>";
        } ?>
    <label for="password">Mot de passe :</label>
    <input type="password" id="password" name="password" required>
    <?php if (isset($taille_mdp)){
        echo "<div class = 'message echec'>" .$taille_mdp ."</div>";
        } ?>
    <label for="password2">Vérifier le Mot de passe :</label>
    <input type="password" id="password2" name="password2" required>
    <?php if (isset($mdp_different)){
        echo "<div class = 'message echec'>" .$mdp_different ."</div>";
        } ?>
    <input type="submit" name="submit" value="S'inscrire">
    <?php if (isset($manque)){
        echo "<div class = 'message echec'>" .$manque ."</div>";
        } ?>
    <?php if (isset($enregistrement)){
        echo "<div class = 'message echec'>" .$enregistrement ."</div>";
    } ?>
    <?php if (isset($succes)){
        echo "<div class = 'message succes'>" .$succes ."</div>";
        } ?>
  </form>
</body>
</html>
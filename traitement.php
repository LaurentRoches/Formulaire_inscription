<?php

if (!empty($_POST['nom']) & !empty($_POST['prenom']) & !empty($_POST['mail']) & !empty($_POST['password']) & !empty($_POST['password2'])  ) {
    //Securise les donnees fournies
    htmlspecialchars($_POST['nom'], ENT_QUOTES | ENT_SUBSTITUTE | ENT_HTML401);
    htmlspecialchars($_POST['prenom'], ENT_QUOTES | ENT_SUBSTITUTE | ENT_HTML401);
    //Verifie le format de l'email
    $verif_mail = filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL);
    if($verif_mail === FALSE){
        header('location: index.php?message=erreur2');
    }
    //securise l'adresse mail
    htmlspecialchars($_POST['mail'], ENT_QUOTES | ENT_SUBSTITUTE | ENT_HTML401);
    //verifier la taille du mdp
    if (strlen($_POST['password']) < 8 & strlen($_POST['password']) === strlen($_POST['password2'])) {
        header('location: index.php?message=erreur3');
    }

    //securise le mdp
    htmlspecialchars($_POST['password'], ENT_QUOTES | ENT_SUBSTITUTE | ENT_HTML401);
    htmlspecialchars($_POST['password2'], ENT_QUOTES | ENT_SUBSTITUTE | ENT_HTML401);
    // tout va bien
    header('location: index.php?message=succes');
} else {
    // ça va pas du tout :(
    header('location: index.php?message=erreur');
}



?>
<?php
require './config.php'; // autre otpion plus permissive = include;
require './classes/User.php';
require './classes/Database.php';

if (isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['mail']) && isset($_POST['password']) && isset($_POST['password2'])) {
    if (!empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['mail']) && !empty($_POST['password']) && !empty($_POST['password2'])) {
        //Securise les donnees fournies
        $nom = htmlspecialchars($_POST['nom'], ENT_QUOTES | ENT_SUBSTITUTE | ENT_HTML5);
        $prenom = htmlspecialchars($_POST['prenom'], ENT_QUOTES | ENT_SUBSTITUTE | ENT_HTML5);
        //Verifie le format de l'email
        $verif_mail = filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL);
        if($verif_mail === FALSE){
            header('location: /../index.php?message=erreur'.ERREUR_EMAIL);
            die;
        };
        //securise l'adresse mail
        $mail = htmlspecialchars($_POST['mail'], ENT_QUOTES | ENT_SUBSTITUTE | ENT_HTML5);
        //verifier la taille des mdp
        if (strlen($_POST['password']) < 8 ) {
            header('location: /../index.php?message=erreur'.ERREUR_TAILLE_MDP);
            die;
        };
        //mdp identique?
        if ($_POST['password'] != $_POST['password2']) {
            header('location: /../index.php?message=erreur'.ERREUR_MDP_IDENTIQUE);
            die;
        };
        //securise le mdp
        $mdp = password_hash($_POST['password'], PASSWORD_DEFAULT);
        // tout va bien
        header('location: /../index.php?message=succes');
        $user = new User ($nom, $prenom, $mail, $mdp);
        $Database = new Database;
        $Database -> saveUtilisateur ($user);
        if (($Database->saveUtilisateur ($user)) === TRUE){
            header('location: /../confirmation.php');
        }else{
            header('location: /../index.php?message=erreur'.ERREUR_ENREGISTREMENT);
        }
    };
} else {
    // ça va pas du tout :(
    header('location: /../index.php?message=erreur'.ERREUR_CHAMP_VIDE);
    die;
};




?>
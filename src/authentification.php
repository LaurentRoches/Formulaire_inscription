<?php
session_start();
require './classes/Database.php';
require './classes/User.php';

$Database = new Database();

if (isset($_POST['mail']) && isset($_POST['password']) && !empty($_POST['mail']) && !empty($_POST['password'])) {

    $mail = htmlspecialchars($_POST['mail']);
    $userAvecCeMail = $Database->getUserByMail($mail);

    if ($userAvecCeMail !== False){
        if (password_verify($_POST['password'],$userAvecCeMail->getMdp())){
            echo "Bravo vous êtes authentifié ! <br>"; // vers tableau de bord
        die;
        }else{
            header('location: ../connexion.php?erreur');
            die;
        }
    }else{
        header('location: ../connexion.php?erreur');
        die;
    }
}


?>
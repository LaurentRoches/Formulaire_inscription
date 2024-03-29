<?php

final class Database{

    private $_DB;

    public function __construct(){
        $this -> _DB = __DIR__ ."/../csv/utilisateurs.csv";
    }
    public function saveUtilisateur(User $user): bool {
        $fichier = fopen($this -> _DB, 'ab');
        $retour = fputcsv($fichier, $user->getObjectToArray());
        fclose($fichier);
        return $retour;
    }

    // une méthode getAllUtilisateurs
    //qui renvoie un tableau d'utilisateurs instanciés.
    public function getAllUtilisateurs(): array {
        $fichier = fopen($this -> _DB, 'r');
        $utilisateurs = [];
        while(($ligne = fgetcsv($fichier, 1000)) !== false){
            $utilisateurs[] = new User($ligne[0], $ligne[1], $ligne[2], $ligne[3], $ligne[4]);
        };
        fclose($fichier);
        return $utilisateurs;
    }
}
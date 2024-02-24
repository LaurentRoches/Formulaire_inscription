<?php

final class Database{

    private $_DB;

    public function __construct() {
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
    // recuperer par ID
    public function getUserById(int $id): User | bool {
        // chercher dans la base de donnees si l'id existe
        $fichier = fopen($this -> _DB, 'r');
        //2. lire chaque ligne: une boucle
        while(($user = fgetcsv($fichier, 1000)) !== false){
            //3. verifier si l'id donne corresponds a celui de la ligne
            if ((int) $user[4] === $id){
                //si oui instancier user
                $user = new User ($user[0], $user[1], $user[2], $user[3], $user[4]);
                break;
            }else{
                //sinon user = false
                $user = false;
            }
        }
        fclose($fichier);
        return $user;
    }
    // recuperer par mail
    public function getUserByMail(string $mail): User | bool {
        $fichier = fopen($this -> _DB, 'r');
        while(($user = fgetcsv($fichier, 1000)) !== false){
            if ($user[2] === $mail){
                $user = new User ($user[0], $user[1], $user[2], $user[3], $user[4]);
                break;
            }else{
                $user = false;
            }
        }
        fclose($fichier);
        return $user;
    }
}
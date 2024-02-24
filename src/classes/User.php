<?php
require './Database.php';

class User {
    private $_id;
    private $_nom;
    private $_prenom;
    private $_mail;
    private $_mdp;

    public function __construct(string $nom, string $prenom, string $mail, string $mdp, int|string $id = "à créer"){
        $this -> setNom($nom);
        $this -> setPrenom($prenom);
        $this -> setMail($mail);
        $this -> setMdp($mdp);
        $this -> setId($id);
    }

    public function getId(): int {
        return $this -> _id;
    }
    public function setId (string $id):void {
        if (is_string($id) && $id == "à créer"){
            // $this -> _id = $this -> aleaId();
            $this -> _id = $this -> suivantId();
        }else{
            $this -> _id = $id;
        }
    }
    // Pour le nom
    public function getNom(): string {
        return $this -> _nom;
    }
    public function setNom (string $nom):void {
        $this -> _nom = $nom;
    }
    // Pour le prenom
    public function getPrenom(): string {
        return $this -> _prenom;
    }
    public function setPrenom (string $prenom):void {
        $this -> _prenom = $prenom;
    }
    // Pour le mail
    public function getMail(): string {
        return $this -> _mail;
    }
    public function setMail (string $mail):void {
        $this -> _mail = $mail;
    }
    // Pour le mdp
    public function getMdp(): string {
        return $this -> _mdp;
    }
    public function setMdp (string $mdp):void {
        $this -> _mdp = $mdp;
    }
    //vérif mdp:
    public function password_verify(string $mdp) : bool {
        return password_verify($mdp, $this->getMdp());
    }
    // Génération aléatoire d'un ID:
    private function suivantId(): int {
        $Database = new Database();
        $utilisateurs = $Database->getAllUtilisateurs();

        $IDs = [];
        foreach ($utilisateurs as $utilisateurs){
            $IDs [] = $utilisateurs->getId();
        }
        $i = 1;
        $unique = false;
        while ($unique === false){
            if (in_array($i,$IDs)){
                $i ++;
            }else{
                $unique = True;
            }
        }
        return $i;
    }

    public function  getObjectToArray(): array {
        return [
            'nom' => $this -> getNom(),
            'prenom' => $this -> getPrenom(),
            'mail' => $this -> getMail(),
            'mdp' => $this -> getMdp(),
            'id' => $this -> getId(),
        ];
    }

}

?>

<?php
/*
//partie2
//2.1
class Voiture {
    public string $couleur;
    public int $vitesse;

    public function __construct(string $couleur = "Blanche", int $vitesse = 0) {
        $this->couleur = $couleur;
        $this->vitesse = $vitesse;
    }

    public function afficher(): void {
        echo "Couleur : {$this->couleur} | Vitesse : {$this->vitesse} km/h" . PHP_EOL;
    }
}
$v1 = new Voiture();            // Couleur : Blanche | Vitesse : 0 km/h
$v2 = new Voiture("Rouge", 50); // Couleur : Rouge | Vitesse : 50 km/h
$v1->afficher();
$v2->afficher();

//2.1.b
public function __construct(
    public string $couleur = "Blanche",
    public int $vitesse = 0
) {}*/

//2.2
class Personne {
    public string $nom;
    public string $prenom;
    public function __construct(string $nom = "", string $prenom = "") {
       $this->nom = $nom;
       $this->prenom = $prenom;

       if ($nom === "" && $prenom === "") {
          echo "Création " . __CLASS__ . PHP_EOL;
       } else {
          echo "Création " . __CLASS__ . ": " .$prenom. " ". $nom. PHP_EOL;
       }
    }
}

$p1 = new Personne();   // création "vide"
echo '<br>';
$p2 = new Personne("Hachimi", "Sara");     // création avec infos
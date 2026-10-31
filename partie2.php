
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
) {}

//2.2.b
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


//2.2.c
class Personne {
    public function __construct(
        public string $nom = "",
        public string $prenom = ""git rm -r --cached .
    ) {}

    public static function depuisTableau(array $data): self {
        return new self($data['nom'], $data['prenom']);
    }
}

$p = Personne::depuisTableau(['nom' => 'Hachimi', 'prenom' => 'Sara']);
echo $p->prenom . " " . $p->nom;   // Sara Hachimi*/

//2.3
class Voiture {
    public function __construct(public string $couleur) {
        echo "Voiture {$this->couleur} créée.<br>" . PHP_EOL;
    }

    public function __destruct() {
        echo "Voiture {$this->couleur} détruite.<br>" . PHP_EOL;
    }
}
//2.3.b
//$maVoiture = new Voiture("Blanche"); 
//unset($maVoiture); //appelle __destruct()  
//echo "Fin du script." . PHP_EOL;
//echo '<br>';
//2.3.c
$a = new Voiture("Rouge");
$b = new Voiture("Bleue");
echo "Fin du script." . PHP_EOL;
echo '<br>';




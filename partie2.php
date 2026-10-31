
<?php

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
        echo "Couleur : {$this->couleur} | Vitesse : {$this->vitesse} km/h. <br>" . PHP_EOL;
    }
}

echo "<h3>2.1</h3>";
$v1 = new Voiture();            // Couleur : Blanche | Vitesse : 0 km/h
$v2 = new Voiture("Rouge", 50); // Couleur : Rouge | Vitesse : 50 km/h
$v1->afficher();
$v2->afficher();

$v3 = new Voiture("Noire");      // 2.1.a : couleur = Noire, vitesse = 0
$v3->afficher();


//2.1.b
class VoiturePromo {
    public function __construct(
        public string $couleur = "Blanche",
        public int $vitesse = 0
    ) {}
}

//2.2 + 2.3.d : Personne 
class Personne {
    public string $nom;
    public string $prenom;
    public function __construct(string $nom = "", string $prenom = "") {
       $this->nom = $nom;
       $this->prenom = $prenom;

       if ($nom === "" && $prenom === "") {
          echo "Création " . __CLASS__ ."<br>". PHP_EOL;
       } else {
          echo "Création " . __CLASS__ . ": " .$prenom. " ". $nom. "<br>". PHP_EOL;
       }
    }

    //2.2.c
    public static function depuisTableau(array $data): self {
        return new self($data['nom'], $data['prenom']);
    }

    //2.3.d
     public function __destruct() {
        echo "Détruire " . __CLASS__ . "<br>";
    }
}

function testPersonne(): void {
    echo "<h3>2.2 et 2.3.d</h3>";
    $p1 = new Personne();                                   // création vide
    $p2 = new Personne("Hachimi", "Sara");                  // avec infos
    $p3 = Personne::depuisTableau(['nom' => 'Alami', 'prenom' => 'Youssef']);
    echo "Fin de la fonction<br>";
}
testPersonne();

//2.3
class VoitureD{
    public function __construct(public string $couleur) {
        echo "Voiture {$this->couleur} créée.<br>" . PHP_EOL;
    }

    public function __destruct() {
        echo "Voiture {$this->couleur} détruite.<br>" . PHP_EOL;
    }
}

function test23a(): void {
    echo "<h3>2.3.a (avec unset)</h3>";
    $maVoiture = new VoitureD("Blanche");
    unset($maVoiture);
    echo "Fin du script.<br>";
    }

function test23b(): void {
    echo "<h3>2.3.b (sans unset)</h3>";
    $maVoiture = new VoitureD("Blanche");
    echo "Fin du script.<br>";
}

test23a();
test23b();

echo "<h3>2.3.c</h3>";
$a = new VoitureD("Rouge");
$b = new VoitureD("Bleue");
echo "Fin du script." . PHP_EOL;
echo '<br>';




<?php
//6.1
class Animal {
    public function manger(): void {
        echo "Je mange.<br>";
    }
}

class Chien extends Animal {
    public function aboyer(): void {
        echo "Wouf !<br>";
    }
}

// 6.1.a
class Chat extends Animal {
    public function miauler(): void {
        echo "Miaou !<br>";
    }
}

echo "<h3>6.1</h3>";
$c = new Chien();
$c->manger();     // héritée d'Animal
$c->aboyer();     // propre à Chien

$chat = new Chat();
$chat->manger();
$chat->miauler();
// $c->miauler();  // 6.1.b : Error (méthode inexistante dans Chien)


//6.2
class PersonneSimple {
    public function __construct(protected string $nom) {}

    public function presentation(): string {
        return "Je suis " . $this->nom;
    }
}

class EtudiantSimple extends PersonneSimple {
    public function __construct(string $nom, private string $filiere) {
        parent::__construct($nom);   // appelle le constructeur du parent
    }

    public function presentation(): string {
        return parent::presentation() . ", étudiant en " . $this->filiere;
    }
}

echo "<h3>6.2</h3>";
$e = new EtudiantSimple("Ahmed", "Informatique");
echo $e->presentation() . "<br>";   // Je suis Ahmed, étudiant en Informatique

//6.3
class Base {
    final public function afficher(): void {
        echo "Méthode finale<br>";
    }
}

final class Outil {
    public const VERSION = "1.0";
}

class Produit {
    public function __construct(public readonly string $reference) {}
}

echo "<h3>6.3</h3>";
$base = new Base();
$base->afficher();
echo "Outil version : " . Outil::VERSION . "<br>";
$p = new Produit("REF-001");
echo $p->reference . "<br>";

// 6.3.a : testez UNE ligne à la fois (ce sont des Fatal errors)
// class Fille extends Base { public function afficher(): void {} }   // (1)
// class SousOutil extends Outil {}                                   // (2)
// $p->reference = "REF-002";                                         // (3)


//6.4
class Personne {
    public string $nom;
    public string $prenom;
    private string $dateNaissance;
    private string $villeNaissance;
    private string $cin;

    public function __construct(string $nom, string $prenom, string $dateNaissance,
                                string $villeNaissance, string $cin) {
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->dateNaissance = $dateNaissance;
        $this->villeNaissance = $villeNaissance;
        $this->cin = $cin;
    }

    protected function getAge(): int {   // protected : accessible aux classes filles
        return (new DateTime($this->dateNaissance))->diff(new DateTime())->y;
    }

    public function __toString(): string {
        return $this->prenom . " " . $this->nom . " (" . $this->getAge() . " ans)";
    }
}

class Etudiant extends Personne {
    private string $cne;

    public function __construct(string $nom, string $prenom, string $dateNaissance,
                                string $villeNaissance, string $cin, string $cne) {
        parent::__construct($nom, $prenom, $dateNaissance, $villeNaissance, $cin);
        $this->cne = $cne;
    }

    public function getCne(): string {
        return $this->cne;
    }

    public function __toString(): string {
        return parent::__toString() . " - CNE : " . $this->cne;
    }
}

echo "<h3>6.4</h3>";
$etudiants = [];
$etudiants[] = new Etudiant("Hachimi", "Sara", "2000-05-14", "Marrakech", "EE123456", "R130000001");
$etudiants[] = new Etudiant("Alami", "Youssef", "1999-11-02", "Casablanca", "BK234567", "R130000002");
$etudiants[] = new Etudiant("Bennani", "Imane", "2001-03-21", "Rabat", "AB345678", "R130000003");
$etudiants[] = new Etudiant("Tazi", "Omar", "2000-08-09", "Fès", "CD456789", "R130000004");
$etudiants[] = new Etudiant("Idrissi", "Khadija", "2002-01-30", "Agadir", "EF567890", "R130000005");

foreach ($etudiants as $e) {
    echo $e . "<br>";
}
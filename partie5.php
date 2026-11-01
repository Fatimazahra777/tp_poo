<?php
class Utilisateur {
    public string $nom;
    public int $age;
    private string $motDePasse;

    public function __construct(string $nom, int $age, string $motDePasse) {
        $this->nom = $nom;
        $this->age = $age;
        $this->motDePasse = $motDePasse;
    }

    /*
    // Choisit les données à sérialiser (sans le mot de passe)
    public function __serialize(): array {
        return [
            'nom' => $this->nom,
            'age' => $this->age,
        ];
    }

    // Reconstruit l'objet
    public function __unserialize(array $data): void {
        $this->nom = $data['nom'];
        $this->age = $data['age'];
        $this->motDePasse = "";   // réinitialisé
    }
    */
}

$u = new Utilisateur("Alice", 25, "secret123");

$serialise = serialize($u);
// str_replace pour rendre visibles les octets nuls dans le navigateur
echo "Sérialisé : " . str_replace("\0", "\\0", $serialise) . "<br>";

/*$restaure = unserialize($serialise);
echo "<pre>";
var_dump($restaure);
echo "</pre>";*/



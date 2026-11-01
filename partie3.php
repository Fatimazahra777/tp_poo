<?php
class Personne {
    private string $nom = "";
    private string $prenom = "";
    private string $dateNaissance = "";

    // Appelée par : $p->prop = valeur
    public function __set(string $name, mixed $value): void {
        if (!property_exists($this, $name)) {
            echo "Propriété $name inexistante<br>";
            return;
        }

        // 3.4 : validation du nom
        if ($name === 'nom') {
            if (!is_string($value) || strlen(trim($value)) < 2) {
                throw new InvalidArgumentException(
                    "Le nom ne doit pas être vide et doit contenir au moins 2 caractères"
                );
            }
        }

        $this->$name = $value;
    }

    // Appelée par : echo $p->prop
    public function __get(string $name): mixed {
        return property_exists($this, $name) ? $this->$name : null;
    }

    // Appelée par : isset($p->prop) / empty($p->prop)
    public function __isset(string $name): bool {
        return property_exists($this, $name) && $this->$name !== "";
    }

    // Appelée par : unset($p->prop)
    public function __unset(string $name): void {
        if (property_exists($this, $name)) {
            $this->$name = "";
        }
    }
}

// ----- Tests -----
echo "<h3>3.1</h3>";
$p = new Personne();
$p->nom = "Hachimi";                  // → __set
echo $p->nom . "<br>";                // → __get
var_dump(isset($p->nom));             // → __isset
echo "<br>";
unset($p->nom);                       // → __unset
var_dump(isset($p->nom));
echo "<br>";
$p->telephone = "0600000000";         // propriété inexistante

echo "<h3>3.4</h3>";
try {
    $p->nom = "A";                    // trop court
} catch (InvalidArgumentException $e) {
    echo "Erreur : " . $e->getMessage() . "<br>";
}
<?php
class PersonneT {
    public string $nom;
    public string $prenom;
    private string $dateNaissance;   // format "AAAA-MM-JJ"

    public function __construct(string $nom, string $prenom, string $dateNaissance) {
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->dateNaissance = $dateNaissance;
    }

    // getName() mssou7a (énoncé 4.1)

    private function getAge(): int {
        $naissance = new DateTime($this->dateNaissance);
        return $naissance->diff(new DateTime())->y;
    }

    public function __toString(): string {
       //return $this->prenom . " " . $this->nom . " (" . $this->getAge() . " ans)";
       return 25;   // ← entier
    }
}

$p = new PersonneT("Hachimi", "Sara", "2000-05-14");
echo $p . "<br>";    // Sara Hachimi (26 ans)
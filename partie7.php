<?php
class Compte {
    private float $montant;
    private float $interet;   // annuel, en %

    // Ordre cohérent avec l'énoncé : montant initial, puis intérêt
    public function __construct(float $montantInitial, float $interet) {
        $this->montant = $montantInitial;
        $this->interet = $interet;
    }

    // Montant après un an : montant × (1 + t/100)
    public function un_an(): void {
        $this->montant = $this->montant * (1 + $this->interet / 100);
    }

    public function get_montant(): float {
        return $this->montant;
    }
}

$c1 = new Compte(400, 10);     // 400 DH à 10 %
$c2 = new Compte(2500, 5);     // 2 500 DH à 5 %

for ($i = 1; $i <= 10; $i++) {
    $c1->un_an();
    $c2->un_an();
}

echo '<p>Compte 1 : ' . number_format($c1->get_montant(), 2, ',', ' ') . ' dirhams</p>';
echo '<p>Compte 2 : ' . number_format($c2->get_montant(), 2, ',', ' ') . ' dirhams</p>';
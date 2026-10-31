<?php
//partie 0

class Voiture{
    public $marque;
    public $couleur;

    public function setMarque($m){
        $this->marque=$m;
    }

    public function setCouleur($c){
         $this->couleur=$c;
    }

    public function afficher(){
        echo "Marque: ".$this->marque." | Couleur: ".$this->couleur.PHP_EOL;
    }
}

$v1=new Voiture();
$v1->SetMarque("Toyota");
$v1->setCouleur("Bleu");
$v1->afficher();

echo '<br>';

$v2=new Voiture();
$v2->SetMarque("Renault");
$v2->SetCouleur("Rourge");
$v2->afficher();





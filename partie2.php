<?php
class Voiture {
    public string $couleur;
    public int $vitesse;

    public function __construct(string $couleur = "Blanche" , int $vitesse = 0) {
        $this->couleur = $couleur;
        $this->vitesse = $vitesse;
    }
    public function afficher() : void {
        echo "Couleur : {$this->couleur} | Vitesse : {$this->vitesse} km/h" . PHP_EOL;
    }
}

$v1 = new Voiture();
$v2 = new Voiture("Rouge" , 50);
$v1->afficher();
$v2->afficher();

$v3 = new Voiture("Noire");
$v3->afficher();
$v4 = new Voiture(120);
$v4->afficher();

class VoiturePromo {
    public function __construct(
        public string $couleur = "Blanche", 
        public int $vitesse = 0
    ) {}
}
$v5 = new VoiturePromo("Verte" , 80);
echo $v5->couleur . " " . $v5->vitesse . PHP_EOL;

class Personne {
    public function __construct(public string $nom = "", public string $prenom = "") {
        echo "Creation " .__CLASS__ . PHP_EOL;
    }

    public static function depuisTableau(array $data): Personne {
        return new Personne ($data['nom'], $data['prenom']);
    }

    public function __destruct() {
        echo "Detruire " . __CLASS__ . PHP_EOL;
    }
}

$vide = new Personne();
$sara = new Personne("Hachimi", "Sara");
$ali = Personne::depuisTableau(["nom" => "Alaoui", "prenom" => "Ali"]);
unset($vide, $sara, $ali);

class VoitureD {
    public function __construct(public string $couleur) {
        echo "Voiture {$this->couleur} creee." . PHP_EOL;
    }

    public function __destruct() {
        echo "Voiture {$this->couleur} detruite." . PHP_EOL;
    }
}

$maVoiture = new VoitureD("Blanche");
unset($maVoiture);
echo "Fin du script." .PHP_EOL;

$a = new VoitureD("Rouge");
$b = new VoitureD("Bleue");

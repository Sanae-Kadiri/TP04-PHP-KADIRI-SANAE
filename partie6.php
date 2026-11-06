<?php
class Animal {
    public function manger(): void {
        echo "Je mange." . PHP_EOL;
    }
}

class Chien extends Animal {
    public function aboyer (): void {
        echo "Wouf !" . PHP_EOL;
    }
}

class Chat extends Animal {
    public function miauler(): void {
        echo "Miaou !" . PHP_EOL;
    }
}

$c = new Chien();
$c->manger();
$c->aboyer();
$ch = new Chat();
$ch->miauler();

class PersonneSimple {
    public function __construct(protected string $nom){}

    public function presentation(): string {
        return "Je suis " . $this->nom;
    }
}

class EtudiantSimple extends PersonneSimple {
    public function __construct(string $nom, private string $filiere) {
        parent::__construct($nom);
    }

    public function presentation(): string{
        return parent::presentation() . ", étudiant en " . $this->filiere;
    }
}

$e = new EtudiantSimple("Ahmed", "Informatique");
echo $e->presentation() . PHP_EOL;

class Base {
    final public function afficher(): void {
        echo "Méthode finale"n . PHP_EOL;
    }
}

final class Outil {
    public const VERSION = "1.0"
}

class Produit {
    public function __construct(public readonly string $reference) {}
}

$p = new Produit("REF-001");
echo $p->reference . PHP_EOL;

class Personne {
    public function __construct(
        protected string $nom,
        protected string $prenom,
        private string $dateNaissance,
        private string $villeNaissance,
        private string $cin
    ) {}

    protected function getAge(): int {
        $naissance = new DateTime($this->dateNaissance);
        return $naissance->diff(new DateTime())->y;
    }

    public function __toString(): string {
        return $this->prenom . " " . $this->nom . " (" . $this->getAge() . " ans)";
    }

}

class Etudiant extends Personne {
    private string $cne;

    public function __construct(string $nom, string $prenom, string $dateNaissance, string $villeNaissance, string $cin, string $cne) {
        parent::__construct($nom, $prenom, $dateNaissance, $villeNaissance, $cin );
        $this->cne = $cne;
    }

    public function getCne(): string {
        return $this->cne;
    }

    public function __toString(): string {
        return parent::__toString() . " - CNE : " . $this->cne;

    }
}

$etudiants = [];
$etudiants[] = new Etudiant("Hachimi", "Sara", "2000-05-14", "Marrakech", "EE123456", "R130001");
$etudiants[] = new Etudiant("Alaoui", "Ali", "2001-02-03", "Casablanca", "AB234567", "R130002");
$etudiants[] = new Etudiant("Benani", "Nada", "1999-11-21", "Rabat", "CD345678", "R130003");
$etudiants[] = new Etudiant("Tazi", "Omar", "2002-07-30", "Fes", "EF456789", "R130004");
$etudiants[] = new Etudiant("Idrissi", "Hind", "2000-12-09", "Agadir", "GH5678990", "R130005");

foreach ($etudiants as $e) {
    echo $e . PHP_EOL;
}
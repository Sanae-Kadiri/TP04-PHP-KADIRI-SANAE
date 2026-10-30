<?php
class Personne {
    private string $nom = "";
    private string $prenom = "";
    private string $dateNaissance = "";

    public function _set(string $name, mixed $value): void {
        if (!property_exists($this, $name)) {
            echo "Propriete $name inexistante" . PHP_EOL;
            return;
        }
        if ($name == "nom" && strln($value) < 2) {
            throw new InvalideArgumentsExxception("Le nom doit contenir au moins 2 caracteres");
        }
        $this->$name = $value;
    }

    public function _get(string $name): mixed {
        if (property_exists($this,$name)) {
            return $this->$name;
        }
        return null;
    }

    public function _isset(string $name): bool {
        return property_exists($this, $name) && $this->$name !== "";
    }

    public function _unset(string $name): void {
        if (property_exists($this,$name)) {
            $this->$name = "";
        }
    }
}
$p = new Personne();
$p->nom = "Hachimi";
echo $p->nom . PHP_EOL;
var_dump(isset($p->nom));
unset($p->nom);
var_dump(isset($p->nom));
$p->telephone = "0600000000";

try {
    $p->nom = "A";
} catch (InvalidArgumentsException $e) {
    echo "Erreur : " . $e->getMessage() . PHP_EOL;
}
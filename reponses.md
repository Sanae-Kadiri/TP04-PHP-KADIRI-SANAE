Reponses TP 4 - POO en PHP 

KADIRI Sanae

## Partie 0 
- 0.3 Non. $v1 a "Toyota" et $v2 a "Renault". Chaque objet est une copie de la classe avec ses propres valeurs, $this désigne l'objet qui appelle la méthode.

## Partie 1 
- 1.1 `echo $p->cin;` donne "Cannot access private property Personne::$cin". `echo $p->dateNaissance;` donne la même erreur avec dateNaissance. `echo $p->getAge();` donne "Call to private method Personne::getAge() from global scope". Seuls getName() et nom marchent.
- 1.2 N'importe qui pourrait lire ou changer le CIN depuis l'extérieur, c'est une donnée personnelle sensible.
- 1.3 Non, elle sert à l'intérieur de la classe. Une autre méthode de la classe peut l'appeler avec $this->getAge() (comme __toString() en partie 4).
- 1.4 Non, depuis l'extérieur on a encore une erreur ("Cannot access protected property Personne::$cin"). Protected est accessible seulement dans la classe et ses classes filles.

## Partie 2 
- 2.1.a `new Voiture("Noire")` marche : vitesse prend la valeur par défaut 0. `new Voiture(120)` : 120 est un entier mais PHP le transforme en chaîne "120", donc la couleur devient "120" (sans erreur). Avec declare(strict_types=1) il y aurait un TypeError.
- 2.1.b L'avantage : le code est plus court, on n'écrit plus les attributs, les paramètres et les $this->x = $x séparément.
- 2.2.a Erreur : "Cannot redeclare Personne::__construct()". PHP n'accepte pas deux méthodes avec le même nom dans une classe (pas de surcharge).
- 2.2.b Un seul constructeur avec des valeurs par défaut : `__construct(string $nom = "", string $prenom = "")`. Sans arguments on a un objet vide, avec arguments un objet rempli.
- 2.2.c Une méthode statique de fabrique est une méthode static qui crée et retourne un objet, par exemple Personne::depuisTableau($data). Elle permet d'avoir plusieurs façons de créer un objet.
- 2.3.a Dans l'ordre : "Voiture Blanche créée.", "Voiture Blanche détruite.", "Fin du script."
- 2.3.b Sans unset : "créée", "Fin du script.", puis "détruite". L'objet est détruit à la fin du script.
- 2.3.c Bleue est détruite avant Rouge, donc dans l'ordre inverse de la création. L'ordre n'est pas garanti par PHP, on ne doit pas compter dessus.
- 2.3.d Fait dans partie2.php avec __destruct() et __CLASS__.

## Partie 3
- 3.1 Résultats : "Hachimi", true, false (après unset), et "Propriété telephone inexistante".
- 3.2 Sans __set : erreur "Cannot access private property Personne::$nom". Avec __set : PHP appelle __set et on décide quoi faire.
- 3.3 Oui, si __set accepte tout elle casse l'encapsulation (c'est comme si c'était public). Il faut valider la valeur dans __set (vérifier, puis lancer une exception).
- 3.4 Fait : si le nom a moins de 2 caractères (ou est vide), on lance InvalidArgumentException.

## Partie 4
- 4.1 Parce que __toString() est une méthode de la classe Personne : à l'intérieur de la classe on a le droit d'appeler les méthodes privées.
- 4.2 Avec le type `: string` et sans strict_types, PHP convertit 25 en "25" et ça marche. Avec declare(strict_types=1) : TypeError "Return value must be of type string, int returned".
- 4.3 __toString() est appelée automatiquement. C'est pratique avec echo (ou une concaténation avec un texte) et quand on affiche les objets d'un tableau avec foreach.

## Partie 5 
- 5.1 Le mot de passe n'apparaît pas : `O:11:"Utilisateur":2:{s:3:"nom";s:5:"Alice";s:3:"age";i:25;}`
- 5.2 Sans __serialize, la chaîne contient `s:9:"secret123"`, donc le mot de passe est écrit en clair. Risque : il peut être lu dans un fichier, une session ou un cookie.
- 5.3 Après unserialize, $motDePasse vaut "" (chaîne vide). Dans une vraie application, l'utilisateur doit se reconnecter, ou on ne stocke jamais le mot de passe (seulement un hash).
- 5.4 unserialize() sur des données venant de l'utilisateur est dangereux : il peut envoyer un objet fabriqué qui lance du code (PHP Object Injection, attaque avec des méthodes magiques comme __destruct ou __wakeup). Alternative : json_encode / json_decode, qui ne créent que des tableaux et des valeurs simples.

## Partie 6 
- 6.1.b Non, `$c->miauler()` donne une erreur : Chien hérite d'Animal, pas de Chat. miauler() existe seulement dans Chat.
- 6.2.a Sans parent::__construct($nom), $nom n'est jamais initialisé : erreur "Typed property ... must not be accessed before initialization". Le constructeur du parent n'est pas appelé automatiquement. (Dans mon code les classes s'appellent PersonneSimple et EtudiantSimple pour ne pas avoir deux classes Personne dans le même fichier.)
- 6.2.b Avec private, la classe fille ne pourrait pas utiliser $nom. Protected permet à Etudiant de l'utiliser.
- 6.3.a (1) "Cannot override final method Base::afficher()". (2) "Class SousOutil cannot extend final class Outil". (3) "Cannot modify readonly property Produit::$reference".
- 6.3.b readonly : un identifiant, une référence de produit ou la date de création (on ne doit pas les changer). final : une classe de sécurité (hash de mot de passe) ou une méthode qu'on ne veut pas changer dans les classes filles.
- 6.4.a Erreur : "Call to private method Personne::getAge() from scope Etudiant". Il faut mettre getAge() en protected (ou public).
- 6.4.b dateNaissance est private dans Personne, donc elle n'existe pas pour Etudiant (PHP affiche "Undefined property"). Etudiant est une Personne, mais private veut dire "seulement cette classe".
- 6.4.c On évite de répéter le code et si on change l'affichage dans Personne, Etudiant est mis à jour automatiquement.

## Partie 7 
- 7.1 Dans un_an() il manque l'opérateur : `$this->montant 1 * ...` (il faut un + entre $this->montant et 1). Erreur de syntaxe.
- 7.2 Montant après un an = montant × (1 + t/100). Exemple : 400 × 1,10 = 440.
- 7.3 Non, l'énoncé dit "montant initial puis intérêt" mais le constructeur prend ($interet, $montantInitial). Risque : si on écrit new Compte(400, 10) en suivant l'énoncé, on a un montant de 10 avec 400 % d'intérêt, sans aucune erreur.
- 7.4 Corrigé dans partie7.php. Résultats : compte 1 = 1 037,50 DH, compte 2 = 4 072,24 DH.

## Questions de synthese 
1. Une classe est un modèle (le plan), un objet est un exemplaire créé avec new à partir de ce modèle.
2. (a) Le code est mieux organisé. (b) On peut réutiliser le code avec l'héritage. (c) Les données sont protégées avec l'encapsulation (et le code est plus facile à maintenir).
3. Pour protéger les données : on les modifie seulement avec des méthodes qui vérifient les valeurs.
4. private : seulement la classe elle-même. protected : la classe et ses classes filles.
5. Oui, elles doivent être public. En PHP 8, une méthode magique qui n'est pas public donne un avertissement, sauf __construct et __destruct qui peuvent être private ou protected (par exemple dans un singleton).



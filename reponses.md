partie 0:
Quetion 3:
$v1 et $v2 nepartagent pas la meme valeur de cette $marque, car la 1ere voiture de marque Toyota et la 2eme de marque Renault.

partie 1:
Q1.1/
- ​dateNaissance est déclaré comme private dans la classe. Cela veut dire qu'il est strictement interdit d'y accéder de l'extérieur (en dehors des accolades de la classe Personne). 
- ​getAge() et cin est aussi déclaré comme private. Même chose : on ne peut pas l'appeler depuis le programme principal.

Q1.2/
Laisser cin en public est dangereux car il s'agit d'une donnée personnelle sensible. Cela permettrait à n'importe quel code externe de la modifier ou de la lire sans contrôle, violant ainsi le principe d'encapsulation et créant des failles de sécurité.

Q1.3/
Non, getAge() n'est pas inutile. Bien qu'elle soit privée, elle peut être appelée à l'intérieur d'une autre méthode (publique) de la même classe pour effectuer des calculs internes (comme calculer l'âge) sans que le code externe n'y accède directement.

Q1.4/
Non, le comportement depuis l'extérieur ne change pas. Un attribut protected reste inaccessible directement depuis le programme principal (exactement comme private), il protège la donnée de la même manière à l'extérieur.

partie 2:
Q2.1.a
- new Voiture("Noire") : Fonctionne parfaitement. $couleur prend "Noire" et $vitesse prend sa valeur par défaut 0. 
- ​new Voiture(120) : Provoque un comportement de conversion de type (ou une TypeError si strict_types=1 est activé), car le premier argument attend une string et on lui passe un int.

Q2.1.b
public function __construct(
    public string $couleur = "Blanche",
    public int $vitesse = 0
) {}

- L'avantage est de réduire la verbosité du code : cela évite d'avoir à déclarer les propriétés en haut de la classe et de répéter les assignations ($this->x = $x;), car PHP s'en charge automatiquement à partir de PHP 8.

Q2.2.a
Fatal error: Cannot redeclare Personne::__construct().
​Car PHP ne supporte pas la surcharge de méthodes (plusieurs méthodes portant le même nom, comme __construct) dans une même classe. Une classe ne peut posséder qu'un seul constructeur.

Q2.2.b
Un seul constructeur avec des valeurs par défaut (string $nom = "", string $prenom = "") : new Personne() donne une création « vide » et new Personne("Hachimi", "Sara") une création avec informations.

Q2.2.c
- Une méthode statique de fabrique est une méthode static déclarée dans la classe qui crée et retourne une instance de cette classe. Elle joue le rôle d’un constructeur, mais avec un nom explicite qui décrit la manière de créer l’objet.

- Pourquoi on l’utilise ? PHP n’autorise qu’un seul constructeur par classe (pas de surcharge). Les méthodes de fabrique permettent d’avoir plusieurs façons de créer un objet (depuis un tableau, un JSON, un objet vide...).

Q2.3.a
Les message s'affichant:
Voiture Blanche créée.
Voiture Blanche détruite.
Fin du script.
- unset supprime la dernière référence, donc __destruct() est appelé immédiatement.

Q2.3.b
Sans unset(...):
Voiture Blanche créée.
Fin du script.
Voiture Blanche détruite.
- Sans unset, l’objet reste référencé jusqu’à la fin du script, donc la destruction passe en dernier.

Q2.3.c
- À la fin du script, les objets sont détruits dans l’ordre suivant : $b (Voiture Bleue) puis $a (Voiture Rouge), c’est-à-dire dans l’ordre inverse de leur création (dans mon test).
- Remarque : la documentation PHP ne garantit pas cet ordre, il peut varier selon la version ou l’environnement.

Q2.3.d
J’ai ajouté dans Personne :
public function __destruct() {
    echo "Détruire " . __CLASS__ . "<br>";
}

__CLASS__ est une constante magique qui retourne le nom de la classe (Personne). Le message « Détruire Personne » s’affiche quand l’objet est détruit (fin du script, fin de la fonction ou unset).

Q3.1
Les quatre méthodes sont complétées dans le code ci-dessus. Résultats : Hachimi, bool(true), bool(false), puis le message « Propriété telephone inexistante ».

- isset retourne true après l’affectation car nom vaut « Hachimi ».
- Après unset, __unset remet nom à "", donc __isset retourne false.
- telephone n’existe pas dans la classe : __set affiche un message et ne crée pas la propriété.

Q3.2
- Sans __set et avec nom privée : Fatal error: Cannot access private property Personne::$nom.
- Avec __set : PHP n’interdit plus l’accès, il appelle automatiquement __set("nom", "X"). L’affectation se fait alors depuis l’intérieur de la classe, où l’accès à une propriété privée est autorisé.

Q3.3
Oui, __set peut casser l’encapsulation si on écrit $this->$name = $value; sans aucun contrôle : n’importe qui peut alors tout modifier depuis l’extérieur, comme si les propriétés étaient publiques.
Solutions :

- valider la valeur dans __set, propriété par propriété (if / match) ;
- utiliser des setters dédiés (setNom()...) avec validation ;
- limiter les propriétés modifiables à une liste blanche.

Q3.4
if ($name === 'nom') {
    if (!is_string($value) || strlen(trim($value)) < 2) {
        throw new InvalidArgumentException("Le nom doit contenir au moins 2 caractères");
    }
}

Test : $p->nom = "A"; lance l’exception, attrapée par try/catch, qui affiche le message d’erreur.

Q4.1
Pourquoi getAge() (private) fonctionne ici ?

Parce que __toString() est une méthode de la même classe. Une méthode private n’est interdite qu’depuis l’extérieur de la classe ; à l’intérieur, on peut l’appeler avec $this->getAge(). C’est l’idée de l’encapsulation : le calcul de l’âge reste un détail interne, et seul le résultat est visible via echo $p.

Q4.2
public function __toString(): string {
    return 25;   // entier
}

En mode normal (sans strict_types) : PHP convertit l’entier en chaîne "25", ça marche et affiche 25.
Avec declare(strict_types=1); : TypeError: Return value must be of type string, int returned.
Si on retire le type : string et qu’on retourne un entier, PHP 8 le convertit aussi en chaîne (anciennement PHP 7 : Return value must be of type string).

Q4.3
Intérêt de __toString() par rapport à getName()

__toString() permet à l’objet d’être converti automatiquement en chaîne, sans appeler une méthode à la main.

Deux situations pratiques :
1. Affichage direct : echo $p; ou concaténation "Bonjour " . $p, ou dans une boucle foreach (comme à la partie 6.4 avec les étudiants).
2. Logs et messages d’erreur / exceptions : on peut mettre l’objet directement dans un message de log ou un implode() sans écrire ->getName() partout.

- Autres cas : templates HTML, comparaison avec des chaînes, in_array, etc.

Q5.1
Non, le mot de passe ne figure pas dans la chaîne sérialisée. Elle contient seulement nom et age : O:11:"Utilisateur":2:{s:3:"nom";s:5:"Alice";s:3:"age";i:25;}. C’est __serialize() qui choisit les données : motDePasse est volontairement exclu.

Q5.2
- Sans __serialize(), PHP sérialise toutes les propriétés, y compris les privées. La chaîne contient alors motDePasse avec la valeur secret123 en clair.

- Risque : si la chaîne est stockée dans un fichier, une session, un cookie ou une base de données, quiconque y accède peut lire le mot de passe (fuite de données sensibles).

Q5.3
Après unserialize, $motDePasse vaut "" (chaîne vide), car __unserialize() le réinitialise.

Dans une vraie application :
- on ne stocke jamais un mot de passe en clair dans un objet ou une session ;
- on ne conserve en base qu’un hash (password_hash()), vérifié avec password_verify() ;
- après restauration, on demande à l’utilisateur de s’authentifier à nouveau ou on recharge ses données depuis la base.

Q5.4
Sécurité : unserialize() et PHP Object Injection

Il ne faut jamais appeler unserialize() sur des données venant de l’utilisateur (cookie, formulaire, paramètre d’URL…). Un attaquant peut fabriquer une chaîne qui crée des objets de n’importe quelle classe de l’application. PHP exécute alors automatiquement leurs méthodes magiques (__wakeup, __unserialize, __destruct…), ce qui peut permettre des actions dangereuses : suppression de fichiers, injection SQL, voire exécution de code (attaque par « chaîne de gadgets »). C’est la vulnérabilité PHP Object Injection.

Alternatives :
- utiliser json_encode() / json_decode() pour échanger des données (JSON ne contient que des données, pas d’objets exécutables) ;
- si on doit absolument utiliser unserialize(), interdire la création d’objets : unserialize($data, ['allowed_classes' => false]) ;
- signer les données (HMAC) pour vérifier qu’elles n’ont pas été modifiées.

Q6.1.b
Non, $c->miauler() provoque Fatal error: Call to undefined method Chien::miauler(). La méthode miauler() est définie dans Chat, pas dans Chien ni dans Animal. Un objet n’hérite que des méthodes de ses classes parentes, pas de celles d’une classe « sœur ».

Q6.2.a
Si on supprime parent::__construct($nom), le constructeur du parent n’est jamais exécuté, donc $nom n’est pas initialisé. Lors de presentation(), on obtient : Typed property PersonneSimple::$nom must not be accessed before initialization. En PHP, le constructeur du parent n’est pas appelé automatiquement quand la classe fille définit son propre constructeur.

Q6.2.b
$nom est protected pour que la classe fille (Etudiant) puisse y accéder avec $this->nom (dans presentation(), par exemple). Avec private, seule Personne y aurait accès. Et avec public, on casserait l’encapsulation.

Q6.3.a – Les 3 erreurs
1. Fatal error: Cannot override final method Base::afficher()
2. Fatal error: Class SousOutil cannot extend final class Outil
3. Fatal error: Uncaught Error: Cannot modify readonly property Produit::$reference

Q6.3.b
readonly : un identifiant (id, reference), une date de création, l’ISBN d’un livre : des valeurs qui ne doivent plus changer après l’initialisation.
final : une méthode sensible (vérification de sécurité, calcul d’un paiement) qu’on ne veut pas voir redéfinie, ou une classe utilitaire/de configuration qu’on ne veut pas étendre.

Q6.4 – Code
Voir Personne et Etudiant dans le fichier ci-dessus.

Q6.4.a
Si getAge() est private dans Personne, l’appel $this->getAge() depuis Etudiant donne Call to private method Personne::getAge() from scope Etudiant. Il faut la déclarer protected (ou public) pour que ça fonctionne.

Q6.4.b
$this->dateNaissance est private dans Personne : seule Personne y a accès, même ses classes filles n’y accèdent pas. En lecture on obtient Warning: Undefined property: Etudiant::$dateNaissance, et en écriture PHP crée une propriété dynamique distincte (mauvaise pratique). Un Etudiant est une Personne, mais private limite l’accès à la classe qui déclare la propriété. Solution : protected ou un getter.

Q6.4.c
Réutiliser parent::__toString() évite de dupliquer le code (principe DRY). Si le format de Personne change, Etudiant en bénéficie automatiquement, et le code est plus court et plus facile à maintenir.

Q7.1
- Erreur de syntaxe:

Dans un_an(), l’expression $this->montant 1 * $this->interet / 100 n’a pas d’opérateur entre $this->montant et 1 (il manque un +). PHP lance une Parse error.

Q7.2
- Formule correcte:

Montant après un an avec un intérêt de t % :
montant × (1 + t / 100)

En PHP : $this->montant = $this->montant * (1 + $this->interet / 100);

Même avec le + ajouté, la formule de l’étudiant montant * (montant + 1 * interet / 100) est fausse : elle multiplie le montant par lui-même (montant × montant), donc le montant explose au lieu d’augmenter de t %.

Q7.3
- Ordre des paramètres:

Non, il n’est pas cohérent : l’énoncé dit « un montant initial et un intérêt », alors que le constructeur est ($interet, $montantInitial).

Risque : les deux paramètres sont des nombres, donc si on les inverse à l’appel, PHP ne signale aucune erreur. Par exemple new Compte(400, 10) avec l’ancien ordre créerait un compte de 10 DH à 400 % au lieu de 400 DH à 10 %. L’erreur est silencieuse et très difficile à détecter.

Q7.4
- Code corrigé:

Corrections apportées :

- ajout de l’opérateur manquant et formule correcte montant × (1 + t/100) ;
- ordre des paramètres : montant initial, puis intérêt ;
- types float sur les attributs et paramètres, types de retour void et float ;
- affichage avec number_format($montant, 2, ',', ' ').




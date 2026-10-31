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
L'avantage est de réduire la verbosité du code : cela évite d'avoir à déclarer les propriétés en haut de la classe et de répéter les assignations ($this->x = $x;), car PHP s'en charge automatiquement à partir de PHP 8.

Q2.2.a
À l'exécution, cela provoque une erreur fatale (Fatal Error). 
​Car PHP ne supporte pas la surcharge de méthodes (plusieurs méthodes portant le même nom, comme __construct) dans une même classe. Une classe ne peut posséder qu'un seul constructeur.

Q2.2.b
voir code partie2

Q2.2.c
- Une méthode statique de fabrique est une méthode static déclarée dans la classe qui crée et retourne une instance de cette classe. Elle joue le rôle d’un constructeur, mais avec un nom explicite qui décrit la manière de créer l’objet.

- Pourquoi on l’utilise ? PHP n’autorise qu’un seul constructeur par classe (pas de surcharge). Les méthodes de fabrique permettent d’avoir plusieurs façons de créer un objet (depuis un tableau, un JSON, un objet vide...).

Q2.3.a
Les message s'affichant:
Voiture Blanche créée.
Voiture Blanche détruite.
Fin du script.
- Explication : unset($maVoiture) supprime la dernière référence vers l’objet, donc PHP appelle __destruct() immédiatement, avant le echo "Fin du script.".

Q2.3.b
Sans unset(...):
Voiture Blanche créée.
Fin du script.
Voiture Blanche détruite.
- Explication : L’objet reste référencé par $maVoiture jusqu’à la fin du script. Le destructeur est appelé à la fin de l’exécution, donc le message « détruite » passe après « Fin du script. ».

Q2.3.c
- À la fin du script, les objets sont détruits dans l’ordre suivant : $b (Voiture Bleue) puis $a (Voiture Rouge), c’est-à-dire dans l’ordre inverse de leur création (dans mon test).
- Remarque : la documentation PHP ne garantit pas cet ordre, il peut varier selon la version ou l’environnement.
Modifications à effectuer avant utilisation.

Dans les fichiers connexion.php et creationDb.php à la racine du projet (notés => "A changer") :
- Le nom d'utilisateur permettant de se connecter à la base de données
- Le mot de passe permettant de se connecter à la base de données
- Le port de connexion (par défaut 3306) à la base de données (utilisant IIS et Wamp, j'ai dût changer le port mysql dans le php.ini de mon Wamp)

Lors du lancement de l'application, un bouton permettant de générer la base apparaitra et vous redirigera vers la page d'accueil.
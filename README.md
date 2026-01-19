Feuille de route : 

1. Création du squellette du site via le modèle MVC
2. Création de la bdd avec la table users
3. creation du fichier Manager.php
    - création de la classe en POO
    - création de la méthode dbConnect() avec protected pour rendre accessible par toute les classes
4. Création du fichier UserManager.php
    - création de emailExists($email)
    - création de registerUser($pseudo, $email, $password)
    - création de loginUser($email, $password)
5. Création du fichier controller.php
    - création de registerUserController
6. Création du Routeur: index.php
7. Création de registerView.php
8. Modification du controller pour vérifier si des données ont été envoyées
9. Création du fichier loginView.php
10. Création de base.php (template)
    - Modification dans tout les fichiers du dosssier View 
    - Modification du controller pour appeler les bonnes views
    - création de homeView pour la page d'accueil avec la template
11. Ajout de la function homeController().
12. Création des SESSION pour rester connecter
    - session_start(); dans le routeur (index.php) permet de démarrer la SESSION
    - Modification dans le controller pour activer les SESSION et créer une redirection
    - Modification de base.php pour gérer la SESSION avec une CONNEXION et une DECONNEXION
13. Création de logoutController(); puis ajout dans le router index.php
14. Création de errorView.php et de errorController(); pour gérer les messages d'erreur
15. Création de isConnect() pour pouvoir controler la connexion d'un user et lui laisser poster un commentaire
    - isConnect(); est ajouté au début de controller.php
16. Test de la fonction isConnect():
    - Creation de testProtectedView.php
    - Creation de testProtectedController();
    - Ajout au routeur index.php
    - Test réussi
17. Suprression des fichiers et fonction test de l'authentification 
18. Création des 4 destinations :
    - dans le dossier View
    - Ajout du controller 
    - Ajout du routeur
Feuille de route : 

1.Création du squellette du site via le modèle MVC
2.Création de la bdd avec la table users
3.creation du fichier Manager.php
    -création de la classe en POO
    -création de la méthode dbConnect() avec protected pour rendre accessible par toute les classes
4.Création du fichier UserManager.php
    -création de emailExists($email)
    -création de registerUser($pseudo, $email, $password)
    -création de loginUser($email, $password)
5.Création du fichier controller.php
    -création de registerUserController
<?php

    // Import des modèles nécessaire 
    require_once 'model/Manager.php';
    require_once 'model/UserManager.php';

    function registerUserController(){
        
        //Vérification si des données POST ont été envoyées
        if(!empty($_POST)){

            // Traiter l'INSCRIPTION : Récupère les données du formulaire
            $pseudo = $_POST['pseudo'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            //Créer un objet (ex: une AUDI) de UserManager(ex: VOITURE en général) en utilisant la variable $userManager
            $userManager = new UserManager();

            // Appel la méthode registerUser
            $result = $userManager->registerUser($pseudo, $email, $password);

            //Test le resultat
            if($result){
                echo "Inscription réussie ! Bievenue $pseudo !";
            } else {
                echo "Erreur : cet email est déjà utilisé.";
            }
        } else {

            // Afficher le formulaire d'inscription
            require 'view/registerView.php';
        }
    }

    function loginUserController(){

        //Vérification si des données POST ont été envoyées
        if(!empty($_POST)){

            // Traiter la CONNEXION : Récupère les données du formulaire
            $email = $_POST['email'];
            $password = $_POST['password'];

            $userManager = new UserManager();
            $user = $userManager->loginUser($email, $password);

            if($user) {
                echo "Connexion réussie ! Bienvenue ".$user['pseudo'] ." !";
            } else {
                echo " Erreur : email ou mot de passe inccorect.";
            }
        } else {

            // Afficher le formulaire 
            require 'view/loginView.php';
        }
    }
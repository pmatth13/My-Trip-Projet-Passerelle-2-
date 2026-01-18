<?php

    // Import des modèles nécessaire 
    require_once 'model/Manager.php';
    require_once 'model/UserManager.php';

    function registerUserController(){

        //Récupère les données du formulaire
        $pseudo = $_POST['pseudo'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        //Créer un objet (une AUDI) de UserManager(VOITURE en général) en utilisant la variable $userManager
        $userManager = new UserManager();

        // Appel la méthode registerUser
        $result = $userManager->registerUser($pseudo, $email, $password);

        //Test le resultat
        if($result){
            echo "Inscription réussie ! Bievenue $pseudo !";
        } else {
            echo "Erreur : cet email est déjà utilisé.";
        }
    }
<?php

    // Import des modèles nécessaire 
    require_once 'model/Manager.php';
    require_once 'model/UserManager.php';

    // Fonction pour vérifier la connexion
    function isConnected(){

        if(!isset($_SESSION['user_id'])){
            header('Location: index.php?action=login');
        }
    }

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

            $viewFile = 'view/registerView.php'; // la bonne View
            require 'view/base.php';             // Inclut base.php qui inclura $viewFile
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
                // Stocker les infos en SESSION
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['pseudo'] = $user['pseudo'];
                $_SESSION['email'] = $user['email'];

                // Redirection vers l'acceuil
                header('Location: index.php?action=home');
                exit;
            } else {
                echo " Erreur : email ou mot de passe inccorect.";
            }
        } else {

            $viewFile = 'view/loginView.php'; // la bonne View
            require 'view/base.php';          // Inclut base.php qui inclura $viewFile
        }
    }

    function logoutController(){

        //Détruire toutes les variables de la SESSION
        session_unset();
        //Détruire la session
        session_destroy();
        //Rediriger vers l'accueil
        header('Location: index.php');
        exit;
    }

    function homeController(){

        $viewFile = 'view/homeView.php';
        require 'view/base.php';
    }

    function errorController(){

        $viewFile = 'view/errorView.php';
        require 'view/base.php';
    }

    function philippinesController(){

        $viewFile = 'view/philippinesView.php';
        require 'view/base.php';
    }
    
    function vietnamController(){

        $viewFile = 'view/vietnamView.php';
        require 'view/base.php';
    }

    function japanController(){

        $viewFile = 'view/japanView.php';
        require 'view/base.php';
    }

    function indonesiaController(){

        $viewFile = 'view/indonesiaView.php';
        require 'view/base.php';
    }


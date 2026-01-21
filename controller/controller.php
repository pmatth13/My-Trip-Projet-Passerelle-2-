<?php

    // Import des modèles nécessaire 
    require_once 'model/Manager.php';
    require_once 'model/UserManager.php';
    require_once 'model/ArticleManager.php';

    // Fonction pour vérifier la connexion
    function isConnected(){

        if(!isset($_SESSION['user_id'])){
            header('Location: index.php?action=login');
            exit;
        }
    }

    // Fonction pour vérifier si l'user est l'admin
    function isAdmin(){

        //Verifier si l'user est connecté
        isConnected();

        //Verifier si l'user est id=1 (=admin)
        if($_SESSION['user_id'] !== 1){

            // Pas admin on redirige à l'accueil
            header('Location: index.php');
            exit;
        }
    }

    /* -----------------------------------------------AUTHENTIFICATION--------------------------------------------------- */

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

/* ----------------------------------------------------------Liste des pages--------------------------------------------------- */

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

/* --------------------------------------------------------Création d'article de blog----------------------------------------------------- */

    function createArticleController(){

        // Vérification que c'est l'admin
        isAdmin();

        // Vérification de l'envoi des données POST
        if (!empty($_POST)){

            // Si true alors: on récupère les infos
            $title = $_POST['title'];
            $content = $_POST['content'];
            $destination = $_POST['destination'];
            $author_id = $_SESSION['user_id']; // Admin connecté

            // Création de l'article
            $articleManager = new ArticleManager();
            $articleManager->createArticle($title, $content, $destination, $author_id);

            // Rediriger vers l'accueil
            header('Location: index.php');
            exit;

        } else {

            // Si False alors:
            $viewFile= 'view/createArticleView.php';
            require 'view/base.php';
        }
    }

    function articlesListController(){

        // Récupère tout les articles
        $articleManager = new ArticleManager();
        $articles = $articleManager->getAllArticles(); //$articles est accessible dans la vue de articlesListView.php

        // Afficher la vue
        $viewFile = 'view/articleListView.php';
        require 'view/base.php';
    }




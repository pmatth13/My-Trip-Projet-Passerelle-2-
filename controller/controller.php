<?php

    // Import des modèles nécessaire
    require_once 'model/Manager.php';
    require_once 'model/UserManager.php';
    require_once 'model/ArticleManager.php';
    require_once 'model/CommentManager.php';

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

    // Fonction pour uploader l'image de couverture d'un article
    function uploadCoverImage($file){

        $uploadDir = 'public/uploads/';

        // Creer le dossier s'il n'existe pas
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true);
        }

        // Extensions autorisees
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        $fileExtension = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));

        if (!in_array($fileExtension, $allowedExtensions)) {
            return null;
        }

        // Verifier le type MIME
        $allowedMimes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
        $finfo = finfo_open(FILEINFO_MIME_TYPE);
        $mimeType = finfo_file($finfo, $file['tmp_name']);
        finfo_close($finfo);

        if (!in_array($mimeType, $allowedMimes)) {
            return null;
        }

        // Taille max: 5 Mo
        $maxSize = 5 * 1024 * 1024;
        if ($file['size'] > $maxSize) {
            return null;
        }

        // Generer un nom unique
        $newFileName = uniqid('cover_', true) . '.' . $fileExtension;
        $destination = $uploadDir . $newFileName;

        // Deplacer le fichier
        if (move_uploaded_file($file['tmp_name'], $destination)) {
            return '/my_trip/' . $destination;
        }

        return null;
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

        // Récupère les articles depuis la BDD
        $articleManager = new ArticleManager();
        $articles = $articleManager->getAllArticles();

        //Afficher la vue
        $viewFile = 'view/homeView.php';
        require 'view/base.php';
    }

    function errorController(){

        $viewFile = 'view/errorView.php';
        require 'view/base.php';
    }

    function philippinesController(){

        // Récupérer les articles de cette destination
        $articleManager = new ArticleManager();
        $allArticles = $articleManager->getAllArticles();

        // Filtrer les articles pour "Philippines
        $articles=[];
        foreach($allArticles as $article){
            if ($article['destination'] === 'Philippines'){
                $articles[] = $article;
            }
        }

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

/* --------------------------------------------------------Création/Modification/Suprression d'article de blog----------------------------------------------------- */

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

            // Gestion de l'upload de l'image de couverture
            $image_url = null;
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $image_url = uploadCoverImage($_FILES['image']);
            }

            // Création de l'article
            $articleManager = new ArticleManager();
            $articleManager->createArticle($title, $content, $destination, $author_id, $image_url);

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

    function articleController(){

        // Récupère l'ID depuis l'URL
        if (isset($_GET['id']) && !empty($_GET['id'])){  //Verifie que l'ID existe et n'est pas vide (sécurité)
            $id = $_GET['id'];
    
        //Récupérer l'article
        $articleManager = new ArticleManager();
        $article = $articleManager->getArticleById($id);

        // Récupère les commentaires de l'article
        $commentManager = new CommentManager();
        $comments = $commentManager->getCommentsByArticle($id);

        //Afficher la vue
        $viewFile = 'view/articleView.php';
        require 'view/base.php';

        } else {

            // Pas d'ID dans l'URL -> Redirection vers la liste d'article
            header('Location: index.php?action=articles');
            exit;
        }
    }

    function editArticleController(){

        // Vérifier que c'est l'admin:
            isAdmin();

        // Récupérer l'ID depuis l'URL
        if (isset($_GET['id']) && !empty($_GET['id'])) {
            $id = $_GET['id'];

            // Vérifier que les données POST ont été envoyées
            if (!empty($_POST)) {

            // Scénario 2 : Traiter l'update
            $title = $_POST['title'];
            $content = $_POST['content'];
            $destination = $_POST['destination'];

            // Gestion de l'upload de l'image de couverture
            $image_url = null;
            if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                $image_url = uploadCoverImage($_FILES['image']);
            }

            // MAJ de l'article
            $articleManager = new ArticleManager();
            $articleManager->updateArticle($id, $title, $content, $destination, $image_url); // Modification de la BDD

            // Rediriger vers l'article modifié
            header('Location: index.php?action=article&id='.$id);
            exit;

            } else {

                // Scénario 1 : Afficher le formulaire pré-rempli
                $articleManager = new ArticleManager();
                $article = $articleManager->getArticleById($id);

                $viewFile = 'view/editArticleView.php';
                require 'view/base.php';
            }

        } else {

                // Pas d'ID -> Donc redirection vers la liste d'article
                header('Location: index.php?action=articles');
                exit;
        }

    }

    function deleteArticleController(){

        // Vérifier que c'est l'admin:
                isAdmin();

        //  Récupérer l'ID depuis l'URL
        if (isset($_GET['id']) && !empty($_GET['id'])) {
            $id = $_GET['id'];

            // Supprimer l'article
            $articleManager = new ArticleManager();
            $articleManager->deleteArticle($id); //Suppression de la BDD

            // Rediriger vers la liste d'article
            header('Location: index.php?action=articles');
            exit;
        
        } else {

        // Pas d'ID -> Redirection vers la liste d'article
        header('Location: index.php?action=articles');
            exit;
        }
    }

/* --------------------------------------------------------Gestion des commentaires----------------------------------------------------- */

    function addCommentController(){

        // Vérifier que l'utilisateur est connecté
        isConnected();

        // Vérifier que les données POST ont été envoyées
        if (!empty($_POST) && isset($_POST['content']) && isset($_POST['article_id'])) {

            $content = trim($_POST['content']);
            $article_id = $_POST['article_id'];
            $author_id = $_SESSION['user_id'];

            // Vérifier que le contenu n'est pas vide
            if (!empty($content)) {
                $commentManager = new CommentManager();
                $commentManager->createContent($content, $article_id, $author_id);
            }

            // Rediriger vers l'article
            header('Location: index.php?action=article&id=' . $article_id);
            exit;

        } else {
            // Pas de données -> Redirection vers la liste d'articles
            header('Location: index.php?action=articles');
            exit;
        }
    }

    function deleteCommentController(){

        // Vérifier que l'utilisateur est connecté
        isConnected();

        // Récupérer l'ID du commentaire et de l'article depuis l'URL
        if (isset($_GET['id']) && isset($_GET['article_id'])) {

            $comment_id = $_GET['id'];
            $article_id = $_GET['article_id'];
            $user_id = $_SESSION['user_id'];

            // Supprimer le commentaire
            $commentManager = new CommentManager();
            $commentManager->deleteComment($comment_id, $user_id);

            // Rediriger vers l'article
            header('Location: index.php?action=article&id=' . $article_id);
            exit;

        } else {
            // Pas d'ID -> Redirection vers la liste d'articles
            header('Location: index.php?action=articles');
            exit;
        }
    }

<?php 

    //Démarrage de la session
    session_start();

    // Inclusion du contrôleur
    require_once 'controller/controller.php';

    // Récupérer l'action depuis l'URL
    if (isset($_GET['action'])) {

        $action = $_GET['action'];

    } else {

        $action = 'home'; // Action par défaut
    }

    // Routing : appeler la bonne fonction selon l'action
    switch ($action) {
        
        case 'register':
            registerUserController();
            break;
        
        case 'login' :
            loginUserController();
            break;
        
        case 'home':
            homeController();
            break;
        
        case 'logout':
            logoutController();
            break;

        case 'test_protected':
            testProtectedController();
            break;

        default:
            errorController();
            break;
    }
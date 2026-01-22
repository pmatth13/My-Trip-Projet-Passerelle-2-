<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>My Trip | Blog de voyage</title>

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        
        <!-- CSS -->
        <link rel="stylesheet" href="/my_trip/public/design/scss/style.css">
    </head>
    <body>

        <!-- HEADER = NAVBAR BOOTSTRAP -->
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">

                <!-- Partie 1 : Brand et Logo -->
                 <a class="navbar-brand" href="index.php">
                    <img src="/my_trip/public/asset/my-trip-logo-transparent.png" alt="My trip" class="navbar-logo">
                </a>

                <!-- Partie 2 : BTN HAMBURGER (visible sur mobile) -->
                 <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" aria-expanded="false">
                    <span class="navbar-toggler-icon"></span>
                    <span class="navbar-toggler-icon"></span>
                    <span class="navbar-toggler-icon"></span>
                </button>

                <!-- Partie 3 : Menu de Navigation (caché sur mobile) -->
                 <div class="collapse navbar-collapse" id="navbarContent">
                    <ul class="navbar-nav mx-auto">
                        <li class="nav-item">
                            <a class="nav-link nav-btn nav-home" href="index.php">Accueil</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?action=philippines">Philippines</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?action=vietnam">Vietnam</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?action=japan">Japon</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?action=indonesia">Indonésie</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="index.php?action=articles">Journal de bord</a>
                        </li>
                    </ul>
                
                <!-- Partie 4 : Connexion / Deconnexion  -->
                <ul class="navbar-nav">
                    <?php if (isset($_SESSION['pseudo'])): ?>
                        <!-- Si l'utilisateur est connecté -->
                        <li class="nav-item">
                            <span class="navbar-text me-3">
                                 Bonjour <strong><?php echo htmlspecialchars($_SESSION['pseudo']); ?></strong>
                            </span>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link nav-btn" href="index.php?action=logout">Déconnexion</a>
                        </li>
                    <?php else: ?>
                        <!-- Si l'utilisateur n'est pas connecté -->
                        <li class="nav-item">
                            <a class="nav-link nav-btn" href="index.php?action=register">Inscription</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link nav-btn ms-2" href="index.php?action=login">Connexion</a>
                        </li>
                    <?php endif; ?>
                </ul>
                 </div> 
            </div>
        </nav>

        <!-- CONTENU -->
        <main>
            <?php require $viewFile; ?>
        </main>

        <!-- FOOTER -->
        <footer class="footer mt-auto py-4 text-white">
            <div class="container">
                <div class="row">
                    <div class="col-12 text-center">
                        <p class="mb-2">
                            <a href="index.php?action=contact" class="text-muted text-decoration-none me-3">Contact</a>
                        </p>
                        <p class="text-muted m-0">
                            &copy; 2026 Mytrip - Pierre-Matthieu Saudella
                        </p>
                    </div>
                </div>
            </div>
        </div>
        </footer>

        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Trip | Blog de voyage</title>
    <link rel="stylesheet" href="public/design/style.css">
</head>
<body>
   
    <header>
        <h1>MyTrip | Les aventures de Joe et P-M</h1>
        <nav>
            <a href="index.php">Accueil</a>
            <a href="index.php?action=philippines">Philippines</a>
            <a href="index.php?action=vietnam">Vietnam</a>
            <a href="index.php?action=japan">Japon</a>
            <a href="index.php?action=indonesia">Indonésie</a>
    
        <?php if (isset($_SESSION['pseudo'])): ?>
            <span>Bonjour <?php echo $_SESSION['pseudo']; ?> !</span>
            <a href="index.php?action=logout">Déconnexion</a>
        <?php else: ?>
            <a href="index.php?action=register">Inscription</a>
            <a href="index.php?action=login">Connexion</a>
        <?php endif; ?>
        
        </nav>
    </header>

    <!-- Contenu variable -->
     <main>
        <?php require $viewFile; ?>
     </main>

     <footer>
        <p>&copy; 2026 My Trip - Pierre-Matthieu Saudella</p>
     </footer>

</body>
</html>
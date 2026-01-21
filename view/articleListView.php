<h2>Mes articles de voyage</h2>

<?php if (empty($articles)): ?>
    <p>Aucun article publié pour le moment.</p>
<?php else: ?>
    
    <?php foreach ($articles as $article): ?>
        <article>
            <h3><?php echo htmlspecialchars($article['title']); ?></h3>
            
            <p>
                <strong>Destination :</strong> <?php echo htmlspecialchars($article['destination']); ?><br>
                <strong>Publié le :</strong> <?php echo date('d/m/Y', strtotime($article['created_at'])); ?>
            </p>
            
            <p>
                <?php 
                    // Afficher les 200 premiers caractères du contenu
                    $excerpt = substr($article['content'], 0, 200);
                    echo htmlspecialchars($excerpt) . '...';
                ?>
            </p>
            
            <a href="index.php?action=article&id=<?php echo $article['id']; ?>">Lire la suite →</a>
            
            <hr>
        </article>
    <?php endforeach; ?>
    
<?php endif; ?>

<?php if (isset($_SESSION['user_id']) && $_SESSION['user_id'] === 1): ?>
    <p><a href="index.php?action=create_article">Créer un nouvel article</a></p>
<?php endif; ?>
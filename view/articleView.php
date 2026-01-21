<?php if (!$article): ?>
    <h2>Article non trouvé</h2>
    <p>Désolé, cet article n'existe pas ou a été supprimé.</p>
    <p><a href="index.php?action=articles">← Retour à la liste des articles</a></p>

<?php else: ?>
    
    <article>
        <h2><?php echo htmlspecialchars($article['title']); ?></h2>
        
        <p>
            <strong>Destination :</strong> <?php echo htmlspecialchars($article['destination']); ?><br>
            <strong>Publié le :</strong> <?php echo date('d/m/Y à H:i', strtotime($article['created_at'])); ?>
        </p>
        
        <hr>
        
        <div class="article-content">
            <?php 
                // Afficher le contenu complet avec retours à la ligne
                echo nl2br(htmlspecialchars($article['content'])); 
            ?>
        </div>
        
        <hr>
        
        <p><a href="index.php?action=articles">← Retour à la liste des articles</a></p>
        
        <?php if (isset($_SESSION['user_id']) && $_SESSION['user_id'] === 1): ?>
            <p>
                <a href="index.php?action=edit_article&id=<?php echo $article['id']; ?>"> Modifier cet article</a> | 
                <a href="index.php?action=delete_article&id=<?php echo $article['id']; ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet article ?')">Supprimer</a>
            </p>
        <?php endif; ?>
    </article>
    
<?php endif; ?>
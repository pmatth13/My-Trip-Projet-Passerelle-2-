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

        <?php if (isset($_SESSION['user_id']) && $_SESSION['user_id'] === 1): ?>
            <p>
                <a href="index.php?action=edit_article&id=<?php echo $article['id']; ?>">Modifier cet article</a> |
                <a href="index.php?action=delete_article&id=<?php echo $article['id']; ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet article ?')">Supprimer</a>
            </p>
        <?php endif; ?>

        <hr>

        <div class="article-content">
            <?php echo $article['content']; ?>
        </div>

        <hr>

        <p><a href="index.php?action=articles">← Retour à la liste des articles</a></p>

        <hr>

        <!-- Section Commentaires -->
        <h3>Commentaires (<?php echo count($comments); ?>)</h3>

        <?php if (empty($comments)): ?>
            <p>Aucun commentaire pour le moment. Soyez le premier à commenter !</p>
        <?php else: ?>
            <?php foreach ($comments as $comment): ?>
                <div class="comment">
                    <p>
                        <strong><?php echo htmlspecialchars($comment['pseudo']); ?></strong>
                        <small>- <?php echo date('d/m/Y à H:i', strtotime($comment['created_at'])); ?></small>
                    </p>
                    <p><?php echo htmlspecialchars($comment['content']); ?></p>

                    <?php if (isset($_SESSION['user_id']) && ($_SESSION['user_id'] === 1 || $_SESSION['user_id'] == $comment['author_id'])): ?>
                        <p>
                            <a href="index.php?action=delete_comment&id=<?php echo $comment['id']; ?>&article_id=<?php echo $article['id']; ?>" onclick="return confirm('Supprimer ce commentaire ?')">Supprimer</a>
                        </p>
                    <?php endif; ?>
                    <hr>
                </div>
            <?php endforeach; ?>
        <?php endif; ?>

        <!-- Formulaire d'ajout de commentaire -->
        <?php if (isset($_SESSION['user_id'])): ?>
            <h4>Ajouter un commentaire</h4>
            <form method="POST" action="index.php?action=add_comment">
                <input type="hidden" name="article_id" value="<?php echo $article['id']; ?>">
                <div>
                    <textarea name="content" rows="4" placeholder="Votre commentaire..." required></textarea>
                </div>
                <button type="submit">Publier le commentaire</button>
            </form>
        <?php else: ?>
            <p><a href="index.php?action=login">Connectez-vous</a> pour laisser un commentaire.</p>
        <?php endif; ?>

    </article>

<?php endif; ?>
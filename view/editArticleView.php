<?php if (!$article): ?>
    <h2>Article non trouvé</h2>
    <p>Désolé, cet article n'existe pas.</p>
    <p><a href="index.php?action=articles">← Retour à la liste des articles</a></p>

<?php else: ?>
    
    <h2>Modifier l'article</h2>

    <form method="POST" action="index.php?action=edit_article&id=<?php echo $article['id']; ?>">
        
        <div>
            <label for="title">Titre de l'article :</label>
            <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($article['title']); ?>" required>
        </div>
        
        <div>
            <label for="content">Contenu :</label>
            <textarea id="content" name="content"><?php echo htmlspecialchars($article['content']); ?></textarea>
        </div>
        
        <div>
            <label for="destination">Destination :</label>
            <select id="destination" name="destination">
                <option value="">-- Choisir une destination --</option>
                <option value="Philippines" <?php if ($article['destination'] === 'Philippines') echo 'selected'; ?>>🇵🇭 Philippines</option>
                <option value="Vietnam" <?php if ($article['destination'] === 'Vietnam') echo 'selected'; ?>>🇻🇳 Vietnam</option>
                <option value="Japon" <?php if ($article['destination'] === 'Japon') echo 'selected'; ?>>🇯🇵 Japon</option>
                <option value="Indonésie" <?php if ($article['destination'] === 'Indonésie') echo 'selected'; ?>>🇮🇩 Indonésie</option>
            </select>
        </div>
        
        <button type="submit">Mettre à jour</button>
        
    </form>

    <p><a href="index.php?action=article&id=<?php echo $article['id']; ?>">← Annuler et retourner à l'article</a></p>
    
<?php endif; ?>

<!-- Script TinyMCE -->
<script src="https://cdn.tiny.cloud/1/4y1zkz09jwd58nxeoj7pkq8wt3iiz4ku1n6fg78wmoj8rhu3/tinymce/7/tinymce.min.js" referrerpolicy="origin"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        tinymce.init({
            selector: '#content',
            height: 500,
            menubar: false,
            plugins: [
                'lists', 'link', 'image', 'charmap', 'preview',
                'searchreplace', 'code', 'fullscreen'
            ],
            toolbar: 'undo redo | formatselect | bold italic underline | alignleft aligncenter alignright | bullist numlist | link image | code preview',
            language: 'fr_FR'
        });
    });
</script>
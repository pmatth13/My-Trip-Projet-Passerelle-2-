<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">

<?php if (!$article): ?>
    <h2>Article non trouvé</h2>
    <p>Désolé, cet article n'existe pas.</p>
    <p><a href="index.php?action=articles">← Retour à la liste des articles</a></p>

<?php else: ?>

    <h2>Modifier l'article</h2>

    <form method="POST" action="index.php?action=edit_article&id=<?php echo $article['id']; ?>" enctype="multipart/form-data">

        <div>
            <label for="title">Titre de l'article :</label>
            <input type="text" id="title" name="title" value="<?php echo htmlspecialchars($article['title']); ?>" required>
        </div>

        <div>
            <label for="image">Image de couverture :</label>
            <?php if (!empty($article['image_url'])): ?>
                <p><img src="<?php echo htmlspecialchars($article['image_url']); ?>" alt="Image actuelle" style="max-width: 200px; max-height: 150px;"></p>
                <p><small>Image actuelle. Uploadez une nouvelle image pour la remplacer.</small></p>
            <?php endif; ?>
            <input type="file" id="image" name="image" accept="image/jpeg,image/png,image/gif,image/webp">
            <small>Formats acceptés : JPG, PNG, GIF, WEBP (max 5 Mo)</small>
        </div>

        <div>
            <label for="content">Contenu :</label>
            <textarea id="content" name="content"><?php echo htmlspecialchars($article['content']); ?></textarea>
        </div>

        <div>
            <label for="destination">Destination :</label>
            <select id="destination" name="destination">
                <option value="">-- Choisir une destination --</option>
                <option value="Philippines" <?php if ($article['destination'] === 'Philippines') echo 'selected'; ?>>Philippines</option>
                <option value="Vietnam" <?php if ($article['destination'] === 'Vietnam') echo 'selected'; ?>>Vietnam</option>
                <option value="Japon" <?php if ($article['destination'] === 'Japon') echo 'selected'; ?>>Japon</option>
                <option value="Indonésie" <?php if ($article['destination'] === 'Indonésie') echo 'selected'; ?>>Indonésie</option>
            </select>
        </div>

        <button type="submit">Mettre à jour</button>

    </form>

    <p><a href="index.php?action=article&id=<?php echo $article['id']; ?>">← Annuler et retourner à l'article</a></p>

<?php endif; ?>

        </div>
    </div>
</div>

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
            language: 'fr_FR',
            // Configuration upload images
            images_upload_url: '/my_trip/upload.php',
            automatic_uploads: true,
            images_reuse_filename: false,
            // Autoriser le glisser-deposer d'images
            paste_data_images: true
        });
    });
</script>

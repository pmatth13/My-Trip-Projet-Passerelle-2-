<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">

            <h2>Créer un nouvel article</h2>

            <form method="POST" action="index.php?action=create_article" enctype="multipart/form-data">

                <div>
                    <label for="title">Titre de l'article :</label>
                    <input type="text" id="title" name="title" required>
                </div>

                <div>
                    <label for="image">Image de couverture :</label>
                    <input type="file" id="image" name="image" accept="image/jpeg,image/png,image/gif,image/webp">
                    <small>Formats acceptés : JPG, PNG, GIF, WEBP (max 5 Mo)</small>
                </div>

                <div>
                    <label for="content">Contenu :</label>
                    <textarea id="content" name="content"></textarea>
                </div>

                <div>
                    <label for="destination">Destination :</label>
                    <select id="destination" name="destination">
                        <option value="">-- Choisir une destination --</option>
                        <option value="Philippines">Philippines</option>
                        <option value="Vietnam">Vietnam</option>
                        <option value="Japon">Japon</option>
                        <option value="Indonésie">Indonésie</option>
                    </select>
                </div>

                <button type="submit">Publier l'article</button>

            </form>

            <p><a href="index.php">← Retour à l'accueil</a></p>

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

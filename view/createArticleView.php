<h2> Créer un nouvel article</h2>

<form method="POST" action="index.php?action=create_article">
    
    <div>
        <label for="title">Titre de l'article :</label>
        <input type="text" id="title" name="title" required>
    </div>
    
    <div>
        <label for="content">Contenu :</label>
        <textarea id="content" name="content" rows="10" required></textarea>
    </div>
    
    <div>
        <label for="destination">Destination :</label>
        <select id="destination" name="destination">
            <option value="">-- Choisir une destination --</option>
            <option value="Philippines">🇵🇭 Philippines</option>
            <option value="Vietnam">🇻🇳 Vietnam</option>
            <option value="Japon">🇯🇵 Japon</option>
            <option value="Indonésie">🇮🇩 Indonésie</option>
        </select>
    </div>
    
    <button type="submit"> Publier l'article</button>
    
</form>

<p><a href="index.php">← Retour à l'accueil</a></p>
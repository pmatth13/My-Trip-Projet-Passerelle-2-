<!-- Présentation de moi -->
<section class="profile-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8 text-center">
                
                <!-- Photo de profil -->
                <div class="profile-image-container mb-4">
                    <img src="/my_trip/public/asset/photo_profil.jpeg" alt="Pierre-Matthieu" class="profile-image">
                </div>

                <!-- Titre -->
                <h1 class="mb-3">Bienvenue sur mon blog de voyage !</h1>

                <!-- Description -->
                <p class="lead text-muted mb-4">
                Partez à la découverte de mes aventures autour du monde, un fragment de moi-même à travers un site coloré qui respire le voyage.
                Aux côtés de ma fidèle compagne, explorer le monde est bien plus qu'une passion ! 
                N'hésitez pas à laisser un commentaire pour me donner votre avis, je serai ravi de vous lire. 
                </p>

            </div>
        </div>
    </div>
</section>

<!-- SECTION ARTICLES -->
<section class="articles-section py-5">
    <div class="container">
        <h2 class="text-center mb-5"><u>Derniers Articles de Voyage :</u></h2>
        
        <div class="row">
            
            <?php foreach ($articles as $article): ?>
            
                <!-- Card Article -->
                <div class="col-md-4 mb-4">
                    <div class="card h-100 article-card">
                       <img src="<?= !empty($article['image_url']) ? htmlspecialchars($article['image_url']) : '/my_trip/public/asset/default-cover.jpg' ?>"
                            class="card-img-top"
                            alt="<?= htmlspecialchars($article['title']) ?>">
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($article['title']) ?></h5>
                            <p class="card-text">
                                <p class="card-text">
                                    <?= htmlspecialchars(mb_strimwidth(html_entity_decode(strip_tags($article['content'])), 0, 100, '...')) ?> 
                                </p>
                            <p class="text-muted small">
                                 <?= htmlspecialchars($article['destination']) ?>
                            </p>
                        </div>
                        <div class="card-footer bg-transparent border-0">
                            <a href="index.php?action=article&id=<?= $article['id'] ?>" 
                               class="btn btn-primary w-100">Lire la suite</a>
                        </div>
                    </div>
                </div>
            
            <?php endforeach; ?>

        </div>
        
    </div>
</section>

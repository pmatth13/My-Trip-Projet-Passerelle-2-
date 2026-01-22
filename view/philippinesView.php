<!-- TITRE CENTRÉ -->
<section class="country-title py-5 text-center">
    <div class="container">
        <h1 class="display-3 fw-bold">Philippines</h1>
    </div>
</section>

<!-- GRANDE IMAGE HERO -->
<section class="country-hero">
    <div class="container">
        <img src="/my_trip/public/asset/photo_phillipines.png" alt="Philippines" class="img-fluid d-block mx-auto rounded hero-image">
    </div>
</section>

<!-- DESCRIPTION -->
<section class="country-description py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <p class="lead">
                J’ai passé un mois à voyager aux Philippines, entre mer et montagnes.<br>
                 Mon aventure a commencé par une croisière autour de Coron et d’El Nido, à Palawan, où j’ai découvert des lagons turquoise et des îlots sauvages.<br>
                 J’ai ensuite posé mes valises à Siargao, rythmée par le surf, la nature et une ambiance détendue. Pour finir, j’ai pris de la hauteur dans le nord du pays avec les rizières en terrasses de Banaue, un décor spectaculaire et hors du temps qui a parfaitement conclu ce voyage.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- VIDÉO -->
<section class="country-video py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h3 class="text-center mb-4">Découvrez en vidéo</h3>
                <div class="ratio ratio-16x9 video-frame">
                    <video controls>
                        <source src="/my_trip/public/asset/video_phillipines.MP4" type="video/mp4">
                        Votre navigateur ne supporte pas ce format vidéo.
                    </video>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- ARTICLES SUR CE PAYS -->
<section class="country-articles articles-section py-5">
    <div class="container">
        <h2 class="text-center mb-5">Mes Articles sur les Philippines</h2>
        
        <?php if (!empty($articles)): ?>
        
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
        
        <?php else: ?>
            <p class="text-center text-muted">Aucun article pour le moment sur cette destination.</p>
        <?php endif; ?>
        
    </div>
</section>
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">

            <h2>Inscription</h2>

            <form method="POST" action="index.php?action=register">

                <div>
                    <label for="pseudo">Pseudo :</label>
                    <input type="text" id="pseudo" name="pseudo" required>
                </div>

                <div>
                    <label for="email">Email :</label>
                    <input type="email" id="email" name="email" required>
                </div>

                <div>
                    <label for="password">Mot de passe :</label>
                    <input type="password" id="password" name="password" required>
                </div>

                <button type="submit">S'inscrire</button>

            </form>

            <p>Déjà un compte ? <a href="index.php?action=login">Se connecter</a></p>

        </div>
    </div>
</div>

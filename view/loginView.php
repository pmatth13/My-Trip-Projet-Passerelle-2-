<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">

            <h2>Connexion</h2>

            <form method="POST" action="index.php?action=login">

                <div>
                    <label for="email">Email :</label>
                    <input type="email" id="email" name="email" required>
                </div>

                <div>
                    <label for="password">Mot de passe :</label>
                    <input type="password" id="password" name="password" required>
                </div>

                <button type="submit">Se connecter</button>

            </form>

            <p>Pas encore de compte ? <a href="index.php?action=register">S'inscrire</a></p>

        </div>
    </div>
</div>

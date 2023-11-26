<nav>
    <div>
        <a href="/"><img src="image\logo.png" alt="Logo" style="width: 64px; height: 64px;"></a>
    </div>
    <div>
        <?php if (isset($_SESSION['user'])) : ?>
            <!-- Options pour les utilisateurs connectés -->
            <li><a href="profil">Page de profil</a></li>
            <li><a href="deconnexion">Deconnexion</a></li>
            <li><a href="/ajouterfacts">Ajouter un article</a></li>
            <li><a href="/mesfacts">Vos articles</a></li>
        <?php else : ?>
            <!-- Options pour les utilisateurs non connectés -->
            <li><a href="connexion">Connexion</a></li>
        <?php endif ?>
    </div>
</nav>

<form method="post" action="">
    <h1><?php if (isset($_SESSION["user"])) : ?>Page de modification du profil<?php else : ?>Page d'inscription<?php endif ?></h1>

    <fieldset>
        <legend><?php if (isset($_SESSION["user"])) : ?>Modifier le profil<?php else : ?>Inscription<?php endif ?></legend>
        
        <div>
            <label for="Nom">Nom</label>
            <input type="text" placeholder="Nom" id="Nom" name="nom" value="<?php if (isset($_SESSION["user"])) : ?><?= $_SESSION["user"]->userName ?><?php endif ?>">
            <?php if (isset($messageErreur["nom"])) : ?><small><?= $messageErreur["nom"] ?></small><?php endif ?>
        </div>
        
        <div>
            <label for="Prenom">Prénom</label>
            <input type="text" placeholder="Prénom" id="Prenom" name="Prenom" value="<?php if (isset($_SESSION["user"])) : ?><?= $_SESSION["user"]->userFname ?><?php endif ?>">
            <?php if (isset($messageErreur["Prenom"])) : ?><small><?= $messageErreur["Prenom"] ?></small><?php endif ?>
        </div>
        
        <div>
            <label for="Pseudo">Pseudo</label>
            <input type="text" placeholder="Pseudo" id="Pseudo" name="Pseudo" value="<?php if (isset($_SESSION["user"])) : ?><?= $_SESSION["user"]->userPseudo ?><?php endif ?>">
            <?php if (isset($messageErreur["Pseudo"])) : ?><small><?= $messageErreur["Pseudo"] ?></small><?php endif ?>
        </div>
        
        <div>
            <label for="Mail">Mail</label>
            <input type="email" placeholder="Mail" id="Mail" name="Mail" value="<?php if (isset($_SESSION["user"])) : ?><?= $_SESSION["user"]->userEmail ?><?php endif ?>">
            <?php if (isset($messageErreur["Mail"])) : ?><small><?= $messageErreur["Mail"] ?></small><?php endif ?>
        </div>
        
        <div>
            <label for="Password">Mot de passe</label>
            <input type="<?php if (isset($_SESSION["user"])) : ?>text <?php else : ?>password <?php endif ?>" placeholder="Password" id="Password" name="Password" value="<?php if (isset($_SESSION["user"])) : ?><?= $_SESSION["user"]->userPassword ?><?php endif ?>">
            <?php if (isset($messageErreur["Password"])) : ?><small><?= $messageErreur["Password"] ?></small><?php endif ?>
        </div>
        
        <div>
            <button name="btnEnvoi" value="lol">Envoyer</button>
        </div>
        
        <p style="margin-top: 15px;">Déjà un <a href="/connexion">compte</a> ?</p>
    </fieldset>
</form>
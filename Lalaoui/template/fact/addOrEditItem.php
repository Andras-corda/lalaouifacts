<form method="post"> 
    <h1 class="colorWhite">Page de création</h1>
    <div>
        <label for="factContent">Contenu du fact</label>
        <input type="text" placeholder="Contenu" id="factContent" name="factContent" value="<?php if (isset($factContent)) : ?><?= $factContent ?><?php endif ?>">
    </div>
    <button type="submit" name="btnEnvoi" value="lol">Créer</button>
</form>
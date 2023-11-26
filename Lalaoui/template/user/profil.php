<div>
  <div>
    <p><?= $_SESSION['user']->userPseudo ?></p>
    <p><?= $_SESSION['user']->userEmail ?></p>
    <p><?= $_SESSION['user']->userPassword ?></p>
    <div>
      <a href="/modify"><button>Modifier</button></a>
      <a href="/suppri"><button>Supprimer</button></a>
    </div>
  </div>
</div>

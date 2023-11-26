<?php
// Démarrer la session
session_start();

// Inclure le modèle utilisateur
require_once "model/userModel.php";

// Récupérer l'URI de la requête
$uri = $_SERVER['REQUEST_URI'];

// Gestion des routes
if ($uri === '/profil') {
    // Afficher le profil de l'utilisateur
    require_once "template/user/profil.php";
} elseif ($uri == "/inscription") {
    // Vérifier si la requête est de type POST
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Vérifier les champs vides
        $messageErreur = verifEmpty();
        if (!$messageErreur) {
            // Créer un nouvel utilisateur
            CreerUser($pdo);
            // Rediriger vers la page de connexion
            header("Location: /connexion");
            // Terminer le script après la redirection
            exit();
        }
    }
    // Afficher le formulaire d'inscription ou de modification
    require_once "template/user/inscriptionOrmodify.php";
} elseif ($uri === "/connexion") {
    // Vérifier si la requête est de type POST
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Tenter de connecter l'utilisateur
        connexionUser($pdo);
        // Rediriger vers la page d'accueil après connexion
        header("Location: /");
        // Terminer le script après la redirection
        exit();
    }
    // Afficher le formulaire de connexion
    require_once "template/user/connexion.php";
} elseif ($uri == "/deconnexion") {
    // Détruire la session et rediriger vers la page d'accueil
    session_destroy();
    header("Location: /");
    exit();
} elseif ($uri == "/modify") {
    // Vérifier si la requête est de type POST
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Vérifier les champs vides
        $messageErreur = verifEmpty();
        if (!$messageErreur) {
            // Modifier les informations de l'utilisateur
            modifierUser($pdo);
            // Rediriger vers la page de connexion
            header("Location: /connexion");
            // Terminer le script après la redirection
            exit();
        }
    }
    // Afficher le formulaire d'inscription ou de modification
    require_once "template/user/inscriptionOrmodify.php";
} elseif ($uri == "/suppri") {
    // Supprimer l'utilisateur et rediriger vers la page d'accueil
    supprimerUser($pdo);
    header("Location: /");
    exit();
}

// Fonction de vérification des champs vides
function verifempty()
{
    foreach ($_POST as $key => $value) {
        if (empty($value)) {
            $messageErreur[$key] = "Votre " . $key . " est vide";
        }
    }
    if (isset($messageErreur)) {
        return $messageErreur;
    } else {
        return false;
    }
}

<?php

//Créer un utilisateur
function CreerUser($pdo)
{
    try {
        // Validation des données
        $userSurname = htmlspecialchars($_POST['nom']);
        $userFirstName = htmlspecialchars($_POST['Prenom']);
        $userPseudo = htmlspecialchars($_POST['Pseudo']);
        $userEmail = filter_var($_POST['Mail'], FILTER_VALIDATE_EMAIL);
        $userPassword = password_hash($_POST['Password'], PASSWORD_DEFAULT);
        $userRole = 'user';

        $query = "INSERT INTO user (userSurname, userFirstName, userPseudo, userPassword, userEmail, userRole) VALUES (:userSurname, :userFirstName, :userPseudo, :userPassword, :userEmail, :userRole)";
        
        // Préparation de la requête
        $createUser = $pdo->prepare($query);
        
        // Exécution de la requête avec les valeurs fournies
        $createUser->execute([
            'userSurname' => $_POST['nom'],
            'userFirstName' => $_POST['Prenom'],
            'userPseudo' => $_POST['Pseudo'],
            'userPassword' => password_hash($_POST['Password'], PASSWORD_DEFAULT),
            'userEmail' => $_POST['Mail'],
            'userRole' => 'user'
        ]);
    } catch (PDOException $e) {
        // En cas d'erreur, affichage du message d'erreur
        $message = $e->getMessage();
        die($message);
    }
}

//Connecter un utilisateur
function connexionUser($pdo)
{
    try {
        $query = "SELECT * FROM user WHERE userPseudo = :userPseudo OR userEmail = :userEmail";
        $modifyUser = $pdo->prepare($query);
        $modifyUser->execute([
            'userPseudo' => $_POST['pseudo'],
            'userEmail' => $_POST['email'],
        ]);

        // Récupération de l'utilisateur
        $user = $modifyUser->fetch(PDO::FETCH_ASSOC);

        // Vérification du mot de passe
        if ($user && password_verify($_POST['password'], $user['userPassword'])) {
            // Mot de passe correct, enregistrement de l'utilisateur dans la session
            $_SESSION['user'] = (object) $user; // Convertir le tableau en objet
        } else {
            // Mot de passe incorrect ou utilisateur non trouvé
            echo "Identifiants incorrects. Veuillez réessayer.";
        }
    } catch (PDOException $e) {
        // En cas d'erreur, affichage du message d'erreur
        $message = $e->getMessage();
        die($message);
    }
}


//Modifier un utilisateur
function modifierUser($pdo)
{
    try {
        // Validation des données
        $userSurname = htmlspecialchars($_POST['nom']);
        $userFirstName = htmlspecialchars($_POST['Prenom']);
        $userPseudo = htmlspecialchars($_POST['Pseudo']);
        $userEmail = filter_var($_POST['Mail'], FILTER_VALIDATE_EMAIL);
        $userPassword = password_hash($_POST['Password'], PASSWORD_DEFAULT);

        // Requête SQL pour mettre à jour les informations de l'utilisateur
        $query = "UPDATE user SET userSurname = :userSurname, userFirstName = :userFirstName, userPseudo = :userPseudo, userPassword = :userPassword, userEmail = :userEmail WHERE user_id = :user_id";
        $ajouteUser = $pdo->prepare($query);
        
        // Exécution de la requête avec les valeurs fournies
        $ajouteUser->execute([
            'userSurname' => $userSurname,
            'userFirstName' => $userFirstName,
            'userPseudo' => $userPseudo,
            'userEmail' => $userEmail,
            'userPassword' => $userPassword,
            'user_id' => $_SESSION['user']->user_id
        ]);
    } catch (PDOException $e) {
        // En cas d'erreur, affichage du message d'erreur
        $message = $e->getMessage();
        die($message);
    }
}

//Supprimer un utilisateur
function supprimerUser($pdo)
{
    try {
        // Vérifier que l'utilisateur est connecté
        if (isset($_SESSION['user']) && isset($_SESSION['user']->user_id)) {
            // Requête SQL pour supprimer l'utilisateur
            $query = "DELETE FROM user WHERE user_id = :user_id";
            $supprimerUser = $pdo->prepare($query);

            // Exécution de la requête avec l'ID de l'utilisateur dans la session
            $supprimerUser->execute([
                'user_id' => $_SESSION['user']->user_id
            ]);

            //déconnecter l'utilisateur après la suppression
            unset($_SESSION['user']);
        } else {
            // Gérer le cas où l'utilisateur n'est pas connecté
            echo "L'utilisateur n'est pas connecté.";
        }
    } catch (PDOException $e) {
        // En cas d'erreur, affichage du message d'erreur
        $message = $e->getMessage();
        die($message);
    }
}

//Sélectionner les ustilisateurs
function selectionUsers($pdo){
    try {
        // Vérifier que l'utilisateur est connecté
        if (isset($_SESSION['user']) && isset($_SESSION['user']->user_id)) {
            // Requête SQL pour sélectionner tous les utilisateurs sauf l'utilisateur actuel
            $query = "SELECT * FROM user WHERE user_id != :user_id";
            $selectionUsers = $pdo->prepare($query);

            // Exécution de la requête avec l'ID de l'utilisateur dans la session
            $selectionUsers->execute([
                'user_id' => $_SESSION['user']->user_id
            ]);
            $allUsers = $selectionUsers->fetchAll();
            return $allUsers;
        } else {
            // Gérer le cas où l'utilisateur n'est pas connecté
            echo "L'utilisateur n'est pas connecté.";
            return null;
        }
    } catch (PDOException $e) {
        // En cas d'erreur, affichage du message d'erreur
        $message = $e->getMessage();
        die($message);
    }
}

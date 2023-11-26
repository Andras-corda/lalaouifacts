<?php

//Sélectionner tous les facts
function selectAllFacts($pdo)
{
    try {
        $query = "SELECT * FROM facts";
        $selectFactsStmt = $pdo->prepare($query);
        $selectFactsStmt->execute();
        $facts = $selectFactsStmt->fetchAll();
        return $facts;
    } catch (PDOException $e) {
        // En cas d'erreur, affichage du message d'erreur
        $message = $e->getMessage();
        die($message);
    }
}

//sélectionner les facts de l'utilisateur connecté
function selectUserFacts($pdo)
{
    try {
        // Assurez-vous que vous avez une session utilisateur active
        session_start();

        // Vérifiez si l'utilisateur est connecté
        if (isset($_SESSION['user']) && isset($_SESSION['user']->user_id)) {
            $user_id = $_SESSION['user']->user_id;
            
            // Requête SQL pour sélectionner les facts de l'utilisateur connecté
            $query = "SELECT * FROM facts WHERE user_id = :user_id";
            $selectUserFactsStmt = $pdo->prepare($query);
            $selectUserFactsStmt->execute(['user_id' => $user_id]);

            // Récupérez les facts de l'utilisateur connecté
            $userFacts = $selectUserFactsStmt->fetchAll();
            
            return $userFacts;
        } else {
            // L'utilisateur n'est pas connecté, vous pouvez rediriger vers une page de connexion par exemple
            header('Location: /connexion');
            exit();
        }
    } catch (PDOException $e) {
        // En cas d'erreur, affichage du message d'erreur
        $message = $e->getMessage();
        die($message);
    }
}

//Ajouter des facts
function ajouterFact($pdo)
{
    try {
        $query = "INSERT INTO facts (factContent, factCreatedAt, user_id) VALUES (:factContent, :factCreatedAt, :user_id)";
        $ajouterFactStmt = $pdo->prepare($query);

        // Obtention de la date et de l'heure actuelles au format Y-m-d H:i:s
        $factCreatedAt = date("Y-m-d H:i:s");
        $ajouterFactStmt->execute([
            'factContent' => $_POST['factContent'],
            'factCreatedAt' => $factCreatedAt,
            'user_id' => $_SESSION['user']->user_id
        ]);
    } catch (PDOException $e) {
        // En cas d'erreur, affichage du message d'erreur
        $message = $e->getMessage();
        die($message);
    }
}

function deleteAllItemUser($dbh)
{
    try {
        $query = 'delete from facts where user_id=:user_id';
        $deleteAll = $dbh->prepare($query);
        $deleteAll->execute([
            'user_id' => $_SESSION['user']->user_id
        ]);
    } catch (PDOException $e) {
        $message = $e->getmessage();
        die($message);
    }
}

//Supprimer un fact
function deleteFact($pdo)
{
    try {
        // Vérification si "fact_id" est défini dans la requête GET
        if (isset($_GET["fact_id"])) {
            $query = 'DELETE FROM facts WHERE fact_id = :fact_id';
            $deleteFactStmt = $pdo->prepare($query);
            $deleteFactStmt->execute([
                'fact_id' => $_GET["fact_id"]
            ]);
            //message de succès ou effectuer d'autres actions après la suppression
            //echo "Fact supprimé avec succès";
        } else {
            //Si "fact_id" n'est pas défini dans la requête GET
            //echo "L'identifiant du fact n'est pas spécifié";
        }
    } catch (PDOException $e) {
        // En cas d'erreur, affichage du message d'erreur
        $message = $e->getMessage();
        die($message);
    }
}

// Fonction pour modifier un fact
function modifierFact($pdo, $fact_id, $factContent)
{
    try {
        $query = "UPDATE facts SET factContent = :factContent WHERE fact_id = :fact_id";
        $modifierFact = $pdo->prepare($query);
        $modifierFact->execute([
            'factContent' => $factContent,
            'fact_id' => $fact_id,
        ]);
    } catch (PDOException $e) {
        $message = $e->getMessage();
        die($message);
    }
}

<?php
require_once("model/itemModel.php");

$uri = $_SERVER['REQUEST_URI'];

if ($uri === '/index.php' || $uri === '/') { 
    $facts = selectAllFacts($pdo);
    require_once "template/fact/seeAll.php";
} elseif ($uri === "/ajouterfacts") {
    require_once "template/fact/addOrEditItem.php";
    if (isset($_POST["btnEnvoi"])) {
        ajouterFact($pdo);
        header("Location: /mesfacts");
        exit();
    }
} elseif ($uri === "/deletefact") {
    if (isset($_GET["factId"])) { 
        deleteFact($pdo);
        header("Location: /mesfacts");
        exit();
    }
} elseif ($uri === "/mesfacts") {
    $userFacts = selectUserFacts($pdo);
    require_once "template/fact/mesfacts.php";
} elseif ($uri === "/modifyfact") {
    if (isset($_POST["btnModifier"])) {
        // récupérer les données du formulaire
        $fact_id = $_POST["fact_id"];
        $newFactContent = $_POST["newFactContent"];

        // appeler la fonction pour modifier le fact
        modifierFact($pdo, $fact_id, $newFactContent);

        // rediriger vers la page des facts après la modification
        header("Location: /mesfacts");
        exit();
    }
}
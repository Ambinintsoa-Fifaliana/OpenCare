<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

    require_once __DIR__ . "/database.php";
    require_once __DIR__ . "/session.php";
    require_once __DIR__ . "/auth.php";

    /*Données du personnels (consultation, traitement, pharmacie...), nécessaire pour les ordonnances, historiques etc*/
    $personnel_id = $_SESSION['user_id'];
    $sql = "SELECT * FROM personnels WHERE id = ?";
    $requete = $pdo->prepare($sql);
    $requete->execute([$personnel_id]);
    $data = $requete->fetch();
?>
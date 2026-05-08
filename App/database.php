<?php
    $db = "Hospital";
    $user = "fifa";
    $mdp = "fifa";
    $host = "127.0.0.1";

    try {
        $pdo = new PDO(
            "mysql:host={$host};dbname={$db};charset=utf8mb4",
            $user,
            $mdp,
            [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
            ]
        );
    }
    catch(PDOException $e){
        die ("Erreur lors de la connexion sur la base de donnée: " . $e->getMessage());
    }
?>
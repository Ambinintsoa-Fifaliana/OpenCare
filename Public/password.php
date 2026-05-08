<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

    require_once __DIR__ . "/../App/database.php";
    require_once __DIR__ . "/../App/session.php";

    if (!isset($_SESSION['user_id'])){
        header ("Location: login.php");
        exit;
    }
    $user_id = $_SESSION['user_id'];
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $mdp = $_POST['mdp'];
        $mdp1 = $_POST['check_mdp'];

        if ($mdp === $mdp1){
            $hash = password_hash($mdp, PASSWORD_DEFAULT);

            $sql = "UPDATE personnels SET mot_passe = ?, is_first_login = 0 WHERE id = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$hash, $user_id]);
            header("Location: dashboard.php");
        }
    }
?>
<!DOCTYPE HTML>
<html>
    <head>
        <title>Connexion</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="../Assets/CSS/style.css">
    </head>
    <body>
        <h3>Définir votre mot de passe</h3>
        <form action="" method="POST">
            <label>Mot de passe: </label>
            <input type="password" name="mdp" required><br>
            <label>Confirmer le mot de passe: </label>
            <input type="password" name="check_mdp" required><br>
            <button type="submit">Changer</button>
        </form>
    </body>
</html>
<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

    require_once __DIR__ . "/../App/database.php";
    require_once __DIR__ . "/../App/session.php";
    
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $email = trim($_POST['email']);
        $mdp = $_POST['mdp'];

        $sql = "SELECT * FROM personnels WHERE email = ?";
        $requete = $pdo->prepare($sql);
        $requete->execute([$email]);
        $user = $requete->fetch();

        if ($user && password_verify($mdp, $user['mot_passe'])){
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['user_email'] = $user['email'];

            if ($user['is_first_login'] == true){
                header ("Location: password.php");
                exit;
            }
            else {
                header ("Location: dashboard.php");
                exit;
            }
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
        <h3>Se connecter</h3>
        <form action="" method="POST">
            <label>Email: </label>
            <input type="email" name="email" required><br>
            <label>Mot de passe: </label>
            <input type="password" name="mdp" required><br>
            <button type="submit">Se connecter</button>
        </form>
    </body>
</html>
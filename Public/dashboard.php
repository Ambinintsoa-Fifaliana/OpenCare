<?php
    require_once __DIR__ . "/../App/session.php";
    require_once __DIR__ . "/../App/auth.php";
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../Assets/CSS/style.css">
</head>
<body>
    <header>
        <h2>Santé & Bien être</h2>
        <nav>
            <ul>
                <li><a href="#">Notification</a></li>
                <li><a href="#">Chambre</a></li>
                <li>
                    <select onchange = "location = this.value; ">
                        <option value="">Choisir consultation</option>
                        <option value="consultation.php?type=classique">Consultation classique</option>
                        <option value="consultation.php?type=grocesse">Suivi de grocesse</option>
                        <option value="consultation.php?type=pediatrie">Suivi pédiatrique</option>
                        <option value="consultation.php?type=hospitalisation">Hospitalisation</option>
                        <option value="consultation.php?type=visite">Visite médicale</option>
                    </select>
                </li>
                <li><a href="#">Personnel</a></li>
                <li><a href="#">Patient</a></li>
                <li><a href="#">Commande</a></li>
                <li><a href="logout.php">Se déconnecter</a></li>
            </ul>
        </nav>
    </header>
</body>
</html>

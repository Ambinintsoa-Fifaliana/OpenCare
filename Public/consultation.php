<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

    require_once __DIR__ . "/../App/database.php";
    require_once __DIR__ . "/../App/session.php";
    require_once __DIR__ . "/../App/auth.php";
    $type = $_GET['type'];
   
    //Collecte des données
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $nom = trim($_POST['patient_nom']);
        $prenom = trim($_POST['patient_prenom']);
        $sexe = $_POST['patient_sexe'];
        $age = $_POST['patient_age'];
        $diagnostic = $_POST['diagnostic'];
        $tension_arterielle = trim($_POST['tension']);
        $temperature = $_POST['temperature'] ?? '0';
        $antecedant_medicaux = $_POST['antecedants'] ?? '';
        $allergies = $_POST['allergies'] ?? '';
        $observation = trim($_POST['observartion']);

        /*Enregistrement des données du patient */
        $save_data = $pdo->prepare("INSERT INTO patients (nom, prenom, sexe, age, tension, allergies, temperature) VALUES (?,?,?,?,?,?,?)");
        $save_data->execute([$nom, $prenom,$sexe,$age,$tension, $allergies, $temperature]);
        /*Enregistrement des données du consultation */
        $save_data = $pdo->prepare("INSERT INTO consultations (diagnostic, observation, id_patient, id_personnel) VALUES (?,?,?,?)");
        $save_data->execute([$diagnostic, $observation,$id_patient, $_SESSION['user_id']]);
    }

?>
<!DOCTYPE HTML>
<html>
    <head>
        <title>Consultation</title>
        <meta charset="utf-8">
        <link rel="stylesheet" href="../Assets/CSS/style.css">
    </head>
    <body>
        <header>
            <h2>Menu</h2>
            <nav>
                <ul>
                    <li><a href="#">Ordonnance</a></li>
                    <li><a href="#">Contrôle</a></li>
                    <li><a href="#">Grocesse</a></li>
                    <li><a href="#">Hospitalisation</a></li>
                    <li><a href="#">Visite Médicale</a></li>
                </ul>
            </nav>
        </header>
        <main>
        <h3>Consultation Médicale</h3>
        <form action="" method="POST">
            <label>Nom: </label><br>
            <input type="text" name="patient_nom" required><br>
            <label>Prenom: </label><br>
            <input type="text" name="patient_prenom" required><br>
            <label>Sexe: </label><br>
            <input type="radio" name="patient_sexe" value="H" required>Masculin
            <input type="radio" name="patient_sexe" value="F" required>Feminin<br>
            <label>Age: </label><br>
            <input type="number" name="patient_age" required><br>
            <?php if ($type == "classique"){
                require_once __DIR__ . "/classique.php";
                }
                else if ($type == "hospitalisation"){
                    require_once __DIR__ . "/hospitalisation.php";
                }
                else if ($type == "visite"){
                    require_once __DIR__ . "/visite_medicale.php";
                }
            ?>
            <button type="submit">Enregistrer</button>
        </form>
        </main>
    </body>
</html>
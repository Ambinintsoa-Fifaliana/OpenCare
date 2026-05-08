<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

    require_once __DIR__ . "/../App/database.php";
    require_once __DIR__ . "/../App/session.php";
    require_once __DIR__ . "/../App/auth.php";
    

    $sql = "SELECT role_applicatifs.nom 
            FROM personnels JOIN role_applicatifs
            ON personnels.role_applicatif_id = role_applicatifs.id
            WHERE personnels.id = ?
        ";
    $requete = $pdo->prepare($sql);
    $requete->execute([$_SESSION['user_id']]);
    $user_role = $requete->fetch();
    if ($user_role['nom'] !== 'Administrateur'){
        header("Location: dashboard.php");
    }

    /*Chargement des données */
    $data_poste = $pdo->query("SELECT * FROM postes")->fetchAll();
    $data_specialite = $pdo->query("SELECT * FROM specialites")->fetchAll();
    $data_role_applicatif = $pdo->query("SELECT * FROM role_applicatifs")->fetchAll();
    $data_departement = $pdo->query("SELECT * FROM departements")->fetchAll();

    /*Collecte des données  utilisateur*/
    if ($_SERVER['REQUEST_METHOD'] == 'POST'){
        $nom = trim($_POST['nom']);
        $prenom = trim($_POST['prenom']);
        $email = trim($_POST['email']);
        $date = $_POST['date_naissance'];
        $sexe = $_POST['sexe'];
        $telephone = $_POST['telephone'];
        $adresse = trim($_POST['adresse']);
        $poste = $_POST['poste'];
        $specialite = $_POST['specialite'];
        $role_applicatif = $_POST['role'];
        $departement = $_POST['departement'];
        $temp_password = substr(bin2hex(random_bytes(4)),0,8);
        $hash_mdp = password_hash($temp_password, PASSWORD_DEFAULT);

        /*Vérification avant ajout */
        $stmt = $pdo->prepare("SELECT id FROM personnels WHERE email = ?");
        $stmt->execute([$email]);

        if ($stmt->rowCount() > 0) {
            echo "Email déjà utilisé";
            exit;
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "Email invalide";
            exit;
        }
        if (
            empty($nom) || 
            empty($prenom) || 
            empty($email) || 
            mb_strlen($nom, 'UTF-8') < 2 || 
            mb_strlen($prenom, 'UTF-8') < 2 || 
            mb_strlen($adresse, 'UTF-8') < 5
            ){
                echo "Informations invalide";
                exit;
            }

        if (!ctype_digit($telephone)) { // Vérifie si le telephone est bien du chiffre
            echo "Numéro invalide";
            exit;
        }
        $sql = "INSERT INTO personnels (nom, prenom, email, mot_passe, date_naissance, sexe, telephone, adresse, poste_id, role_applicatif_id, specialite_id, departement_id) VALUES (?,?,?,?,?,?,?,?,?,?,?,?)";
        $requete = $pdo->prepare($sql);
        $requete->execute([
            $nom, $prenom, $email, $hash_mdp, $date, $sexe, $telephone, $adresse, $poste, $role_applicatif, $specialite, $departement
        ]);

        $temp_js = json_encode($temp_password);

        echo "<script>
            alert('Compte créé avec succès ! Mot de passe temporaire : ' + $temp_js);
            window.location.href = window.location.href;
            </script>";
    }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Compte</title>
        <meta charset='utf-8'>
        <link rel="stylesheet" href="../Assets/CSS/style.css">
    </head>
    <body>
        <h3>Ajouter un utilisateur</h3>
        <form method="POST" action="">
            <label>Nom: </label>
                <input type="text" name="nom" required><br>
            <label>Prenom: </label>
                <input type="text" name="prenom" required><br>
            <label>Email: </label>
                <input type="email" name="email" required><br>
            <label>Date de Naissance: </label>
                <input type="date" name="date_naissance" required><br>
            <label>Sexe: </label>
                <input type="radio" name="sexe" value="M" required>Masculin
                <input type="radio" name="sexe" value="F" required>Féminin<br>
            <label>Telephone: </label>
                <input type="text" name="telephone" required><br>
            <label>Adresse: </label>
                <input type="text" name="adresse" required><br>
             <label>Poste: </label>
                <select name="poste">
                    <?php foreach ($data_poste as $pst): ?>
                        <option value="<?= $pst['id']; ?>">
                        <?= htmlspecialchars($pst['nom']); ?> 
                        </option>
                    <?php endforeach; ?>
                </select><br>
            <label>Specialite: </label>
                <select name="specialite">
                    <?php foreach ($data_specialite as $spec): ?>
                        <option value="<?= $spec['id']; ?>">
                        <?= htmlspecialchars($spec['nom_specialite']); ?>
                        </option>
                    <?php endforeach; ?>
                </select><br>
            <label>Role Applicatif: </label>
                <select name="role">
                    <?php foreach ($data_role_applicatif as $rl): ?>
                        <option value="<?= $rl['id']; ?>">
                        <?= htmlspecialchars($rl['nom']); ?>
                        </option>
                    <?php endforeach; ?>
                </select><br>
            <label>Departement: </label>
                <select name="departement">
                    <?php foreach ($data_departement as $dep): ?>
                        <option value="<?= $dep['id']; ?>">
                        <?= htmlspecialchars($dep['nom_departement']); ?>
                        </option>
                    <?php endforeach; ?>
                </select><br>
            <button type="submit">Envoyer</button> <button type="reset">Effacer tout</button>
        </form><br>
    </body>
</html>
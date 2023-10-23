<?php
session_start();
include('database.php');
$error = [];

if (isset($_POST['update'])) {
    $email = htmlspecialchars($_POST['email']);
    $password = md5(htmlspecialchars($_POST['password']));
    $password_con = md5(htmlspecialchars($_POST['password_con']));

    if (empty($email) || empty($password) || empty($password_con)) {
        $error[] = "Tous les champs sont obligatoires";
    } elseif (filter_var($email, FILTER_VALIDATE_EMAIL)) {

        if (strlen($password) >= 32 && $password == $password_con) { // MD5 produit une chaîne de 32 caractères
            $query = "SELECT * FROM users WHERE email = ?";
            $statement = $conn->prepare($query);
            $statement->execute(array($email));
            $total_row = $statement->rowCount();

            if ($total_row == 1) {
                $modif = "UPDATE users SET mot_de_passe = ? WHERE email = ?";
                $statement = $conn->prepare($modif);
                if ($statement->execute([$password, $email])) {
                    echo "Mot de passe mis à jour avec succès.";
                } else {
                    echo "Erreur lors de la mise à jour du mot de passe : " . $conn->error;
                }
            } else {
                echo "L'utilisateur avec cette adresse e-mail n'existe pas.";
            }
        } else {
            echo "Les mots de passe ne correspondent pas ou ne respectent pas les critères de sécurité.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
<div class="form">

<h2>Mettre à jour le mot de passe</h2>
<form action="" method="post">
   
    <div class="form-group">
        <label for="email">Adresse email:</label>
        <input type="email" id="email" name="email">
    </div>
    <div class="form-group">
        <label for="motDePasse">Nouveau mot de passe:</label>
        <input type="password" id="motDePasse" name="password">
    </div>
    <div class="form-group">
        <label for="motDePasse">Confirmer le mot de passe:</label>
        <input type="password" id="motDePasse" name="password_con">
    </div>
    <div class="form-group">
    <input type="submit" name="update" value="Mettre à jour">
 </div>
</div>

</form>
</body>
</html>

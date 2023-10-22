<?php
include('database.php');
session_start();
$tache=$_SESSION['tache'];

$idTache=$tache[0];

if(isset($_POST['supprimer'])){
    $sup="DELETE FROM taches WHERE id_tache=$idTache";
    $conn->query($sup);

    echo "Suppression reussi !";
    header('location:gestion_tache.php');
}

if(isset($_POST['marquer'])){
    $modif="UPDATE taches SET statut='Terminer' WHERE id_tache=$idTache";
    $conn->query($modif);

    echo "Modification reussi !";
    header('location:gestion_tache.php');
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- <link rel="stylesheet" href="style.css"> -->
    <link rel="stylesheet" href="style2.css">

    <style>
         input[type="submit"]{border: 0;
         height: 30px;
        }
      


    </style>
</head>
<body>
     <header>
        Details Taches: Preparation d'un rapport de vente <h6><i><?= $_SESSION['info'][1]?></i></h6>
     </header>
<?php
 
 if(isset($_POST['index'])){?>
   <div class="task">
            <form action="" method="post">
                            <h2><?= $tache['titre']; ?></h2>
                            <div class= 'info2'>
                            <div class='priorite'> <p>Priorité : <?= $tache['priorite']; ?></p> </div> <style> .priorite{ color: red; }</style>
                            <div class='statut'><p>Statut : <?= $tache['statut']; ?></p> </div> <style> .statut{  color: #4CAF50; }</style>
                            </div>

                            <p>Description :<?= $tache['description']; ?></p>
                            <div class="masq_supp">
                            <input type="submit" name="marquer" value="Marquer comme terminée" class='marquer'> 
                            <input type="submit" name="supprimer" value="supprimer la tache" class='supprimer'>
                            </div>
            </form>      
            <a href="gestion_tache.php" class="retour"> Retourner à la liste des tâche</a>
    </div>
              
                
 <?php
 }
?>
</body>
</html>
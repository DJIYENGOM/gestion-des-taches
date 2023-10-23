<?php
include('database.php');
  
session_start();   
if (!empty( $_SESSION['info'])){

    $id_user = $_SESSION['info'][0];

    $tasks = []; 
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ajouter'])) {
        $titre = $_POST['titre'];
        $priorite = $_POST['priorite'];
        $statut = $_POST['statut'];
        $description = $_POST['description'];
       
            $statement=$conn->prepare("INSERT INTO taches (id_user, titre, priorite, statut, description) VALUES (?, ?, ?, ?, ?)");
            $statement->execute(array($id_user, $titre, $priorite, $statut, $description));
            if ($statement) {
               
            } else {
            echo "Erreur lors de l'ajout de la tâche : " . $conn->error;
        }

      
    }
    
    $query = "SELECT * FROM taches WHERE id_user = ?";
    $sql = $conn->prepare($query);
    $sql->execute([$id_user]);
    $tasks = $sql->fetchAll();
   
 ?>
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <link rel="stylesheet" href="style.css">
                <link rel="stylesheet" href="style2.css">
                <title>Document</title>

            </head>
            <body>
            <header>
                 Gestion de mes Taches <h6><i><?= $_SESSION['info'][1]?></i></h6>
            </header>
            

            <div class="task-list">
            <?php foreach ($tasks as $key=>$tache) {   $_SESSION['tache']=$tache;    ?>
                <div class="task">
                     <form action="detail.php" method="post">
                         <h2><?= $tache['titre']; ?></h2>
                         <p>Description :<?= $tache['description']; ?></p>
                            <div class= 'info'>
                                   <div class='priorite'> <p>Priorité : <?= $tache['priorite']; ?></p> </div> <style> .priorite{ color: red; }</style>
                                    <div class='statut'><p>Statut : <?= $tache['statut']; ?></p> </div> <style> .statut{  color: #4CAF50; }</style>
                                    <div class="form-group">
                                        <input type="hidden" name="index" value="'.$key.'">
                                        <input type="submit" name="detail" value="voir les details">
                                    </div> 
                           </div> 
                     </form>
                </div>
                <div class='deconnecter'><a href="deconnecter.php">Deconnecter</a></div>

                <?php } ?>
          
                         
                                
                    <div class="form-container">
                        
                        <form action="" method="post" class="task-form">
                     
                            <legend><h3>Ajouter une nouvelle tache</h3></legend>
                            <div class="form-group">
                                <label for="titre">Titre de la tâche:</label>
                                <input type="text" id="titre" name="titre" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="priorite">Priorité:</label>
                                <select id="priorite" name="priorite">
                                    <option value="haute">Haute</option>
                                    <option value="moyenne">Moyenne</option>
                                    <option value="basse">Basse</option>
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label for="statut">Statut:</label>
                                <select id="statut" name="statut">
                                    <option value="en_cours">En cours</option>
                                    <option value="en_attente">En attente</option>
                                    <option value="termine">Terminé</option>
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label for="description">Description:</label>
                                <textarea id="description" name="description" rows="4" cols="50"></textarea>
                            </div>
                            
                            <div class="form-group">
                                <input type="submit" name='ajouter' value="Ajouter">
                            </div>
                            
                        </form>
                    </div>
                      
 <?php
}
else{
    header("Location: page1.php");
}
?>

 </body>
</html>
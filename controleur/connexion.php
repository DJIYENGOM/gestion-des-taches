<?php
    session_start();

include('../database.php');
if(isset($_POST['connexion'])){
   $email=trim($_POST['email']); 
   //trim permet de supprimer les espaces en debut et fin d'une chaine caractere
  
   $mdp=trim(md5($_POST['password']));
   $query="SELECT * FROM users WHERE email= ? AND mot_de_passe= ?"; // requete pour chercher les données de la base de donnée
  
   $statement=$conn->prepare($query); // preparation de la requete".$mdp."'
   $statement->execute(array($email,$mdp)); // execution de la requete
  
   $total_row=$statement->rowCount(); // conter le nombre de donné dans la base de donnée
   if($total_row==1){

   $_SESSION['info']=$statement->fetch();

      header("Location:../gestion_tache.php");
   }else{
       echo '<b> mot de passe </b> ou <b> Email </b> incorrecte';
   }
   }
?>
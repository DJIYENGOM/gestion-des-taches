<?php
include('../database.php');   
$error=[]; 

if(isset($_POST['inscription'])){
   $nom=htmlspecialchars($_POST['nom']);
   $email=htmlspecialchars($_POST['email']);
   $password=htmlspecialchars(md5($_POST['password']));
   $password_con=htmlspecialchars(md5($_POST['password_con']));

   if(empty($nom)||empty($email)||empty($password)||empty($password_con)){
    $error[]="tous les champs sont obligatoires";
   }elseif(!(preg_match("/[a-zA-Zéè]$/", $_POST["nom"]))  ){
     $error[]= 'nom incorrecte';
    }elseif (filter_var($email, FILTER_VALIDATE_EMAIL) ) {
   
                if (strlen($password) >= 5 && $password == $password_con) {

                           
                            $sql= ('INSERT INTO `users`(  `nom`, `email`, `mot_de_passe`) VALUES(?,?,?)');
                            $statement=$conn->prepare($sql);
                            $statement->execute(array($nom,$email,$password));
                            echo "compte creé" .'<br>';
                               

                        }
                    }else{
                        $error[]= 'Mots de passes minimun 5 caracteres et doivent correspondre';}
               
        
        }
      
     
echo implode(". ",$error);
?>

<?php
session_start();    
if (isset( $_SESSION['info'])){

    session_destroy();
echo 'vous etez bien déconnecté'."<br>";
header('Location:page1.php');
}
?>

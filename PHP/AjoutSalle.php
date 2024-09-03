<?php 

$bdd=new PDO('mysql:host=localhost;dbname=projet_web;charset=utf8', 'root','');

 $nm=$bdd->prepare("INSERT INTO salle (nom_salle) VALUES(:name_salle)");

 $donn = $nm->execute(array(
     'name_salle'=> $_POST['Ajout_salle']
 ));
 
 

 header('location:../LOGIN/admin_space.php');

 ?>
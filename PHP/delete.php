<?php 
$salle=$_POST['type_salle'];
$bdd = new PDO('mysql:host=localhost;dbname=projet_web;charset=utf8', 'root', '');
$hi=$bdd->prepare("DELETE FROM salle WHERE nom_salle= :salle ");

$donnee = $hi->execute(array(
    'salle' => $salle));
    header('location:../LOGIN/admin_space.php');
?>
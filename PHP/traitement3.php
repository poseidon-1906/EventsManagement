<?php 
session_name('formulaire');
session_start();


// echo $_SESSION['Intitule'];
// echo $_SESSION['Theme']; 
// echo $_SESSION['organisateur']; 
// echo $_SESSION['DATE_deb']; 
// echo $_SESSION['DATE_fin'];
// echo $_SESSION['comment'];
// echo $_SESSION['type_salle'];
$bdd = new PDO('mysql:host=localhost;dbname=projet_web;charset=utf8', 'root', '');

$hi=$bdd->prepare("SELECT id_salle FROM salle WHERE nom_salle= :salle ");

$donnee = $hi->execute(array(
    'salle' => $_SESSION['type_salle']));
    
    //echo $donnee;

    $rep=$bdd->prepare("INSERT INTO events 
    (intitulé,thème,id_org,date_db,date_fn,id_salle,commentaire) 
    VALUES (:intitule,:theme,:organisateur,:date_db,:date_fn,:salle,:commentaire)");

    $rep->execute(array(
    'intitule' => $_SESSION['Intitule'],
    'theme' => $_SESSION['Theme'],
    'organisateur'=> $_SESSION['organisateur'],
    'date_db' => $_SESSION['DATE_deb'],
    'date_fn'=>$_SESSION['DATE_fin'],
    'salle'=> $donnee,
    'commentaire'=>$_SESSION['comment'] 
     ));
    header('location:../LOGIN/admin_space.php');

//session_destroy();
?>
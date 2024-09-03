<?php 
$bdd = new PDO('mysql:host=localhost;dbname=projet_web;charset=utf8', 'root','');
$idd = $_GET['id'];
$rep=$bdd->query("SELECT * FROM events WHERE id_ev='".$idd."' ");
$donnee=$rep->fetch();
$rp=$bdd->prepare('INSERT INTO calendar 
            (intitulé,thème,id_org,date_db,date_fn,id_salle,commentaire) 
            VALUES (:intitule,:theme,:organisateur,:date_db,:date_fn,:salle,:commentaire)');

            $rp->execute(array(
            'intitule' => $donnee['intitulé'],
            'theme' => $donnee['thème'],
            'organisateur'=> $donnee['id_org'],
            'date_db' => $donnee['date_db'],
            'date_fn'=> $donnee['date_fn'],
            'salle'=> $donnee['id_salle'],
            'commentaire'=> $donnee['commentaire']
            
             ));
            $reqt = $bdd->prepare("DELETE FROM events");
            header('location:../LOGIN/admin_space.php');
        ?>
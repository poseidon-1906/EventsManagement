<?php
 $nom = $_GET['nom'];
 $prenom = $_GET['prenom'];
 $email = $_GET['Id_Email'];
 $titre=$_GET['Intitule'];
 $theme=$_GET['Theme'];
 $salle=$_GET['type_salle'] ;
 $organisateur = $_GET['type'];
 $dateDeb = $_GET['DATE_deb'];
 $dateFin = $_GET['DATE_fin'];
 $salle = $_GET['type_salle'];
 $commentaire = $_GET['comment']; 
 $id=$_GET['id'];
 $ido=$_GET['id2'];

 $bdd = new PDO('mysql:host=localhost;dbname=projet_web;charset=utf8', 'root', '');

 $hi=$bdd->prepare("SELECT id_salle FROM salle WHERE nom_salle= :salle ");

$donee = $hi->execute(array(
    'salle' => $salle));

 $q = "SELECT * FROM events WHERE date_db>='".$dateDeb."' AND date_fn<='".$dateFin."'AND id_salle='".$donee."' ";    
 if(isset($dateDeb) AND isset($dateFin)){
     $reponse = $bdd->query($q);
 
     $donnee = $reponse->fetch();
     if($donnee){
         $_SESSION['erreur']= 'La date ou la salle est déja réservé!';
         header('location:../Form/modifier.php');
     }
    }
 

 $re="UPDATE organisatuer SET profession=:profes,mail=:mail,nom=:nom,prénom=:prenom WHERE id_org='".$ido."'";
 $r=$bdd->prepare($re);
 $r->execute(array(
     'profes'=>$organisateur,
     'mail'=>$email,
     'nom'=>$nom,
     'prenom'=>$prenom
 ));


 $req="UPDATE events SET intitulé=:titre,thème=:theme,date_db=:datedb,date_fn=:datefn,id_salle=:salle,commentaire=:comment WHERE id_ev='".$id."'";
 $rep=$bdd->prepare($req);
 $rep->execute(array(
    'titre' => $titre,
    'theme' => $theme,
    'datedb' => $dateDeb,
    'datefn'=> $dateFin,
    'salle'=> $donee,
    'comment'=>$commentaire
     ));
     
header('location:../LOGIN/admin_space.php');
?>

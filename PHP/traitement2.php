<?php 
session_name('formulaire');
session_start();

$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$email = $_POST['Id_Email'];
$organisateur = $_POST['type'];
$salle=$_POST['type_salle'] ;
$dateDeb = $_POST['DATE_deb'];
$dateFin = $_POST['DATE_fin'];

 $_SESSION['Theme']= $_POST['Theme'];
 $_SESSION['Intitule']=$_POST['Intitule'];
 $_SESSION['DATE_deb']=$_POST['DATE_deb'];
 $_SESSION['DATE_fin']=$_POST['DATE_fin'];
 $_SESSION['type_salle']=$_POST['type_salle'] ;
 $_SESSION['comment']=$_POST['comment'];

 $bdd=new PDO('mysql:host=localhost;dbname=projet_web;charset=utf8', 'root','');

 $hi=$bdd->prepare("SELECT id_salle FROM salle WHERE nom_salle= :salle ");

 $donnee = $hi->execute(array(
     'salle' =>$salle));
 $q = "SELECT * FROM events WHERE date_db>='".$dateDeb."' AND date_fn<='".$dateFin."'AND id_salle='".$donnee."' ";    
 if(isset($dateDeb) AND isset($dateFin)){
     $reponse = $bdd->query($q);
 
     $donnee = $reponse->fetch();
     if($donnee){
         $_SESSION['err']= 'La date ou la salle est déja réservé!';
         header('location:../Form/index.php');
     }else{
        $_SESSION['id_salle']=$donnee;
        $rq = $bdd->query("SELECT id_org FROM organisatuer WHERE mail ='".$email."' AND nom = '".$nom."' AND prénom = '".$prenom."' AND profession = '".$organisateur."' ");
$donnee=$rq->fetch();
if($donnee){
    $_SESSION['organisateur']=$donnee['id_org']; 
    header('location:traitement3.php');
}else{
    $r=$bdd->prepare('INSERT INTO organisatuer 
            (mail,nom,prénom,profession) VALUES (:mail,:nom,:prenom,:profession)');

            $r->execute(array(
            'mail' => $email,
            'nom' => $nom,
            'prenom'=> $prenom,
            'profession' => $organisateur
             ));
             $a = $bdd->query("SELECT id_org FROM organisatuer WHERE mail ='".$email."' AND nom = '".$nom."' AND prénom = '".$prenom."' AND profession = '".$organisateur."' ");

             //$idOrg = $a->execute();
             $idOrg = $a->fetch();
             $_SESSION['organisateur']=$idOrg['id_org']; 
            header('location:traitement3.php');

     }
    }
    



}
//session_destroy();
?>
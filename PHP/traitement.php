<?php
session_start();
// insertion in BD 

$nom = $_POST['nom'];
$prenom = $_POST['prenom'];
$email = $_POST['Id_Email'];
$theme = $_POST['Theme'];
$intitule = $_POST['Intitule'];
$organisateur = $_POST['type'];
$dateDeb = $_POST['DATE_deb'];
$dateFin = $_POST['DATE_fin'];
$salle = $_POST['type_salle'];
$commentaire = $_POST['comment'];

// connexion avec la BD

$bdd = new PDO('mysql:host=localhost;dbname=projet_web;charset=utf8', 'root','');

$q = "SELECT * FROM events WHERE date_db='".$dateDeb."' AND date_fn='".$dateFin."'";    
if(isset($dateDeb) AND isset($dateFin)){
    $reponse = $bdd->query($q);

    $donnee = $reponse->fetch();
    if($donnee){
        $_SESSION['erreur']= 'La date ou la salle est déja réservé!';
        header('location:../Form/index.php');
    }else{
        
        // verif de id_org

        $rq = $bdd->query("SELECT id_org FROM organisatuer WHERE mail ='".$email."' AND nom = '".$nom."' AND prénom = '".$prenom."' AND profession = '".$organisateur."' ");

        $info = $rq->execute();
        //$info = $rq->fetch();

        if($info)

        {
            $rep=$bdd->prepare('INSERT INTO events 
            (intitulé,thème,id_org,date_db,date_fn,salle,commentaire) 
            VALUES (:intitule,:theme,:organisateur,:date_db,:date_fn,:salle,:commentaire)');

            $rep->execute(array(
            'intitule' => $intitule,
            'theme' => $theme,
            'organisateur'=> $info,
            'date_db' => $dateDeb,
            'date_fn'=> $dateFin,
            'salle'=> $salle,
            'commentaire'=> $commentaire
             ));
            header('location:../LOGIN/admin_space.php');
        }
        
        else
        
        {
            $r=$bdd->prepare('INSERT INTO organisatuer 
            (mail,nom,prénom,profession) VALUES (:mail,:nom,:prenom,:profession)');

            $r->execute(array(
            'mail' => $email,
            'nom' => $nom,
            'prenom'=> $prenom,
            'profession' => $organisateur
             ));

             $a = $bdd->query("SELECT id_org FROM organisatuer WHERE mail ='".$email."' AND nom = '".$nom."' AND prénom = '".$prenom."' AND profession = '".$organisateur."' ");

             $idOrg = $a->execute();
             //$idOrg = $a->fetch();

             $rep=$bdd->prepare('INSERT INTO events 
            (intitulé,thème,id_org,date_db,date_fn,salle,commentaire) 
            VALUES (:intitule,:theme,:organisateur,:date_db,:date_fn,:salle,:commentaire)');

            $rep->execute(array(
            'intitule' => $intitule,
            'theme' => $theme,
            'organisateur'=> $idOrg,
            'date_db' => $dateDeb,
            'date_fn'=> $dateFin,
            'salle'=> $salle,
            'commentaire'=> $commentaire
             ));
             header('location:../LOGIN/admin_space.php');

        }
    }
}

?>

<?php
session_start();

if(isset($_POST['user']) && isset($_POST['mdp'])&&!empty($_POST['user'])&&!empty($_POST['mdp'])) 
{

try
{
    $bdd= new PDO('mysql:host=localhost; dbname=projet_web','root','');
    $bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    $req = $bdd->prepare('SELECT pseudo,code FROM admini WHERE pseudo=? AND code=?');

    $req->execute(array($_POST['user'],$_POST['mdp']));

    $donnee = $req->fetch();

    if($donnee){
        $_SESSION['user']=$donnee['pseudo'];
        $_SESSION['mdp']=$donnee['code'];
        header('location:admin_space.php');
    }

    else 
    {		
        $_SESSION['erreur']= 'Votre mot de passe et login sont incorrecte!';header('location:login.php');
    }
}

// capturer l'erreur 

catch(PDOException $e)
    {
      die('erreur' . $e->getMessage());
	}
}

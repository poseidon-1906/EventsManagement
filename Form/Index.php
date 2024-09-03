<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Formulaire de l'organisateur</title>
    <meta name="description" content="une plateforme de gestion de manifestation au sein d'une université">
    <!-- add boostrap -->
    <link rel="stylesheet" href="../bootstrap-4.4.1-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="Style3.css">
    <script src="jquery-3.4.1.min"></script>

</head>

<body>
    <div class="container-fluid"> <!-- le background ou je vais inserer une image-->
        <div class="container formu"> <!-- la div du formulaire -->
            <!-- text avant les input -->
            <div class="texte">
                <i class="fas fa-calendar-alt"></i>
                <h2><strong>Créer une nouvelle manifestation :</strong> </h2>
                <p>Remplissez les différents informations de la manifestation :</p>
            </div>
            <form action="../PHP/traitement.php" method="post">

                    <div class="place line">
                        <label>Nom :
                        <input type="text" name="nom" 
                        placeholder="Nom" required></label>
                        <div class="pren" required><label>Prénom :
                        <input type="text" name="prenom"     placeholder="Prénom"></label></div>
                    </div>

                    <div class="place line">
                        <label>Email :
                        <input type="email" name="Id_Email" placeholder="Pseudo@gmail.com" required></label>
                    </div>
                    
                    <div class="place line">
                        <label>Intitulé :
                        <input type="text" name="Intitule" placeholder="Titre de l'évènement" required></label>
                    </div>

                    <div class="place line">
                        <label>Thème :
                        <input type="text" name="Theme" placeholder="Thème de l'évènement"></label>
                    </div>
                
                    <div class="place line">
                        <label>Organisateur :
                        <input type="text" name="type" placeholder="Organisateur" required></label>
                    </div>

                    <div class="place">
               
                         <select name="type_salle" id="" required>
                            <option value="" disabled selected>Choose your option</option>
                             <option value="Salle">Salle</option>
                             <option value="Salle de conférence">Salle de conférence </option>
                             <option value="Salle de formation">Salle de formation </option>
                         </select>
<!--
                         <input type="checkbox" name="type_salle[]" value="Salle"> Salle<br>
                         <input type="checkbox" name="type_salle[]" value="Salle de conférence"> Salle de conférence
                         <input type="checkbox" name="type_salle[]" value=" Salle de formation"> Salle de formation
                         <input type="checkbox" name="type_salle[]" value="Hall"> Hall
                    </div>
--> 
                    <div class="place line">
                        <label>Date début :
                        <input type="datetime-local" name="DATE_deb" required></label>
                    </div>

                    <div class="place line">
                        <label>Date Fin :
                        <input type="datetime-local" name="DATE_fin" required></label>
                    </div>

                    <div class="place">
                        <label>Commentaire : 
                        <textarea name="comment" id="com" cols="68" rows="6" placeholder="Ajouter un commetaire"></textarea>
                    </div>

                    <!-- Ajouter l'import d'un fichier ! Affiche.... -->

                    <center><button type="submit" class="btn btn-primary">Ajouter un évenement</button>
                       <a href="http://localhost/Projet_web/Home.html"><button type="button" class="btn btn-primary" value="Home">Retour à la page d'acceuil</button></a> 
                    </center>
               
            </form>
        </div>
    </div>

    <?php
    if(isset($_SESSION['erreur']))
    {
       echo "<script> alert('". $_SESSION['erreur'] ."') </script>";
    }
    session_destroy();
    ?>
</body>
</html>
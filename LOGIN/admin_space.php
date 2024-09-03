<?php
session_start();

/*if(!isset($_SESSION['user']))
{
    header('location:login.php');
}
*/
$bdd = new PDO('mysql:host=localhost;dbname=projet_web;charset=utf8', 'root', '');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Espace administrateur</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="admin.css">
    <style>

      .card a{
        text-decoration : none;
        color : white;
      }

      #add_new_list{
      top: -38px;
      right: 0px;
      }

      .card
      {
        width : 1200px;
        
      }
    </style>
    
</head>
<body>
  
  <!-- Modal de salle -->
  <div class="modal fade" id="details" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalScrollableTitle">Ajouter une salle</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="../PHP/AjoutSalle.php" method="post">
            <div>
                <label>Nom de la salle :
                <input type="text" name="Ajout_salle" placeholder="Nom de la salle"></label>
            </div>
            <button type="submit" class="btn btn-primary">Ajouter</button>
            </form>
            <hr>
            <p>Supprimer une salle</p>
            <form action="../PHP/delete.php" method="post">
              <select name="type_salle">
                <?php 
                $h=$bdd->query('SELECT * FROM salle');
                while($y=$h->fetch()){
                ?>
                <option> <?php echo $y['nom_salle'] ?></option>
                <?php } ?>
              </select>
              <button type="submit" class="btn btn-primary">Supprimer</button>
            </form>

              
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
        </div>
      </div>
    </div>
  </div>
  

<!-- espace admin = tableau -->
<main>
<div class="container my-5">
       <div class="card-body text-center">
    <h2 class="card-title">Espace réservé à l'administrateur de l'Université!</h2>
  </div>
    <div class="card">
        <button id="add_new_list" type="button" class="btn btn-primary position-absolute" data-toggle="modal" data-target=".bd-example-modal-lg"><i class="fas fa-plus"></i> <a href="../Form/index.php"> Ajouter un nouveau évenement </a></button>
        
        
        <table class="table table-hover">
            <thead>
              <tr>
                <!-- <th scope="col">ID</th> -->
                <th scope="col">Nom d'événement</th>
                <th scope="col">Théme</th>
                <th scope="col">Date début</th>
                <th scope="col">Date fin</th>
                <th scope="col">Action</th>
                <th><button type="button" class="btn btn-sm btn-success" data-toggle="modal" data-target="#details">
                <i class="fas fa-trash-alt"></i> Ajouter salle </button></th>
              </tr>
            </thead>
            <tbody>
              <?php
              $reponse = $bdd->query('SELECT * FROM events');

              while ($donnees = $reponse->fetch())
              { 
              ?>
              
              <tr>
                <!-- <th scope="row"><?php echo $donnees['id_ev']?></th> -->
                <td><?php echo  $donnees['intitulé']?></td>
                <td><?php  echo $donnees['thème']?></td>
                <td><?php echo $donnees['date_db']; ?></td>
                <td><?php echo $donnees['date_fn']; ?></td>
                <?php
                $dateDeb = $donnees['date_db'];
                $datefn = $donnees['date_fn'];
                $idSalle = $donnees['id_salle'];
                $req = $bdd->query("SELECT * FROM calendar WHERE date_db='".$dateDeb."' AND date_fn='".$datefn."' AND id_salle='".$idSalle."'");

                if(!($donn = $req->fetch()))
                {

                ?>
                <td>
                    <a class="btn btn-sm btn-primary" href="../PHP/modifier.php?id=<?php echo($donnees['id_ev']); ?>"><i class="far fa-edit"></i> Modifier</a>
                    <a class="btn btn-sm btn-success" href="../PHP/publier.php?id=<?php echo($donnees['id_ev']); ?>"><i class="fas fa-trash-alt"></i>Publier</a>
                     <!-- <a class="btn btn-sm btn-danger" href="../PHP/modal.php"><i class="fas fa-trash-alt"></i>Détails</a>  -->
                    
                    <!-- <button href="admin_space.php?id=<?php echo($donnees['id_ev']); ?>" type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#detail">
                    Détails
                    </button> -->
                           
                </td>
                <?php
                }
                ?>
              </tr>
              <?php
              }
              ?>
              </tr>
            </tbody>
          </table>
            </div>


<!-- deconnection -->
<center>
<form action="LogOut.php" method='post'>
    <button type='submit' value='Log out' class='btn btn-primary'>Se déconnecter</button>
     <a href="../home2.php"> <input type="button" value="Page d'acceuil" class='btn btn-primary'></a>
</form>
</center>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
<script>
    $('#myModal').on('shown.bs.modal', function () {
  $('#myInput').trigger('focus')
})
</script>
</body> 
</html>

<?php
session_destroy();
?>

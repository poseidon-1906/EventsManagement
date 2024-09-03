<?php
session_start();

$bdd = new PDO('mysql:host=localhost;dbname=projet_web;charset=utf8', 'root', '');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>plateforme de gestion de manifestation</title>
    <link rel="stylesheet" href="bootstrap-4.4.1-dist/css/bootstrap.min.css">
    
    <!--<script src="jquery-3.4.1.min"></script>-->
    <!-- partie du head du calendrier -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.css" />
    
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.css" />

   <link rel="stylesheet" href="stylehome.css">
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/3.4.0/fullcalendar.min.js"></script>
   <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
   




  <!-- fin de partie head du calendar -->
</head>

<body>
    <div class="container_fluid head">
        <div class="shadow_head">
        <div class="header">
            <ul class="header_list">
                <li> <a href="LOGIN/login.php"><button type="button" class="btn btn-outline-light">Espace Administrateur</button> </a> </li>
            </ul>
        </div>
        <div class="calendarImg">
            <img src="images/Calendar_Img.png" alt="Illustration d'un Calendrier">
        </div>
        
        <div class="header_text">
            <h1>Platforme de gestion <br> d'évenement</h1>
            <p>Notre plateforme vous permet de visualiser régulièrement les différents évenement <br>de votre université (conférence, séminaire, soirée, manifestation sportive,  <br>assemblée générale ...)</p>
            <a href="#calend"> <button id="btn_calendar" type="button" class="btn btn-primary btn-lg">View Calendar</button></a>
            <a href="#act"> <button id="btn_calendar" type="button" class="btn btn-primary btn-lg">Actualités</button></a>
        </div>
        </div>

    </div>

        <!-- Timeline bootsnip -->
        

                <div class="container mt-5 mb-5">
            <div class="row">
                <div id="act" class="timee col-md-6 offset-md-3">
                    <h4>Actualités</h4>
                    <ul class="timeline">
                    <?php
              $reponse = $bdd->query('SELECT * FROM calendar ORDER BY date_db LIMIT 3');
              $sal = $bdd->query('SELECT * FROM salle');
              $reqsal=$sal->fetch();

              while ($donnees = $reponse->fetch())
              { 
              ?>
                        <li>
                            <a target="_blank" href="#"><strong> <?php echo  $donnees['intitulé']?> </strong></a>
                            <a href="#" class="float-right">  De <?php echo $donnees['date_db']; ?> à <?php echo $donnees['date_fn']; ?></a>
                            <p><strong>Salle : </strong><?php echo $reqsal['nom_salle']; ?></p>
                            <p><?php echo $donnees['commentaire']; ?></p>
                        </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>


    <!-- div du view calendar -->
    <center>
    <div id='calend' class="container Cald" style="width: 930px;">
        <br />
        <h2 align="center"><a href="#">Calendrier d'évenement</a></h2>
        <br />
        <div id="calendar"></div>
    </div></center>
    




    <!-- Footer -->
    <footer class="footer">
        <p>Copyright © 2020</p>
    </footer>

    <!-- fonction de scroll vers le bas si on click sur view calendar -->
    <script>
        $("a[href^='#']").click(function(e) {
	e.preventDefault();
	
	var position = $($(this).attr("href")).offset().top;
	$("body, html").animate({
		scrollTop: position
	} /* speed */ );
});
    </script>

            <!-- Modal -->
  <div class="modal fade" id="details" tabindex="-1" role="dialog" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalScrollableTitle">Détails</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
            <h5> Intitulé : </h5>
            <p id="intitule"></p>
            <!-- <hr> -->
            <!-- <h5> Thème : </h5>
            <p id="theme"> </p> -->
            <hr>
            <h5> Date début : </h5>
            <p id="datedeb"> </p>
            <hr>
            <h5> Date fin : </h5>
            <p id="datefn"> </p>
            <hr>
            <!-- <h5> Salle : </h5>
            <p id="salle"> </p>
            <hr> -->
            <!-- <h5> Déscription : </h5>
            <p id="comment"> </p> -->
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          
        </div>
      </div>
    </div>
  </div>


  <!-- fin modal -->
  <script>
   
   $(document).ready(function() {
    var calendar = $('#calendar').fullCalendar({
     editable: false,
     header:{
      left:'prev,next today',
      center:'title',
      right:'month,agendaWeek,agendaDay'
     },
     <?php $bdd = new PDO('mysql:host=localhost;dbname=projet_web;charset=utf8', 'root', ''); ?>
     events:[ <?php $reponse = $bdd->query('SELECT * FROM calendar'); 
                   while ($donnees = $reponse->fetch())
     { ?>
         {
             'title':"<?php echo  $donnees['intitulé'];?>",
             'start':'<?php echo $donnees['date_db']; ?>',
             'end':'<?php echo $donnees['date_fn']; ?>',
             
             
         },
     
 <?php } ?>],
     eventClick:function(events)
     {
         console.log(events)
         document.getElementById('intitule').innerHTML=events.title; 
         document.getElementById('datedeb').innerHTML=events.end;
         document.getElementById('datefn').innerHTML=events.start;
        //  document.getElementById('comment').innerHTML=events.extendedProps.commentaire;
         $('#details').modal('toggle');
     },
    });
   });
    
   </script>
  
</body>
</html>

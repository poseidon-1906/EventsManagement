<?php
session_start();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="loginn.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js" charset="utf-8"></script>
</head>
<body>

    <form action="verif.php" class="login-form" method='post'> 
      <h1>LOGIN</h1>
        <div class="txtb">
          <input type="text" name='user'>
          <span data-placeholder="Username"> </span>
        </div>

        <div class="txtb">
            <input type="password" name='mdp'>
            <span data-placeholder="Password"> </span>
          </div>

         <input type="submit" class="logbtn" value="Login">
        
    </form>
    <script type="text/javascript">
    $(".txtb input").on("focus",function(){
        $(this).addClass("focus");
    });
    $(".txtb input").on("blur",function(){
        if($(this).val()=="")
        $(this).removeClass("focus");
    });

    </script>
        <?php
    if(isset($_SESSION['erreur']))
    {
       echo "<script> alert('". $_SESSION['erreur'] ."') </script>";
    }
    session_destroy();
    ?>
    

</body>
</html>
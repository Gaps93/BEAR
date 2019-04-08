<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Satisfy" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poiret+One" rel="stylesheet">
    	<link href="blog.css" rel="stylesheet" />
    <title>Connexion</title>
    </head>
    <body class="container">

      <section class="row">
        <article class="col-md-8">

          <?php
            include('./fonctions.php');
            session_start();

            // Deconnexion
            if (htmlentities($_GET["action"]==1))
            {
                $_SESSION["admin"]=0;
                header("Location:index.php");
            }
            
            ?>

      </article>
    </section>

   </body>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  </html>

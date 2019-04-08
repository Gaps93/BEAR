<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Satisfy" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poiret+One" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    	<link href="blog.css" rel="stylesheet" />
        <title>Bear</title>
	<link href="blog.css" rel="stylesheet" />
    </head>

    <body class="container">
        <header class="row">
           <img src="image/Logo.png" alt=""><h1> Supervision Réseau </h1>
        </header>

        <section>
            <nav>
              <ul><?php
              session_start();

              if (!isset($_SESSION["admin"]))
              {
                $_SESSION["admin"]=0;
              }

              try {
                $bdd = new PDO('mysql:host=localhost;dbname=bear','root','root',array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
                $bdd->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

                }

              catch (Exception $e) {
                // message en cas d'erreur
                die ('Erreur : ' . $e->getMessage());
              }
              finally {
                $bdd = null;  //fermeture de la connexion
              }


              if ($_SESSION["admin"]==0) {
                echo "
                  <li><a href='index.php'>Accueil</a></li><!aaaa
                  aaa><li class='actif'><a href='login.php'>Connexion</a></li><!aaaa
                  aaa><li><a>Produit</a></li><!aaaa
                  aaa><li><a>Support</a></li><!aaaa
                  aaa><li><a>Telechargement</a></li>";
              }

              elseif ($_SESSION["admin"]==1) {
                echo "
                  <li><a href='index.php'>Accueil</a></li><!aaaa
                  aaa><li class='actif'><a href='action.php?action=1'>Deconnexion</a></li><!aaaa
                  aaa><li><a>Produit</a></li><!aaaa
                  aaa><li><a>Support</a></li><!aaaa
                  aaa><li><a>Telechargement</a></li>";
              }
                  ?>
              </ul>
            </nav>
        </section>


      <section class="row">
        <article class="col-md-8">
      <?php

      if (!isset($_GET["fin"]))
      {
        echo '
        <form action="login_verif.php" method="post">
          <p>
            Login : <input type="text" name="login"/>
            Mot de Passe : <input type="password" name="pwd"/>
            <input type="submit" value="Valider"/>
          </p>
        </form>';
      }

      if (isset($_GET["erreur"]))
      {
        echo "<h1>Erreur de Saisi, Recommencer.</h1>";
      }

      ?>

    </article>
  </section>

 </body>
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</html>

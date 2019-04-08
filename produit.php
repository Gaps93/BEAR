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
                  aaa><li class='actif'><a>Produit</a></li><!aaaa
                  aaa><li><a>Support</a></li><!aaaa
                  aaa><li><a>Telechargement</a></li><li><a href='login.php'>Connexion</a></li><!aaaa
                  aaa>";
              }

              elseif ($_SESSION["admin"]==1) {
                echo "
                  <li><a href='index.php'>Accueil</a></li><!aaaa
                  aaa><li class='actif'><a>Produit</a></li><!aaaa
                  aaa><li><a>Support</a></li><!aaaa
                  aaa><li><a>Telechargement</a></li><li><a href='action.php?action=1'>Deconnexion</a></li><!aaaa
                  aaa>";
              }
                  ?>
              </ul>
            </nav>
        </section>

      <section class="row">
        <article class="col-md-8">

      <?php

      if ($_SESSION["admin"]==0) {
        echo "<h3><p> Pour commencer à utiliser notre application, veuillez vous connecter.</p></h3>";

      }

      elseif ($_SESSION["admin"]==1) {

        try {
            $bdd = new PDO('mysql:host=localhost;dbname=bear','root','root',array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
            $bdd->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

            $req = "SELECT * FROM machine WHERE Adresse_Mac = :machine ";
            // préparation de la requête avec les noms
            $res = $bdd->prepare($req);
            $machine = htmlentities($_GET['machine']);
            $res->execute(array('machine'=> $machine));
            $res->bindValue(':machine',$machine);
            $res->execute();

                        // affichage des commentaires

          while ($ligne = $res->fetch())  {
            echo "<p><h2> Nom de la machine supervisé :  " . $ligne['Nom_Machine'] . "</h2></p>";
            echo "<p><h4> Adresse MAC de la machine :</h4><h3>        " . $ligne['Adresse_Mac'] . "</h3></p>" . "\n";
            echo "<p><h4> Machine allumée depuis :</h4><h3>        " . $ligne['Temps_Actif'] . "</h3></p>" . "\n";
            echo "<p><h4> Processeur installé :</h4><h3>        " . $ligne['Processeur'] . "</h3></p>" . "\n";
            echo "<p><h4> Carte Graphique installé :</h4><h3>        " . $ligne['Carte_Graphique'] . "</h3></p>" . "\n";
            echo "<p><h4> RAM installé :</h4><h3>        " . $ligne['RAM'] . "</h3></p>" . "\n";
            echo "<p><h4> RAM disponible :</h4><h3>        " . $ligne['RAM_Dispo'] . "</h3></p>" . "\n";
            echo "<p><h4> Capacité disque dur installé :</h4><h3>        " . $ligne['Espace_Disque'] . "</h3></p>" . "\n";
            echo "<p><h4> Espace disponible sur le disque dur :</h4><h3>        " . $ligne['Espace_Disque_Dispo'] . "</h3></p>" . "\n";
          }

        }
          catch (Exception $e) {
                        // message en cas d'erreur
              die ('Erreur : ' . $e->getMessage());
            }

        finally {
            $bdd = null;  //fermeture de la connexion
            }

      }
       ?>
      </article>
    </section>





 </body>
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</html>

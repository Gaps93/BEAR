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
              session_start();

              try {
                $bdd = new PDO('mysql:host=pedago2;dbname=rt1a1718_bk339265','bk339265','mdpbk339265',array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
                $bdd->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

                // Insertion du commentaire ecrit
                $req = "SELECT id_billet FROM billet ORDER BY id_billet DESC LIMIT 1";
                // préparation de la requête avec les noms


                $res = $bdd->prepare($req);
                $res->execute();

                  while ($ligne = $res->fetch())
                    {
                      $max=$ligne['id_billet'];
                    }
                  }

              catch (Exception $e) {
                // message en cas d'erreur
                die ('Erreur : ' . $e->getMessage());
              }

              finally {
                $bdd = null;  //fermeture de la connexion et renvoie vers le premier site
              }

              $billet=$max+1;

            // Connexion a la base de donnee
              try {
                $bdd = new PDO('mysql:host=pedago2;dbname=rt1a1718_bk339265','bk339265','mdpbk339265',array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
                $bdd->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);

                // Insertion du commentaire ecrit
                $titre=$_POST["titre"];
                $contenu=$_POST["msg"];
                $date=date('Y-m-d H:i:s');
                $sql = "INSERT INTO billet (id_billet, titre,contenu,date_creation) VALUES ('$billet','$titre','$contenu','$date')";
                $res = $bdd->exec($sql);

                }

              catch (Exception $e) {
                // message en cas d'erreur
                die ('Erreur : ' . $e->getMessage());
              }

              finally {
                $bdd = null;  //fermeture de la connexion et renvoie vers le premier site
                header("Location:administration.php");
              }




            ?>

      </article>
    </section>

   </body>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  </html>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Satisfy" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poiret+One" rel="stylesheet">
    <link rel="stylesheet" href="login.css" />
    <title>bear</title>
    </head>
    <body class="container">
      <section class="row">
        <article class="col-md-8">
          <?php
            if (isset($_POST["login"]) && isset($_POST["pwd"]))
            {
              // Connexion a la base de donnee
              try {
                $bdd = new PDO('mysql:host=localhost;dbname=bear','root','root',array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8'));
                $bdd->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);


                $req = "SELECT * FROM personne WHERE login = :login AND password = :password";
                // préparation de la requête avec les noms
                $res = $bdd->prepare($req);
                $login = htmlentities($_POST['login']);
                $password = htmlentities($_POST['pwd']);
                $res->execute(array('login'=> $login,'password'=>$password));
                $res->bindValue(':login',$login);
                $res->bindValue(':password',$password);
                $res->execute();
                $nb_lignes = $res->rowCount();
                // s'il y a au moins une ligne c'est que la personne existe en base de données
                if ($nb_lignes >0)
                {
                  session_start();
                  $_SESSION["admin"]=1;
                  header("Location:index.php");
                                  }
                else
                {// redirection vers la page login.php
                  header("Location:login.php?erreur");
                }
              }
              catch (Exception $e) {
                // message en cas d'erreur
                die ('Erreur : ' . $e->getMessage());
              }
              finally {
                $bdd = null;//fermeture de la connexion
              }
            }
            else
            {   // redirection vers la page login.php
              header("Location:login.php?erreur");
            }
          ?>
      </article>
    </section>
    <footer>
    <img src="Cleopatre.jpg" alt=""></footer>
   </body>
   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  </html>

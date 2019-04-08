<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Satisfy" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poiret+One" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">
    	<link href="blog.css" rel="stylesheet" />
        <title>Cambridge Motors</title>
	<link href="blog.css" rel="stylesheet" />
    </head>

    <body class="container">
        <header class="row">
           <img src="image/logo.png" alt=""><h1> Cambridge Motors </h1>
        </header>

        <section>
            <nav>
              <ul><?php
              session_start();
              if ($_SESSION["admin"]==0) {
                echo "
                  <li class='actif'><a href='index.php>Accueil</a></li><!aaaa
                  aaa><li><a href='commentaires.php?article=$max'>Commentaires</a></li><!aaaa
                  aaa><li><a href='login.php'>Connexion</a></li><!aaaa
                  aaa><li><a>Histoire</a></li><!aaaa
                  aaa><li><a>Contact</a></li>";
              }

              elseif ($_SESSION["admin"]==1) {
                echo "
                  <li class='actif'><a href='index.php'>Accueil</a></li><!aaaa
                  aaa><li><a href='commentaires.php?article=$max'>Commentaires</a></li><!aaaa
                aaa><li><a href='administration.php'>Administration</a></li><!aaaa
                aaa><li><a href='insertion_contenu.php?action=4'>Deconnexion</a></li><!aaaa
                aaa><li><a>Contact</a></li>";
              }

                  ?>
              </ul>
            </nav>
        </section>


      <section class="row">
        <article class="col-md-8">

          test

    </article>
  </section>

 </body>
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</html>

<?php
// Demarrage de la session
  session_start();
?>

<!DOCTYPE html>
<html>
<head>
  <title>Détail de l'œuvre</title>
  <link rel="stylesheet" href="style.css">
  <script>
    function handleLikeButtonClick() {
      var button = document.getElementById("likeButton");
      button.classList.toggle("liked");
    }
  </script>
</head>
<body >
<h1>Détail de l'œuvre</h1>
<div class="body">


<?php
 // Si le user est connecté
  if(isset($_SESSION["mail"])){
      // Inclusion du fichier de connexion à la base de données
    include 'connect.php';

    // Vérification si l'identifiant de l'œuvre est passé en paramètre
    if (isset($_GET['ido'])) {
      $ido = $_GET['ido'];

      // Requête pour récupérer l'œuvre correspondante à l'identifiant
      $query = "SELECT * FROM oeuvre WHERE ido = $ido";
      $result = mysqli_query($id, $query);

      // Vérification si l'œuvre a été trouvée
      if (mysqli_num_rows($result) > 0) {
        // Affichage de l'œuvre
        $oeuvre = mysqli_fetch_assoc($result);
        echo '<div class="category">';
        echo '<h2>'.$oeuvre['categorie'].'</h2>';
        echo '<a href="oeuvre.php?ido='.$oeuvre['ido'].'">';
        echo '<img src="'.$oeuvre['photo'].'" alt="Œuvre" width="300" height="350">';
        echo '</a>';
        echo '<p>Nombre de likes : '.$oeuvre['nb_like'].'</p>';
        // Bouton pour liker l'œuvre
        echo '<form method="POST" action="like.php">';
        echo '<input type="hidden" name="ido" value="'.$oeuvre['ido'].'">';
        echo '<button id="likeButton" type="submit" class="like-button" onclick="handleLikeButtonClick()">';
        echo '<img src="icone/heart-gray.png" alt="Like" width="24" height="24" class="heart-icon gray">';
        echo '<img src="icone/heart-red.png" alt="Like" width="24" height="24" class="heart-icon red">';
        echo '</button>';
        echo '</form>';
        echo '</div>';
        // Afficher la description de l'œuvre
        echo '<div class="detail">';
        echo '<h3>Description :</h3>';
        echo '<p>'.$oeuvre['description'].'</p>';
        echo '</div>';
      } else {
        echo 'Aucune œuvre trouvée avec cet identifiant.';
      }

      // Libération des résultats de la requête
      mysqli_free_result($result);
    } else {
      echo 'Identifiant de l\'œuvre non spécifié.';
    }

    // Fermeture de la connexion à la base de données
    mysqli_close($id);
  }
  // Sinon redirection vers la page d'accueil
  else{
     header("location:accueil.php");
  }
   

?>
</div>
<p><button><a class="lien" href="<?=$oeuvre['categorie']?>.php">Retour</a></button></p>
</body>
</html>

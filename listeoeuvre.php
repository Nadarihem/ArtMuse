<?php
// Démarrage de la session
  session_start();
  // Si c'est l'admin qui est connecté
  if(isset($_SESSION["mail"]) && $_SESSION["mail"]==="root@gmail.com"){
      // Inclusion de la connexion à la BDD
      include "connect.php";
  }

  else{
      header("location:accueil.php");
  }

?>

<!DOCTYPE html>
<html>
<head>
  <title>Liste des œuvres</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <h1>Liste des œuvres</h1><br>

  <?php
    // Requête pour récupérer toutes les œuvres
    $query = "SELECT * FROM oeuvre";
    $result = mysqli_query($id, $query);

    // Vérification si des œuvres ont été trouvées
    if (mysqli_num_rows($result) > 0) {
        // Bouton d'ajout d'une oeuvre
        ?>
       <p><button><a class="lien" href="ajouter.php">Ajouter une oeuvre</a></button></p><br>
        <?php
      echo '<table>';
      echo '<th>Catégorie</th><th>photo</th><th>Description</th><th>Nombre de likes</th><th>Actions</th></tr>';

      // Parcours des résultats de la requête
      // Affichage des oeuvres
      while ($oeuvre = mysqli_fetch_assoc($result)) {
        echo '<tr>';
        echo '<td>'.$oeuvre['categorie'].'</td>';
        ?>
        <td><img src='<?=$oeuvre["photo"]?>' width='50'></td>
        <?php
        echo '<td>'.$oeuvre['description'].'</td>';
        echo '<td>'.$oeuvre['nb_like'].'</td>';
        echo '<td>';
        echo '<a href="modif.php?ido='.$oeuvre['ido'].'"><img src="icone/modif.png" alt="Modifier" width="24" height="24"></a>';
        echo '<a href="supp.php?ido='.$oeuvre['ido'].'"><img src="icone/supp.png" alt="Supprimer" width="24" height="24"></a>';
        echo '</td>';
        echo '</tr>';
      }

      echo '</table>';
      
      // Bouton retour 
      ?>
      <p><button><a class="lien" href="accueil.php">Retour</a></button></p><br><br>
      <?php

      // Libération des résultats de la requête
      mysqli_free_result($result);
    } else {
      echo 'Aucune œuvre trouvée.';
    }

    // Fermeture de la connexion à la base de données
    mysqli_close($id);
  ?>
   
</body>
</html>

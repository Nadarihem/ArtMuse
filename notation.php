<?php
//Demarrage de la session
session_start();
// Si connecté
if(isset($_SESSION["mail"])){
    include "connect.php"; // Inclure le fichier de connexion à la base de données

    if (isset($_POST["bouton"])) {
      $note = $_POST['note']; // Récupérer la note soumise dans le formulaire
      // Requête d'insertion de la note dans la table
      $idu = $_SESSION["idu"]; //asmaou c'est là qu'il faut modifier le truc
      $req = "INSERT INTO notation (idn,idu,note ) VALUES (null, '$idu','$note' )";
      $res=mysqli_query($id, $req);
    
      if ($res) {
        echo "<h2>Merci pour votre notation ! :) </h2>";
        header("refresh:3 url='deconnexion.php'");
      } else {
        echo "Erreur lors de l'insertion de la notation : " . mysqli_error($id);
      }
    }
    
    // Fermer la connexion à la base de données
    mysqli_close($id);
}
// Sinon redirection vers accueil
else{
    header("location:accueil.php");
}

?>


<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Notation de l'entreprise</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>

  <form action="notation.php" method="post">
    <h1>Notation de l'entreprise</h1>

    <div class="rating">
      <input type="hidden" name="note" id="note" value="0"> <!-- Ajout d'un champ caché pour stocker la note -->
      <span onclick="rate(1)"><span>10</span></span> 
      <span onclick="rate(2)"><span>9</span></span>
      <span onclick="rate(3)"><span>8</span></span>
      <span onclick="rate(4)"><span>7</span></span>
      <span onclick="rate(5)"><span>6</span></span>
      <span onclick="rate(6)"><span>5</span></span>
      <span onclick="rate(7)"><span>4</span></span>
      <span onclick="rate(8)"><span>3</span></span>
      <span onclick="rate(9)"><span>2</span></span>
      <span onclick="rate(10)"><span>1</span></span>
    </div>

    <input type="submit" value="Envoyer la satisfaction" name="bouton">
  </form>

  <script>
    function rate(score) {
      document.getElementById('note').value = score; // Mettre à jour la valeur du champ de la note
      var stars = document.getElementsByClassName('rating')[0].children;
      for (var i = 0; i < stars.length; i++) {
        if (i >= (10 - score)) {
          stars[i].style.backgroundImage = "url(icone/etoile-jaune.png)";
        } else {
          stars[i].style.backgroundImage = "url(icone/etoile-blanche.png)";
        }
      }
    }
  </script>
  <p><button><a class="lien" href="deconnexion.php">Une autre fois</a></button></p><br><br>
</body>
</html>



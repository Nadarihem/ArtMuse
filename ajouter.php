<?php
// Inclusion du fichier de connexion à la base de données
include 'connect.php';

// Vérification si des données ont été soumises via le formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $categorie = $_POST['categorie'];
  $description = $_POST['description'];
  $photo = $_FILES['photo']['name'];

  // Déplacement du fichier photo vers le dossier de destination
  $destination = 'oeuvre/' . basename($photo);
  move_uploaded_file($_FILES['photo']['tmp_name'], $destination);

  // Requête pour insérer le nouveau produit dans la base de données
  $query = "INSERT INTO oeuvre (categorie, description, nb_like, photo) VALUES ('$categorie', '$description', 0, '$destination')";
  $result = mysqli_query($id, $query);

  if ($result) {
    echo 'Le nouveau produit a été ajouté avec succès.';
  } else {
    echo 'Une erreur est survenue lors de l\'ajout du produit.';
  }
}

// Fermeture de la connexion à la base de données
mysqli_close($id);
?>
<!DOCTYPE html>
<html>
<head>
  <title> Proposer une nouvlle oeuvre</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
    <form class= "form_modif" method="POST" action="ajouter.php" enctype="multipart/form-data">
    <h1>Proposer une nouvelle oeuvre</h1>
      <label for="categorie">Catégorie :</label>
      <select name="categorie" required>
        <option value="Sculpture">Sculpture</option>
        <option value="Bijoux">Bijoux</option>
        <option value="Peinture">Peinture</option>
        <option value="Poesie">Poesie</option>
        <option value="Meuble">Meuble</option>
        <option value="Costume">Costume</option>
      </select><br>

      <p><label for="description">Description :</label></p>
      <p><textarea name="description" rows="4" cols="50" required></textarea></p>
      <p><label for="photo">Photo :</label></p>
      <p><input type="file" name="photo" required></p>
      <p><input type="submit" value="Ajouter"></p>
      <p><button><a class="lien" href="listeoeuvre.php">Retour</a></button></p>
    </form>
</body>
</html>

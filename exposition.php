<?php
 // Démarrage de la session
   session_start();
?>

<!DOCTYPE html>
<html>
<head>
  <title>Exposition</title>
  <link rel="stylesheet" href="style.css">
</head>
<body>
  <?php
    // Si le user est connecté
     if(isset($_SESSION["mail"])){
      ?>
      <!-- Affichage des différentes catégories d'oeuvres exposées -->
      <h1>Exposition</h1><br><br>

      <div>
        <a href="bijoux.php" class="category-link">
        <div class="category">
          <h2>Catégorie Bijoux</h2>
          <img src="catégorie/bijoux art.png" alt="Catégorie Bijoux" width="300" height="350">
          <p>Une vitrine captivante de l'art joaillier à travers les âges.</p>
          <p>Un univers étincelant des bijoux anciens et contemporains.</p>
        </div>
    
        <a href="sculpture.php" class="category-link">
        <div class="category">
          <h2>Catégorie sculpture</h2>
          <img src="catégorie/sculpture art.png" alt="Catégorie sculpture" width="300" height="350">
          <p>Un monde où les formes prennent vie.</p>
          <p>L'imagination se matérialise en œuvres d'art tridimensionnelles.</p>
        </div>
    
        <a href="peinture.php" class="category-link">
        <div class="category">
          <h2>Catégorie peinture</h2>
          <img src="catégorie/peinture art.png" alt="Catégorie peinture" width="300" height="350">
          <p>Des paysages éblouissants et des portraits captivants.</p>
          <p>Un océan de nuances et d'émotions.</p>
          <p>L'expression artistique à travers la peinture.</p>
        </div>
    
        <a href="meuble.php" class="category-link">
        <div class="category">
          <h2>Catégorie meuble</h2>
          <img src="catégorie/meuble.png" alt="Catégorie meuble" width="300" height="350">
          <p>Différents styles et époques.</p>
          <p>Conception artistique et qualité de fabrication.</p>
          <p>Œuvres d'art qui racontent l'histoire à travers les siècles.</p>
        </div>
    
        <a href="costume.php" class="category-link">
        <div class="category">
          <h2>Catégorie costume</h2>
          <img src="catégorie/costume.png" alt="Catégorie costume" width="300" height="350">
          <p>De véritables trésors historiques.</p>
          <p>Ces costumes uniques, soigneusement préservés.</p>
          <p>Des styles emblématiques d'une époque particulière.</p>
        </div>
    
        <a href="poesie.php" class="category-link">
        <div class="category">
          <h2>Catégorie poésie</h2>
          <img src="catégorie/poesie.png" alt="Catégorie poésie" width="300" height="350">
          <p>Profondeur des thèmes intemporels.</p>
          <p>Un espace pour exprimer ces sentiments universels.</p>
          <p>Touchant les cœurs et les esprits des lecteurs depuis des siècles.</p>
        </div>
      </div>
      <?php
     }
     // Sinon redirection vers la page d'accueil
     else{
        header("location:accueil.php");
     }
  ?>
  <p><button><a class="lien" href="accueil.php">Retour</a></button></p>
</body>
</html>

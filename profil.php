<?php
// Démarrage de la session
  session_start();
  // Inclusion de la connexion à la BDD
  include "connect.php";
  // Si la variable de session mail n'existe pas redirection
  if(!isset($_SESSION["mail"])){
      header("location:connexion.php");
  }
  // Sinon 
  else{
      $idu=$_SESSION["idu"];
      // S'il appuie sur le bouton terminer
      if(isset($_POST["bouton"])){
        // On affecte les données du formulaire dans des variables
        $nom = $_POST["nom"];
        $prenom = $_POST["prenom"];
        $ad_postale = $_POST["ad_postale"];
        $pos = strpos($_FILES["avatar"]["name"], ".");
        $extension = substr($_FILES["avatar"]["name"], $pos);
        // Si l'extension existe
        if($extension){
            $avatar = "$nom$extension";
        }
        // Sinon 
        else{
            $avatar=$_SESSION["avatar"];
        }
        // On déplace le fichier dans le dossier avatar
        move_uploaded_file($_FILES["avatar"]["tmp_name"], "avatar/$avatar");
        // On mets à jour les infos dans la BDD
        $req = "UPDATE user SET nom = '$nom', prenom = '$prenom',
        ad_postale = '$ad_postale', avatar = '$avatar'  where idu='$idu'";
        $res= mysqli_query($id,$req);
        // Si la requête est exécutée 
        if($res){
            // On mets à jour les variables de session
            $_SESSION["avatar"]=$avatar;
            $_SESSION["nom"]=$nom;
            $_SESSION["prenom"]=$prenom;
            $_SESSION["ad_postale"]=$ad_postale;
        }
        // Sinon message d'erreur
        else{
            echo "erreur";
        
        }
      }
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body class="body">
    <div class="profil">
    <!-- On affiche les données du user dans un formulaire qu'il peut modifier -->
    <form action="" method="post" enctype="multipart/form-data">
    <p><img class="profil_fot" src='avatar/<?=$_SESSION["avatar"]?>' width='150' height="200"></p>
    <p><a class="lien" >Choisir une nouvelle photo</a></p>
    <p><input type="file" name="avatar"></p>
    <p><input class="sub" type="submit" value="Terminer" name="bouton"></p>
    </div>
    <div class="detail">
        <label for="nom">Nom : </label>
        <p><input type="text" name="nom" id="nom" value='<?=$_SESSION["nom"]?>'> </p>
        <label for="prenom">Prenom : </label>
        <p><input type="text" name="prenom" id="prenom" value='<?=$_SESSION["prenom"]?>'> </p>
        <p>E-mail : <?=$_SESSION["mail"]?></p>
        <label for="ad_postale">Adresse postale : </label>
        <p><input type="text" name="ad_postale" id="ad_postale" value='<?=$_SESSION["ad_postale"]?>'> </p>
        <p><button><a class="lien" href="reinitialisation.php">Modifier mon mot de passe</a></button></p>
        <p><button><a class="lien" href="accueil.php">Retour</a></button></p>
        </div>
        </form>
</body>
</html>
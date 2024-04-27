<?php
  include "connect.php";
  // Si le user appuie sur le bouton s'inscrire
  if(isset($_POST["bouton"])){
    // On affecte les données du formulaire dans des variables
       $nom = $_POST["nom"];
       $prenom = $_POST["prenom"];
       $mail = $_POST["mail"];
       $mdp = $_POST["mdp"];
       $conf_mdp= $_POST["conf_mdp"];
       $h_conf_mdp= md5($conf_mdp);
       $h_mdp= md5($mdp);
       $ad_postale = $_POST["ad_postale"];
       $pos = strpos($_FILES["avatar"]["name"], ".");
       $extension = substr($_FILES["avatar"]["name"], $pos);
       // Si l'extension existe
       if($extension){
          $avatar = "$nom$extension";
       }
       // Sinon image par défaut
       else{
          $avatar="default.jfif";
       }
        move_uploaded_file($_FILES["avatar"]["tmp_name"], "avatar/$avatar");
       // requête pour vérifier s'il existe déjà le mail saisi dans la bdd
       $req="Select * from user where mail= '$mail'";
       $res=mysqli_query($id,$req);
       // S'il n'y a pas de correspondance
       if(mysqli_fetch_assoc($res)==0){
        // si les deux mots de passe entrés sont identiques
       if($h_mdp===$h_conf_mdp){
            // On insère les données du user dans la BDD
            $req1= "insert into user(idu,nom,prenom,mail,mdp,ad_postale,avatar) 
            values(null, '$nom', '$prenom', '$mail', '$h_mdp', '$ad_postale','$avatar')";
            $res1 = mysqli_query($id,$req1);
            // si la requête est exécutée
            if($res){
               $mess="Inscription réussie";
            }
            // Sinon
           else{
               $mess="erreur veuillez réessayer !!!";
            }
       }
       // message d'erreur si les deux mots de passe ne sont pas identiques
       else{
           $mess = "Veuillez saisir un mot de passe identique !!";
       }
    }
    // Si le mail existe déjà dans la BDD
    else{
        $mess= "veuillez choisir un autre mail !!";
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
<body>
    <form class="form_ins" action="" method="post" enctype="multipart/form-data">
    <h1>Inscription</h1>
    <?php
     // Affichage du message de réussite ou d'erreur
      if(isset($mess)){
         echo $mess;
      }
    ?>
        <p><input type="text" name="nom" placeholder="nom*" required></p>
        <p><input type="text" name="prenom" placeholder="prenom*" required></p>
        <p><input type="email" name="mail" placeholder="E-mail*" required></p>
        <p><input type="password" name="mdp" placeholder="mot de passe*" minlength="10" required></p>
        <p><input type="password" name="conf_mdp" minlength="10" placeholder="confirmer mot de passe*" required></p>
        <p><input type="text" name="ad_postale" placeholder="Votre adresse postale*" ></p>
        <label for="avatar">Ajouter un avatar :</label>
        <p><input type="file" name="avatar" id="avatar"></p>
        <p><input type="submit" name = "bouton" value="S'inscrire"></p>
        <p><button><a class="lien" href="accueil.php">Retour</a></button></p>
    </form>
</body>
</html>
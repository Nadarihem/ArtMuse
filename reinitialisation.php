<?php
// Demarrage de la session
session_start();
// On inclut la connexion à la BDD
include "connect.php";
// Si la variable de session existe
   if(isset($_SESSION["mail"])){
       $mail=$_SESSION["mail"];
       //requête pour récupérer les données du user connecté
       $req = "Select * from user where mail = '$mail'";
       $res=mysqli_query($id,$req);
       while($ligne=mysqli_fetch_assoc($res)){
           $idu=$ligne["idu"];
       }
    }
    // Sinon on récupère les données venant de recup
    else{
        $idu=$_SESSION["idu"];
    }
    
    // S'il appuie sur confirmer
    if(isset($_POST["bouton"])){
        // Affectation des données du formulaire
        $mdp= $_POST["mdp"];
        $conf_mdp= $_POST["conf_mdp"];
        $hashed_mdp=md5($mdp);
        $hashed_conf_mdp=md5($conf_mdp);
        // Requête de correspondance du mdp
        $req1="Select * from user where mdp = '$hashed_mdp' and idu = '$idu'";
        $res1=mysqli_query($id,$req1);
        // Si oui il doit choisir un mdp différent
         if(mysqli_fetch_assoc($res1)>0){
             $mess= "Veuillez choisir un autre mot de passe";
         }
         // Si pas de correspondance mise à jour des donées dans la BDD
         else{ 
            if($hashed_mdp===$hashed_conf_mdp){
                 $req2="Update user set mdp= '$hashed_mdp' where idu ='$idu'";
                 $res2=mysqli_query($id,$req2);
                 $mess= "Mot de passe réinitiallisé avec succès";
             }
             // Si les deux saisies ne sont pas identiques
             else{
                 $mess="Veuillez vérifier votre saisie";
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
<body>
<form class="rei" action="" method="post">
    <h1>Réinitialisation de votre mot de passe </h1><hr>
    <?php
      // Affichage du message correspondant
       if(isset($mess)){
          echo $mess."<br> <br> <br>";
       }
    ?>
    <label for="mdp">Entrez votre nouveau mot de passe</label>
    <p><input type="password" name="mdp" id="mdp" minlength="10" placeholder="mot de passe*"></p>
    <label for="conf_mdp">Confirmer votre mot de passe</label>
    <p><input type="password" name="conf_mdp" id="conf_mdp" minlength="10" placeholder="mot de passe*" required></p>
    <p><input type="submit" value="Confirmer" name="bouton"></p>
    <p><button><a class="lien" href="profil.php">Retour</a></button></p>
</form>
</body>
</html>
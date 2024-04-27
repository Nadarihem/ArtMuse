<?php
   // On inclu la connexion à la BDD
   include "connect.php";
   // S'il appuie sur le bouton se connecter
   if(isset($_POST["bouton"])){
     // Affectation des données dans des variables 
       $mail = $_POST["mail"];
       $mdp=$_POST["mdp"];
       $h_mdp=md5($mdp);
       // Requête pour vérifier s'il existe un user avec ce mail et mdp
       $req="Select * from user where mail= '$mail' and mdp= '$h_mdp'";
       $res= mysqli_query($id,$req);
       $ligne=mysqli_fetch_assoc($res);
       // S'il existe dans la bdd
       if($ligne>0){
           $etat=$ligne["etat"];
           $idu=$ligne["idu"];
           $nom = $ligne["nom"];
           $prenom=$ligne["prenom"];
           $avatar=$ligne["avatar"];
           $adresse=$ligne["ad_postale"];
           // Si le compte n'est pas validé
           if($etat==0){
              $mess= "Désolé votre compte n'est pas valide pour l'instant";
           }
           // Sinon démarrage de la session, création des variables de session
           // ET redirection vers l'accueil
           else{
              session_start();
              $_SESSION["mail"]=$mail;
              $_SESSION["idu"]=$idu;
              $_SESSION["nom"]=$nom;
              $_SESSION["prenom"]=$prenom;
              $_SESSION["avatar"]=$avatar;
              $_SESSION["ad_postale"]=$adresse;
              $mess="Connexion réussie...";
              header("refresh:3 url=accueil.php");
           }
       }
       // S'il n'y a pas de correspondance dans la BDD
       else{
           $mess= "Erreur de mail ou mot de passe";
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
<body >
    <form class="form_connect" action="" method="post">
        <h1>Connexion</h1>
        <?php
          // Affichage du message
           if(isset($mess)){
               echo $mess;
           }
        ?>
        <p><input type="email" name="mail" placeholder="E-mail*"></p>
        <p><input type="password" name="mdp" placeholder="Votre mot de passe*" ></p>
        <p><a href="recup.php">Mot de passe oublié ?</a></p>
        <p><input type="submit" name="bouton" value="Se connecter"></p>
        <p><button><a class="lien" href="accueil.php">Retour</a></button></p>
    </form>
</body>
</html>
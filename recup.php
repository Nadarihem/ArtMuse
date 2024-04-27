<?php
// S'il appuie sur mot de passe oublié
//Donc pas de variable de session
// Démarrage de la session
 session_start();
 // On inclut la connexion à la BDD
 include "connect.php";
// S'il appuie sur Confirmer
   if(isset($_POST["bouton"])){
    // Affectation des données dans des variables
    $mail=$_POST["mail"];
    // requête pour récupérer les données de user dans la BDD
    $req = "Select * from user where mail = '$mail'";
    $res=mysqli_query($id,$req);
    while($ligne=mysqli_fetch_assoc($res)){
    // On crée une variable de session avec l'id du user
    $_SESSION["idu"]=$ligne["idu"];
}
   // Redirection vers la page de reinitialisation
    header("refresh:3 url=reinitialisation.php");


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
<form class="recup" action="" method="post">
    <p>Entrez votre mail pour réinitialiser votre mot de passe :</p>
    <p><input type="email" name="mail" placeholder="mail*" required></p>
    <p><input type="submit" value="Confirmer" name="bouton"></p>
    <p><button><a class="lien" href="connexion.php">Retour</a></button></p>
</form>
       
</body>
</html>
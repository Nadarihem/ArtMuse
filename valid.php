<?php
// Démarrage de la session
  session_start();
  // Inclusion de la connexion à la BDD
  include "connect.php";
  if(isset($_GET["idu"]) && $_SESSION["mail"]==="root@gmail.com"){
       // On récupère l'id du user dont on veut valider le compte
       $idu = $_GET["idu"];
       // On fait une mise à jour dans la BDD
       $req = "UPDATE user SET etat = 1 where idu = '$idu'";
       $result = mysqli_query($id, $req);
     // Si la reqêute est exécutée
       if ($result) {
           echo "Le compte utilisateur a été validé avec succès.";
           // Redirection sur détail
           header("refresh:3 url=détail.php");
       } 
       // Sinon message d'erreur
       else {
           echo "Une erreur s'est produite lors de la validation du compte utilisateur.";
       }
  }
  else{
      header("location:accueil.php"); // On change après maybe
  } 

?>


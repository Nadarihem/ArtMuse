<?php
// Démarrage de la session
session_start();
 // Inclusion de la connexion à la BDD
include "connect.php";
if(isset($_GET["idu"]) && $_SESSION["mail"]==="root@gmail.com"){
     // On récupère l'id du user dont on veut radier le compte
    $idu = $_GET["idu"]; 
    // On supprime le user de la BDD
    $req = "DELETE FROM user WHERE idu = '$idu'";
    $result = mysqli_query($id, $req);
    //Affichage du message correspondant
    if ($result) 
    {
        echo "Le compte utilisateur a été radié avec succès.";
    } 
    else 
    {
        echo "Une erreur s'est produite lors de la radiation du compte utilisateur.";
    }
}
else{
    header("location:accueil.php"); // On verra où après
}

  

?>    
<?php
// Démarrage de la session
session_start();
// Inclusion de la connexion à la BDD
include "connect.php";
// Si c'est l'admin qui est connecté
if($_SESSION["mail"]==="root@gmail.com"){
    // On récupère l'id du user 
   $idu=$_GET["idu"];
   // On récupère toutes ses données dans la BDD
   $req="Select * from user where idu = '$idu'";
   $res=mysqli_query($id,$req);
}
// Sinon redirection vers la page de connexion (pour l'instant)
else{
    header("location:connexion.php");
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
    <?php
      // On affecte les données dans des variables
       while($ligne=mysqli_fetch_assoc($res)){
           $nom = $ligne["nom"];
           $prenom = $ligne["prenom"];
           $mail = $ligne["mail"];
           $adresse = $ligne["ad_postale"];
           $avatar = $ligne["avatar"];
           $_SESSION["avatar"] = $avatar;
           $etat=$ligne["etat"];


           ?>
           <!-- On affiche les données -->
           <div class="det_fot">
           <p><img  src='avatar/<?=$avatar?>' width='200'></p><br><br>
           <p><button><a class="lien" href="gestionComptes.php">Retour</a></button></p>
           </div>
           <div class="detail">
           <p>Nom : <?=$nom?></p>
           <p>Preom : <?=$prenom?></p>
           <p>E-mail : <?=$mail?></p>
           <p>Adresse Postale : <?=$adresse?></p>
           <?php
           // Si le compte n'est pas validé 
           if($etat==0){           
           ?>
           <!-- Affichage du bouton de validation -->
           <p><a class="valid" href='valid.php?idu=<?=$idu?>'>Valider le compte</a></p>
           <?php
        }
        ?>
        <!-- Affichage du bouton de radiation avec message de confirmation -->
           <p><a onclick="return confirm('Êtes vous sûr de vouloir radier ce compte ? ')"class="rad" 
           href='radiation.php?idu=<?=$idu?>'>Radier le compte</a></p>
           </div>
           <?php
       }
    ?>
    
</body>
</html>
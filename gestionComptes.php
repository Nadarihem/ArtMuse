<?php
// Démarrage de la session
   session_start();
   // Inclusion de la connexion à la BDD
   include "connect.php";
   // Si c'est l'admin qui est connecté
   if($_SESSION["mail"]==="root@gmail.com"){
      // Requête pour récupérer toutes les données dans user
        $req= "SELECT * FROM user" ;
        $res= mysqli_query($id, $req);
   }
   // Sinon redirection automatique vers l'accueil
   else{
      header("location:accueil.php");
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

<h2 class="gest">Gestion des comptes users</h2><hr>
<table>
<tr>
    <th>Nom</th><th>Prenom</th>
    <th>Photo</th><th>Détails</th>
</tr>

     <?php
     // Affichage de tous les users et de leurs infos
        while($ligne=mysqli_fetch_assoc($res)){
            $idu=$ligne["idu"];
            $nom = $ligne["nom"];
            $prenom = $ligne["prenom"];
            $mail = $ligne["mail"];
            $nom = $ligne["nom"];
            $adresse = $ligne["ad_postale"];
            $avatar=$ligne["avatar"];
            if($nom !== "Admin"){
                ?>
                    <tr>
                        <td><?=$nom?></td>
                        <td><?=$prenom?></td>
                        <td><img src='avatar/<?=$ligne["avatar"]?>' width='50'></td>
                        <!-- Pour plus de détails -->
                        <td><a class="lien"  href='détail.php?idu=<?=$idu?>'>plus...</a></td>
                    </tr>
                <?php
            }
        }
     ?>
    
</body>
</table>
<p><button><a class="lien" href="accueil.php">Retour</a></button></p>
</html>
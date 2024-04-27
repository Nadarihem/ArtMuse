<?php
// Démarrage de la session
session_start();
if(isset($_SESSION["mail"])){
  $idu= $_SESSION["idu"];
     // Inclusion du fichier de connexion à la base de données
include 'connect.php';

// Vérification si l'identifiant de l'œuvre est passé en paramètre
if (isset($_POST['ido'])) {
  $ido = $_POST['ido'];

  // Requête pour vérifier s'il a déjà liké l'oeuvre
  $req1= "Select * From aime where ido = '$ido' and idu='$idu'";
  $res1=mysqli_query($id,$req1);
  $ligne=mysqli_fetch_assoc($res1);
  if($ligne>0){
    echo "Vous avez déjà liké cette oeuvre !!";
  }
  else{
     // On ajoute les infos dans la table aime 
     $req2= "insert into aime(idl,ido,idu) values(null,'$ido','$idu')";
     $res2= mysqli_query($id,$req2);
      // Requête pour incrémenter le nombre de likes de l'œuvre
      $query = "UPDATE oeuvre SET nb_like = nb_like + 1 WHERE ido = $ido";
      $result = mysqli_query($id, $query);

       if ($result) {
         // Redirection vers la page détail de l'œuvre après avoir incrémenté le nombre de likes
          header("Location: oeuvre.php?ido=$ido");
          exit();
        } 
        else {
           echo 'Une erreur s\'est produite lors de l\'ajout du like.';
         }
    }   // Fermeture de la connexion à la base de données
        mysqli_close($id);
}
else {
  echo 'Identifiant de l\'œuvre non spécifié.';
}

  }
  else{
    header("location:accueil.php");
 }
 

 
?>



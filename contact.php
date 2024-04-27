<?php
// Demarrage de la session
   session_start();
   // si le user est connecté
   if(isset($_SESSION["mail"])){
    // Inclusion de la connexion à la BDD
       include "connect.php";
       // S'il appuie sur envoyer
       if(isset($_POST["bouton"])){
        // Affectation des données dans des variables
          $sujet=$_POST["sujet"];
          $message=$_POST["message"];

          // Insertion dans la BDD
          $req= "Insert into messages(idm,sujet,message)
           values(null, '$sujet', '$message')";
          $res= mysqli_query($id,$req);

          //Si la requête est exécutée message de réussite
          if($res){
              $mess = "Mail envoyé avec succès !!";
          }
          // Sinon message d'erreur
          else{
             $mess="Erreur lors de l'envoie du mail !!";
          }

       }

   }
   // Sinon redirection vers l'accueil
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
<body>
    <form class="form_contact" action="" method="post">
        <h2>Nous envoyer un mail : </h2><br>
        <?php
         // Affichage du message erreur/réussite
           if(isset($mess)){
               echo $mess;
           }
        ?>
        <p><label for="sujet">Entrez le sujet de votre mail : </label></p>
        <p><input type="text" name="sujet" id="sujet" required></p>
        <label for="mess">Saisissez votre message :</label>
        <p><textarea name="message" id="mess" cols="30" rows="10" required></textarea></p>
        <p><input type="submit" value="Envoyer" name="bouton"></p><br>
        <p>Nous contacter : </p>
        <p>Tel : 061236567</p>
        <p>Adresse postale : 37, Quai de Grennelle. </p><br>
        <p> <p><button><a class="lien" href="accueil.php">Retour</a></button></p></p>
    </form>
    
</body>
</html>
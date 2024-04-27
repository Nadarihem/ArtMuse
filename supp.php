<?php
// Démarrage de la session
session_start();
// Si c'est l'admin qui est connecté
if(isset($_SESSION["mail"]) && $_SESSION["mail"] === "root@gmail.com") {
    // Inclusion de la connexion à la BDD
    include "connect.php";

    // Vérification si l'identifiant de l'œuvre à supprimer est fourni
    if(isset($_GET["ido"])) {
        $ido = $_GET["ido"];

        // Requête pour supprimer l'œuvre de la table
        $query = "DELETE FROM oeuvre WHERE ido = $ido";
        $result = mysqli_query($id, $query);

        if($result) {
            // Suppression réussie
            echo "L'œuvre a été supprimée avec succès.";
        } else {
            // Erreur lors de la suppression
            echo "Une erreur s'est produite lors de la suppression de l'œuvre.";
        }

        // Redirection vers la liste des œuvres après la suppression
        header("Location: listeoeuvre.php");
        exit();
    } else {
        // Identifiant de l'œuvre non fourni
        echo "Identifiant de l'œuvre non fourni.";
    }

    // Fermeture de la connexion à la base de données
    mysqli_close($id);
} else {
    header("location:accueil.php");
}
?>
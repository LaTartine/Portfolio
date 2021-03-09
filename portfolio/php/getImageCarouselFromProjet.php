<?php
header("Access-Control-Allow-Origin: *");

require_once 'cnx.php';
require_once 'classes/class.ImageCarousel.php';


if(isset($_POST["id"])){
    $_GET["id"] = $_POST["id"];
}else{
    if(isset($_GET["id"])){
        $_POST["id"] = $_GET["id"];
    }
}

// Si le paramètre id existe
if(isset($_POST["id"])){
    $sql = "SELECT * 
                    FROM ImageCarousel, Projet, ProjetContientImage                     
                    WHERE Projet.ID_Projet = ? 
                    AND ImageCarousel.ID_ImageCarousel = ProjetContientImage.ID_ImageCarousel
                    AND Projet.ID_Projet = ProjetContientImage.ID_Projet
               ";
    $requete = $pdo->prepare($sql);
    $requete->bindValue(1, $_POST["id"]);
    $ListeProjet = array();
    if ($requete->execute()) {
        //echo "Start fetching for id : ".$_POST["id"];
        while ($donnees = $requete->fetch()) {
            $ListeProjet[] = new ImageCarousel(
                $donnees['ID_ImageCarousel'],
                $donnees['IMAGE_ImageCarousel'],
                $donnees['DESCRIPTION_ImageCarousel']
            );
        }
    }
    echo json_encode($ListeProjet);
}else{
    // Si pas de id, on retourne -1
    echo -1;
}
?>
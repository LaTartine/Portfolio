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

    //Supprimer les images du carousel

    //Trouver les liens des images liées
    $sql = "SELECT *
        FROM ImageCarousel, Projet, ProjetContientImage                     
        WHERE Projet.ID_Projet = ? 
        AND ImageCarousel.ID_ImageCarousel = ProjetContientImage.ID_ImageCarousel
        AND Projet.ID_Projet = ProjetContientImage.ID_Projet";
    $requete = $pdo->prepare($sql);
    $requete->bindValue(1, $_POST["id"]);
    $ListeImages = array();
    if ($requete->execute()) {
        while ($donnees = $requete->fetch()) {
            $ListeImages[] = new ImageCarousel(
                $donnees['ID_ImageCarousel'],
                $donnees['IMAGE_ImageCarousel'],
                $donnees['DESCRIPTION_ImageCarousel']
            );
        }

        //supprimer les fichiers
        foreach ( $ListeImages as $imageNom )
        {
            unlink("carousel/" . $imageNom->getImage());
        }

        //supprimer les liens
        foreach ( $ListeImages as $imageNom )
        {
            $sql = "DELETE FROM ProjetContientImage
                    WHERE ID_ImageCarousel = ?
                    ";
            $requete = $pdo->prepare($sql);
            $requete->bindValue(1, $imageNom->getId());
            echo $requete->execute();
        }

        //Supprimer les images Carousel
        foreach ( $ListeImages as $imageNom )
        {
            $sql = "DELETE FROM ImageCarousel
                    WHERE ID_ImageCarousel = ?
                    ";
            $requete = $pdo->prepare($sql);
            $requete->bindValue(1, $imageNom->getId());
            echo $requete->execute();
        }

    }

    //Supprimer la miniature
    $sql = "SELECT MINIATURE_Projet 
                    FROM Projet                     
                    WHERE ID_Projet = ? 
               ";
    $requete = $pdo->prepare($sql);
    $requete->bindValue(1, $_POST["id"]);
    $nomMiniature = null;
    if ($requete->execute()) {
        //echo "Start fetching for id : ".$_POST["id"];
        while ($donnees = $requete->fetch()) {
            $nomMiniature = $donnees['MINIATURE_Projet'];
        }
        unlink("miniatureImages/" . $nomMiniature);
    }

    //Supprimer le projet
    $sql = "DELETE FROM Projet
            WHERE ID_Projet = ?
            ";
    $requete = $pdo->prepare($sql);
    $requete->bindValue(1, $_POST["id"]);
    echo $requete->execute();

}else{
    // Si pas de id, on retourne -1
    echo -1;
}
?>
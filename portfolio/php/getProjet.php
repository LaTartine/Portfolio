<?php
header("Access-Control-Allow-Origin: *");

require_once 'cnx.php';
require_once 'classes/class.Projet.php';
require_once 'classes/class.ProjetCarousel.php';
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
                    FROM Projet                     
                    WHERE ID_Projet = ? 
               ";
    $requete = $pdo->prepare($sql);
    $requete->bindValue(1, $_POST["id"]);
    $projet = null;
    if ($requete->execute()) {
        //echo "Start fetching for id : ".$_POST["id"];
        while ($donnees = $requete->fetch()) {
            $projet = new ProjetCarousel(
                $donnees['ID_Projet'],
                $donnees['NOM_Projet'],
                $donnees['DESCRIPTION_Projet'],
                $parametres['host']."miniatureImages/".$donnees['MINIATURE_Projet'],
                $donnees['DATE_Projet'],
                $donnees['CONTEXTE_Projet'],
                $donnees['COLLABORATION_Projet'],
                $donnees['IDVIDEO_Projet'],
                $donnees['ID_TYPE'],
                $donnees['URL_Projet'],
                $donnees['ADDJSON_Projet']
            );

            //echo $donnees['NOM_Projet'];

            // TYPE
            $sql = "SELECT * FROM Projet, TypeProjet
                    WHERE ID_Projet = ? AND Projet.ID_Type = TypeProjet.ID_Type";
            $requete2 = $pdo->prepare($sql);
            $requete2->bindValue(1, $_POST["id"]);
            $real = null;
            // Si la requête renvoie quelque chose
            if ($requete2->execute()) {
                // Parcours des résultats
                while ($donnees2 = $requete2->fetch()) {
                    $real = $donnees2['NOM_Type'];
                }
            }
            $projet->setType($real);

            // Liste d'image du carousel
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
                        $parametres['host']."carousel/".$donnees['IMAGE_ImageCarousel'],
                        $donnees['DESCRIPTION_ImageCarousel']
                    );
                }
                $projet->setImagesCarousel($ListeProjet);
            }

        }
    }
    echo json_encode($projet);
}else{
    // Si pas de id, on retourne -1
    echo -1;
}
?>
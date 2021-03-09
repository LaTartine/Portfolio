<?php
header("Access-Control-Allow-Origin: *");

require_once 'cnx.php';

if(isset($_POST["id"])){
    $_GET["id"] = $_POST["id"];
}else{
    if(isset($_GET["id"])){
        $_POST["id"] = $_GET["id"];
    }
}

// Si le paramètre id existe
if(isset($_POST["id"])){
    $sql = "UPDATE Projet 
                    SET 
                    NOM_Projet = ?,                     
                    DESCRIPTION_Projet = ?,                     
                    DATE_Projet = ?,                     
                    CONTEXTE_Projet = ?,                     
                    COLLABORATION_Projet = ?,                     
                    IDVIDEO_Projet = ?,                     
                    ID_TYPE = ?,                     
                    URL_Projet = ?,                     
                    ADDJSON_Projet = ?                     
                    WHERE ID_Projet = ? 
               ";
    $requete = $pdo->prepare($sql);
    $requete->bindValue(1, $_POST["nom"]);
    $requete->bindValue(2, $_POST["description"]);
    $requete->bindValue(3, $_POST["date"]);
    $requete->bindValue(4, $_POST["contexte"]);
    $requete->bindValue(5, $_POST["collaboration"]);
    $requete->bindValue(6, $_POST["idVideo"]);
    $requete->bindValue(7, $_POST["type"]);
    $requete->bindValue(8, $_POST["url"]);
    $requete->bindValue(9, null);
    $requete->bindValue(10, $_POST["id"]);

    echo $requete->execute();

    //Gerer la miniature
    if( $_POST["updateMiniature"] == "true" )
    {

        //Trouver le nom du fichier
        $sql2 = "SELECT MINIATURE_Projet 
                    FROM Projet                     
                    WHERE Projet.ID_Projet = ? 
               ";
        $requete2 = $pdo->prepare($sql2);
        $requete2->bindValue(1, $_POST["id"]);
        $resultatNomMiniature = null;
        if ($requete2->execute()) {
            //echo "Start fetching for id : ".$_POST["id"];
            while ($donnees = $requete2->fetch()) {
                $resultatNomMiniature = $donnees["MINIATURE_Projet"];
            }
            echo 1;
        }
        else{
            echo 0;
        }

        //Supprimer l'ancien fichier sur le serveur
        unlink("miniatureImages/" . $resultatNomMiniature);

        //Télécharger la nouvelle miniature
        if( $_FILES['miniature']['name'] ) {
            // File name
            $filename = $_FILES['miniature']['name'];

            // Valid file extensions
            $valid_extensions = array("jpg", "jpeg", "png");

            // File extension
            $extension = pathinfo($filename, PATHINFO_EXTENSION);

            //Miniature nom
            //create name for file
            $serverName = date("Y-m-d_H-i-s");
            $nomMiniature = $serverName . "_min." . $extension;

            // Check extension
            if (in_array(strtolower($extension), $valid_extensions)) {

                // Upload file
                if (move_uploaded_file($_FILES['miniature']['tmp_name'], "miniatureImages/" . $nomMiniature)) {
                    echo 1;
                } else {
                    echo -1;
                }
            } else {
                echo 0;
            }
        }

        //Enregistrer le nom de la miniature dans la bdd
        $sql = "UPDATE Projet 
                    SET 
                    MINIATURE_Projet = ?                                         
                    WHERE ID_Projet = ? 
               ";
        $requete = $pdo->prepare($sql);
        $requete->bindValue(1, $nomMiniature);
        $requete->bindValue(2, $_POST["id"]);

        echo $requete->execute();

    }

    //Gérer la mise en ligne de nouvelles images pour le carousel
    $serverName = date("Y-m-d_H-i-s");

    // Valid file extensions
    $valid_extensions = array("jpg", "jpeg", "png");

    if ($_FILES['imagesCarousel']['name'][0]) {
        foreach ($_FILES['imagesCarousel']['name'] as $f => $name) {

            if ($_FILES['imagesCarousel']['error'][$f] == 0) {
                if (!in_array(pathinfo($name, PATHINFO_EXTENSION), $valid_extensions)) {
                    $message[] = "$name is not a valid format";
                    continue; // Skip invalid file formats
                } else { // No error found! Move uploaded files
                    $nomCarousel2 = $serverName.$name."_car.".pathinfo($name, PATHINFO_EXTENSION);

                    if (move_uploaded_file($_FILES["imagesCarousel"]["tmp_name"][$f], "carousel/" . $nomCarousel2)) {
                    }

                    $sql = "INSERT INTO ImageCarousel(ID_ImageCarousel, IMAGE_ImageCarousel, DESCRIPTION_ImageCarousel) "
                        . " VALUES(?, ?, ?)";

                    $requete = $pdo->prepare($sql);
                    $requete->bindValue(1, null);
                    $requete->bindValue(2, $nomCarousel2);
                    $requete->bindValue(3, null);
                    echo $requete->execute();

                    //Créer le lien entre les images du carousel de la bdd au projet

                    // réponse de la requête
                    $idProjetResp = $_POST["id"];
                    $idImgCarouselResp = null;

                    //récupérer l'ID de l'image
                    $sql2 = "SELECT ID_ImageCarousel
                    FROM ImageCarousel
                    WHERE 
                    IMAGE_ImageCarousel = ?";
                    $requete3 = $pdo->prepare($sql2);
                    $requete3->bindValue(1, $nomCarousel2);

                    // Si la requête renvoie quelque chose
                    if ($requete3->execute()) {
                        // Parcours des résultats
                        while ($donnees3 = $requete3->fetch()) {
                            $idImgCarouselResp = $donnees3['ID_ImageCarousel'];
                        }
                    }

                    $sql = "INSERT INTO ProjetContientImage(ID_Projet, ID_ImageCarousel) "
                        . " VALUES(?, ?)";

                    $requete = $pdo->prepare($sql);
                    $requete->bindValue(1, $idProjetResp);
                    $requete->bindValue(2, $idImgCarouselResp);
                    echo $requete->execute();
                }
            }
        }
    }


}else{
    // Si pas de id, on retourne -1
    echo -1;
}
?>
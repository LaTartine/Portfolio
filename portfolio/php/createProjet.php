<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

require_once 'cnx.php';

if (isset($_POST['nom'])) {

    //Miniature

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
                echo 0;
            }
        } else {
            echo 0;
        }
    }

    //Enregistrer le projet dans la base de donnée

    $sql = "INSERT INTO Projet(ID_Projet, NOM_Projet, DESCRIPTION_Projet, MINIATURE_Projet, DATE_Projet, CONTEXTE_Projet, COLLABORATION_Projet, ADDJSON_Projet, IDVIDEO_Projet, URL_Projet, ID_Type) "
        . " VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

    $requete = $pdo->prepare($sql);
    $requete->bindValue(1, null);
    $requete->bindValue(2, $_POST["nom"]);
    $requete->bindValue(3, $_POST["description"]);
    $requete->bindValue(4, $nomMiniature);
    $requete->bindValue(5, $_POST["date"]);
    $requete->bindValue(6, $_POST["contexte"]);
    $requete->bindValue(7, $_POST["collaboration"]);
    $requete->bindValue(8, null);
    $requete->bindValue(9, $_POST["idVideo"]);
    $requete->bindValue(10, $_POST["url"]);
    $requete->bindValue(11, $_POST["type"]);
    echo $requete->execute();

    //Carousel récupérer la requette, mettre les images sur le serveur, enregistrer le nom dans la bdd

    if ($_FILES['imagesCarousel']['name'][0]) {
        foreach ($_FILES['imagesCarousel']['name'] as $f => $name) {

            if ($_FILES['imagesCarousel']['error'][$f] == 0) {
                if (!in_array(pathinfo($name, PATHINFO_EXTENSION), $valid_extensions)) {
                    $message[] = "$name is not a valid format";
                    continue; // Skip invalid file formats
                } else { // No error found! Move uploaded files
                    $nomCarousel = $serverName . $name . "_car." . pathinfo($name, PATHINFO_EXTENSION);
                    if (move_uploaded_file($_FILES["imagesCarousel"]["tmp_name"][$f], "carousel/" . $nomCarousel)) {
                    }
                    //Write insert query here. image name $_FILES["image1"]["name"][$f]
                    $sql = "INSERT INTO ImageCarousel(ID_ImageCarousel, IMAGE_ImageCarousel, DESCRIPTION_ImageCarousel) "
                        . " VALUES(?, ?, ?)";

                    $requete = $pdo->prepare($sql);
                    $requete->bindValue(1, null);
                    $requete->bindValue(2, $nomCarousel);
                    $requete->bindValue(3, null);
                    echo $requete->execute();

                    //Créer le lien entre les images du carousel de la bdd au projet

                    // réponse de la requête
                    $idProjetResp = null;
                    $idImgCarouselResp = null;

                    //Récupérer l'ID du projet
                    $sql1 = "SELECT ID_Projet
                FROM Projet
                WHERE 
                NOM_Projet = ? 
                AND DATE_Projet = ?";
                    $requete2 = $pdo->prepare($sql1);
                    $requete2->bindValue(1, $_POST["nom"]);
                    $requete2->bindValue(2, $_POST["date"]);

                    // Si la requête renvoie quelque chose
                    if ($requete2->execute()) {
                        // Parcours des résultats
                        while ($donnees2 = $requete2->fetch()) {
                            $idProjetResp = $donnees2['ID_Projet'];
                        }
                    }

                    //récupérer l'ID de l'image
                    $sql2 = "SELECT ID_ImageCarousel
                FROM ImageCarousel
                WHERE 
                IMAGE_ImageCarousel = ?";
                    $requete3 = $pdo->prepare($sql2);
                    $requete3->bindValue(1, $nomCarousel);

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


} else {
    print_r("erreur");
    echo "Non conforme";
}

?>
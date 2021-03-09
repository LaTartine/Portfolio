<?php
header("Access-Control-Allow-Origin: *");

require_once 'cnx.php';

if(isset($_POST["imagesCarousel"])){
    $_GET["imagesCarousel"] = $_POST["imagesCarousel"];
}else{
    if(isset($_GET["imagesCarousel"])){
        $_POST["imagesCarousel"] = $_GET["imagesCarousel"];
    }
}

// Si le paramètre imagesCarousel existe
if(isset($_POST["imagesCarousel"])){

    //itérer à traver le tableau
    foreach ($_POST['imagesCarousel'] as $f => $value) {

        if ($_POST['imagesCarousel'][$f] != "") {

            //supprimer le fichier sur le serveur
            unlink("carousel/" . $_POST['imagesCarousel'][$f]);

            //Trouver l'id lié à l'image dans la bdd
            $idImageCarousel = null;

            $sql = "SELECT ID_ImageCarousel FROM ImageCarousel
                    WHERE IMAGE_ImageCarousel = ?
                    ";
            $requete = $pdo->prepare($sql);
            $requete->bindValue(1, $_POST['imagesCarousel'][$f]);
            if ($requete->execute()) {
                while ($donnees = $requete->fetch()) {
                    $idImageCarousel = $donnees["ID_ImageCarousel"];
                }
                echo 1;
            }
            else{
                echo 0;
            }

            //suprimer le lien entre ImageCarousel et Projet, soit : ProjetContientImage
            $sql = "DELETE FROM ProjetContientImage
                    WHERE ID_ImageCarousel = ?
                    ";
            $requete = $pdo->prepare($sql);
            $requete->bindValue(1, $idImageCarousel);
            echo $requete->execute();

            //supprimer ImageCarousel dans la BDD
            $sql = "DELETE FROM ImageCarousel
                    WHERE ID_ImageCarousel = ?
                    ";
            $requete = $pdo->prepare($sql);
            $requete->bindValue(1, $idImageCarousel);
            echo $requete->execute();
        }
    }

}else{
    // Si pas de id, on retourne -1
    echo -1;
}
?>
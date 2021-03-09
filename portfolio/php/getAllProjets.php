<?php
header("Access-Control-Allow-Origin: *");

require_once 'cnx.php';
require_once 'classes/class.Projet.php';
require_once 'classes/class.ProjetCarousel.php';
require_once 'classes/class.ImageCarousel.php';



// Si le paramètre id existe

    $sql = "SELECT * FROM Projet";
    $requete = $pdo->prepare($sql);
    $projets = null;

    if ($requete->execute()) {

        $i = 0;
        while ($donnees = $requete->fetch()) {
            $projet[] = new ProjetCarousel(
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

            $projetID = $donnees['ID_Projet'];


            // TYPE
            $sql = "SELECT * FROM Projet, TypeProjet
                    WHERE ID_Projet = ? AND Projet.ID_Type = TypeProjet.ID_Type";
            $requete2 = $pdo->prepare($sql);
            $requete2->bindValue(1, $projetID);
            $real = null;
            // Si la requête renvoie quelque chose
            if ($requete2->execute()) {
                // Parcours des résultats
                while ($donnees2 = $requete2->fetch()) {
                    $real = $donnees2['NOM_Type'];
                }
            }
            $projet[$i]->setType($real);

            // Liste d'image du carousel
            $sql = "SELECT * 
                FROM ImageCarousel, ProjetContientImage, TypeProjet
                WHERE 
                ID_Projet = ? 
                AND ImageCarousel.ID_ImageCarousel = ProjetContientImage.ID_ImageCarousel";
            $requete2 = $pdo->prepare($sql);
            $requete2->bindValue(1, $projetID);
            // Tableau qui contiendra la liste des realisateurs
            $listeReal = array();
            // Si la requête renvoie quelque chose
            if ($requete2->execute()) {
                // Parcours des résultats
                while ($donnees2 = $requete2->fetch()) {

                    $real = new ImageCarousel(
                        $donnees2['ID_ImageCarousel'],
                        $parametres['host']."carousel/".$donnees2['IMAGE_ImageCarousel'],
                        $donnees2['DESCRIPTION_ImageCarousel']
                    );
                    // Ajout du réalisateur au tableau
                    $listeReal[] = $real;
                }
                // Ajout des realisateurs à la vidéo
                $projet[$i]->setImagesCarousel($listeReal);
            }

            $i++;
        }
    }
    echo json_encode($projet);

?>
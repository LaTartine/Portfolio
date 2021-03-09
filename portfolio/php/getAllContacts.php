<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

require_once 'cnx.php';
require_once 'classes/class.Contact.php';


if(isset($_POST["key"])){
    $_GET["key"] = $_POST["key"];
}else{
    if(isset($_GET["key"])){
        $_POST["key"] = $_GET["key"];
    }
}

if (isset($_POST['key'])) {


    if( $_POST['key'] == "getAllContacttcAtnocllateg_-?!.") {

        $sql = "SELECT * FROM Contact";
        $requete = $pdo->prepare($sql);
        $listeReal = array();
        if ($requete->execute()) {
            // Parcours des résultats
            while ($donnees2 = $requete->fetch()) {

                $real = new Contact(
                    $donnees2['ID_Contact'],
                    $donnees2['NOM_Contact'],
                    $donnees2['PRENOM_Contact'],
                    $donnees2['MAIL_Contact'],
                    $donnees2['MESSAGE_Contact'],
                    $donnees2['DATE_Contact']
                );
                // Ajout du réalisateur au tableau
                $listeReal[] = $real;
            }
        }
        echo json_encode($listeReal);
    }


} else {
    print_r("erreur");

    echo "Accès refusé";
}

?>
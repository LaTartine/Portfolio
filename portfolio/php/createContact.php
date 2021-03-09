<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: *");

require_once 'cnx.php';

if (isset($_POST['message'])) {

    //Enregistrer le projet dans la base de donnée

    $sql = "INSERT INTO Contact(ID_Contact, MAIL_Contact, NOM_Contact, PRENOM_Contact, MESSAGE_Contact, DATE_Contact) "
        . " VALUES(?, ?, ?, ?, ?, ?)";

    $requete = $pdo->prepare($sql);
    $requete->bindValue(1, null);
    $requete->bindValue(2, $_POST["mail"]);
    $requete->bindValue(3, $_POST["nom"]);
    $requete->bindValue(4, $_POST["prenom"]);
    $requete->bindValue(5, $_POST["message"]);
    $requete->bindValue(6, $_POST["date"]);

    echo $requete->execute();

} else {
    print_r("erreur");

    echo "Non conforme";
}

?>
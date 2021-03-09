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

if(isset($_POST["id"])){

    $sql = "DELETE FROM Contact WHERE ID_Contact = ?";
    $requete = $pdo->prepare($sql);
    $requete->bindValue(1, $_POST["id"]);
    echo $requete->execute();

}else{
    // Si pas de id, on retourne -1
    echo -1;
}
?>
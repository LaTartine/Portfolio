<?php
require_once('class.Projet.php');

class ProjetCarousel extends Projet implements JsonSerializable{

    private $ImagesCarousel = array();
    private $projet = null;

    public function __construct($id=0, $nom=null, $description=null, $miniature=null, $date=null, $contexte=null, $collaboration=null, $idVideo=null, $type=null, $url=null, $addJSON=null) {
        parent::__construct($id, $nom, $description, $miniature, $date, $contexte, $collaboration, $idVideo, $type, $url, $addJSON);
    }

    /**
     * @return array
     */
    public function getImagesCarousel()
    {
        return $this->ImagesCarousel;
    }

    /**
     * @param array $ImagesCarousel
     */
    public function setImagesCarousel($ImagesCarousel)
    {
        $this->ImagesCarousel = $ImagesCarousel;
    }

    public function jsonSerialize(){
        $this->projet = parent::jsonSerialize($this);
        return get_object_vars($this);
    }
}
?>
<?php

class Projet implements JsonSerializable{

    private $id=0;
    private $nom=null;
    private $description=null;
    private $miniature=null;
    private $date=null;
    private $contexte=null;
    private $collaboration=null;
    private $addJSON=null;
    private $idVideo=null;
    private $type=null;
    private $url=null;
   
   public function __construct($id=0, $nom=null, $description=null, $miniature=null, $date=null, $contexte=null, $collaboration=null, $idVideo=null, $type=null, $url=null, $addJSON=null) {
        $this->id=$id;
        $this->nom=$nom;
        $this->description=$description;
        $this->miniature=$miniature;
        $this->date=$date;
        $this->contexte=$contexte;
        $this->collaboration=$collaboration;
        $this->addJSON=$addJSON;
        $this->idVideo=$idVideo;
        $this->type=$type;
        $this->url=$url;
   }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return null
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * @param null $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;
    }

    /**
     * @return null
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param null $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return null
     */
    public function getMiniature()
    {
        return $this->miniature;
    }

    /**
     * @param null $miniature
     */
    public function setMiniature($miniature)
    {
        $this->miniature = $miniature;
    }

    /**
     * @return null
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param null $date
     */
    public function setDate($date)
    {
        $this->date = $date;
    }

    /**
     * @return null
     */
    public function getContexte()
    {
        return $this->contexte;
    }

    /**
     * @param null $contexte
     */
    public function setContexte($contexte)
    {
        $this->contexte = $contexte;
    }

    /**
     * @return null
     */
    public function getCollaboration()
    {
        return $this->collaboration;
    }

    /**
     * @param null $collaboration
     */
    public function setCollaboration($collaboration)
    {
        $this->collaboration = $collaboration;
    }

    /**
     * @return null
     */
    public function getAddJSON()
    {
        return $this->addJSON;
    }

    /**
     * @param null $addJSON
     */
    public function setAddJSON($addJSON)
    {
        $this->addJSON = $addJSON;
    }

    /**
     * @return null
     */
    public function getIdVideo()
    {
        return $this->idVideo;
    }

    /**
     * @param null $idVideo
     */
    public function setIdVideo($idVideo)
    {
        $this->idVideo = $idVideo;
    }

    /**
     * @return null
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param null $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * @return null
     */
    public function getUrl()
    {
        return $this->url;
    }

    /**
     * @param null $url
     */
    public function setUrl($url)
    {
        $this->url = $url;
    }

  public function jsonSerialize(){ return get_object_vars($this); }


}
?>
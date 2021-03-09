<?php

class Contact implements JsonSerializable{

    private $id=0;
    private $nom=null;
    private $prenom=null;
    private $mail=null;
    private $message=null;
    private $date=null;
   
   public function __construct($id=0, $nom=null, $prenom=null, $mail=null, $message=null, $date=null) {
        $this->id=$id;
        $this->nom=$nom;
        $this->prenom=$prenom;
        $this->mail=$mail;
        $this->message=$message;
        $this->date=$date;
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
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * @param null $prenom
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;
    }

    /**
     * @return null
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * @param null $mail
     */
    public function setMail($mail)
    {
        $this->mail = $mail;
    }

    /**
     * @return null
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param null $message
     */
    public function setMessage($message)
    {
        $this->message = $message;
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


    public function jsonSerialize(){ return get_object_vars($this); }


}
?>
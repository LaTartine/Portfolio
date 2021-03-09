<?php

class ImageCarousel implements JsonSerializable{

    private $id = 0;
    private $image = null;
    private $description = null;

    public function __construct($id=0, $image=null, $description=null) {
        $this->id = $id;
        $this->image = $image;
        $this->description = $description;
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
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param null $image
     */
    public function setImage($image)
    {
        $this->image = $image;
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


    public function jsonSerialize(){
        return get_object_vars($this);
    }
}
?>
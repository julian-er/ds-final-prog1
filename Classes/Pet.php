<?php
class Pet
{
    public $id;
    public $ownerID;
    public $name;
    public $breed;

    public function __construct($ownerID, $name, $breed, $id = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->breed = $breed;
        $this->ownerID = $ownerID;
    }

    public function getId() {return $this->id;}
    public function setId($id) {$this->id = $id;}
    public function getOwner() {return $this->ownerID;}
    public function getName() {return $this->name;}
    public function getBreed() {return $this->breed;}
}



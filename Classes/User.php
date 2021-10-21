<?php
class User
{
    protected $id;
    protected $user;
    protected $name;
    protected $lastName;

    public function __construct($user, $name, $lastName, $id = null)
    {
        $this->id = $id;
        $this->name = $name;
        $this->lastName = $lastName;
        $this->user = $user;
    }

    public function getId() {return $this->id;}
    public function setId($id) {$this->id = $id;}
    public function getUser() {return $this->user;}
    public function getName() {return $this->name;}
    public function getLastName() {return $this->lastName;}
    public function getNameLastName() {return "$this->name $this->lastName";}
}






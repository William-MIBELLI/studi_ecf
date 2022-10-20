<?php

class Permission
{
    private int $id_permission;
    private string $name;
    private string $description;

    public function __construct($id_permission, $name, $description)
    {   
        $this->id_permission = $id_permission;
        $this->name = $name;
        $this->description = $description;
    }

    public function getId() : int
    {
        return $this->id_permission;
    }

    public function getName() : string
    {
        return $this->name;
    }

    public function setName(string $value) : self
    {
        $this->name = $value;
        return $this;
    }

    public function getDescription() : string
    {
        return $this->description;
    }

    public function setDescription(string $value) : self
    {
        $this->description = $value;
        return $this;
    }
}
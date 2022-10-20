<?php

class User
{
    protected int $id_user;
    protected string $commercial_name;
    protected string $firstname;
    protected string $lastname;
    protected string $address;
    protected string $postal_code;
    protected string $city;
    protected string $mail;
    protected string $phone;
    protected string $password;
    protected int $role_id;
    protected bool $is_active;
    protected bool $first_connection;

    public function __construct($id_user, $commercial_name, $firstname, $lastname, $address, $postal_code, $city, $mail, $phone, $password, $role_id, $is_active, $first_connection)
    {
        $this->id_user = $id_user;
        $this->commercial_name = $commercial_name;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->address = $address;
        $this->postal_code = $postal_code;
        $this->city = $city;
        $this->mail = $mail;
        $this->phone = $phone;
        $this->password = $password;
        $this->role_id = $role_id;
        $this->is_active = $is_active;
        $this->first_connection = $first_connection;
    }

    public function displayName() : void
    {
        echo 'Bonjour je mapelle '.$this->firstname;
    }

    public function getId() : ?int
    {
        return $this->id_user;
    }

    public function getCommercialName() : string
    {
        return $this->commercial_name;
    }

    public function setCommercialName(string $value) : self
    {
        $this->commercial_name = $value;
        return $this;
    }

    public function getFirstName() : string
    {
        return $this->firstname;
    }

    public function setFirstName(string $value) : self
    {
        $this->firstname = $value;
        return $this;
    }

    public function getLastName() : string
    {
        return $this->lastname;
    }

    public function setLastName(string $value) : self
    {
        $this->lastname = $value;
        return $this;
    }

    public function getAddress() : string
    {
        return $this->address;
    }

    public function setAddress(string $value) : self
    {
        $this->address = $value;
        return $this;
    }

    public function getPostalCode() : string
    {
        return $this->postal_code;
    }

    public function setPostalCode(string $value) : self
    {
        $this->postal_code = $value;
        return $this;
    }

    public function getCity() : string
    {
        return $this->city;
    }

    public function setCity(string $value) : self
    {
        $this->city = $value;
        return $this;
    }

    public function getMail() : string
    {
        return $this->mail;
    }

    public function setMail(string $value) : self
    {
        $this->mail = $value;
        return $this;
    }

    public function getPhone() : string
    {
        return $this->phone;
    }

    public function setPhone(string $value) : self
    {
        $this->phone = $value;
        return $this;
    }

    public function getPassword() : string
    {
        return $this->password;
    }

    public function setPassword(string $value) : self
    {
        $this->password = $value;
        return $this;
    }

    public function getRoleId() : int
    {
        return $this->role_id;
    }

    public function setRoleId(int $value) : self
    {
        $this->role_id = $value;
        return $this;
    }

    public function getIsActive() : bool
    {
        return $this->is_active;
    }

    public function setIsActive(int $value) : self
    {
        if($value == 0){
            $this->is_active = false;
        }else{
            $this->is_active = true;
        }
        return $this;
    }

    public function getFirstConnection() : bool
    {
        return $this->first_connection;
    }

    public function setFirstConnection(int $value) : self
    {
        if($value == 0){
            $this->first_connection = false;
        }else{
            $this->first_connection = true;
        }
        return $this;
    }
}

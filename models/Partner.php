<?php

include_once 'User.php';
include_once 'Permission.php';
include_once 'Structure.php';

class Partner extends User
{
    protected ?int $id_partner;
    protected int $user_id;
    protected array $permissionsList = [];
    protected array $structuresList = [];


    public function __construct($id_user, $commercial_name, $firstname, $lastname, $address, $postal_code, $city, $mail, $phone, $password, $role_id, $is_active, $first_connection, $id_partner, $user_id)
    {   
        $this->id_partner = $id_partner;
        $this->user_id = $user_id;
        parent::__construct($id_user, $commercial_name, $firstname, $lastname, $address, $postal_code, $city, $mail, $phone, $password, $role_id, $is_active, $first_connection);
        $this->getPermissionsFromDb();
        $this->getStructureFromDb();
    }

    public function getId() : ?int
    {
        return $this->id_partner;
    }
    public function getPermissionsFromDb() : void
    {
        try{
            $pdo = new PDO('mysql:host=localhost;dbname=ecf_database', 'root');
            $stmt_perms = $pdo->prepare('
            SELECT id_permission, name, description FROM permission 
            JOIN global ON global.permission_id = permission.id_permission
            WHERE partner_id = :id');
            $stmt_perms->bindValue(':id', $this->getId(), PDO::PARAM_INT);
            if($stmt_perms->execute()){
                $this->permissionsList = [];
                while($temp = $stmt_perms->fetch(PDO::FETCH_ASSOC)){
                    $perm = new Permission(...$temp);
                    $this->permissionsList[] = $perm;
                }
            }
        } catch (PDOException $e){
            echo 'Erreur pendant la récupération des permission de '.$this->getFirstName().' : '.$e->getMessage();
        }
    }

    public function getPermissionsList() : array
    {
        return $this->permissionsList;
    }

    public function getStructureFromDb() : void
    {
        try{
            $pdo = new PDO('mysql:host=localhost;dbname=ecf_database', 'root');
            $stmt = $pdo->prepare('SELECT * FROM structure JOIN user ON user.id_user = structure.user_id WHERE structure.partner_id = :id');
            $stmt->bindValue(':id', $this->getId(), PDO::PARAM_INT);
            if($stmt->execute()){
                while($temp = $stmt->fetch(PDO::FETCH_ASSOC)){
                    $structure = new Structure(...$temp);
                    $this->structuresList[] = $structure;
                }
            }
        } catch (PDOException $e) {
            echo 'Erreur pendant la récupération des structure liées au partenaire : '.$this->getFirstName().' '.$e->getMessage();
        }
    }

    public function getStructureListLength() : int
    {
        return count($this->structuresList);
    }

    public function getStructuresList() : array
    {
        return $this->structuresList;
    }
    
    public function getUserId() : int
    {
        return $this->user_id;
    }
}
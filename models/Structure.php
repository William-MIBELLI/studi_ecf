<?php


include_once './models/User.php';
include_once './models/Partner.php';

class Structure extends User
{
    protected ?int $id_structure;
    protected int $partner_id;
    protected array $permissionsList = [];
    protected array $partnerListPermissions = [];

    public function __construct($id_user, $user_id = null, $commercial_name, $firstname, $lastname, $address, $postal_code, $city, $mail, $phone, $password, $role_id, $is_active, $first_connection, $id_structure, $partner_id)
    {   
        $this->id_structure = $id_structure;
        $this->partner_id = $partner_id;
        parent::__construct($id_user, $commercial_name, $firstname, $lastname, $address, $postal_code, $city, $mail, $phone, $password, $role_id, $is_active, $first_connection);
        $this->getPermissionsFromDb();
    }

    public function getId() : ?int
    {
        return $this->id_structure;
    }

    public function getPartnerId() : int
    {
        return $this->partner_id;
    }

    public function getUserId() : int
    {
        return $this->id_user;
    }
    public function getPermissionsFromDb() : void
    {
        try{
            $pdo = new PDO('mysql:host=localhost;dbname=ecf_database', 'root');
            $stmt_perms = $pdo->prepare('SELECT id_permission, name, description FROM permission 
                                        JOIN global ON global.permission_id = permission.id_permission 
                                        JOIN local ON local.global_id = global.id_global 
                                        WHERE local.structure_id = :id');
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

    public function getPartnerPermissionsFromDb() : void
    {
        try{
            $pdo = new PDO('mysql:host=localhost;dbname=ecf_database', 'root');
            $stmt = $pdo->prepare('');
        } catch (PDOException $e){
            echo 'Erreur pendant la récupération des permissions du partenaire parent '.$e->getMessage().'</br>';
        }
    }
    public function getPartnerParent(array $tab) : ?Partner
    {
        foreach($tab as $item){
            if ($item->getId() == $this->getPartnerId() && get_class($item) == 'Partner'){
                echo 'fonction getPartnerParent OK, partner trouvé : '.$item->getCommercialName().' </br>';
                return $item;
            }
        }
        echo 'Echec de la fonction getParentPartner </br>';
        
        return null;
    }
}


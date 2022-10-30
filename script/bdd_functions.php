<?php

function getPdo() : ?PDO
{
    $uri_online = '
    postgres://isckkatowgnzsg:e355e9242b26f4dd5779efe77cfd462c8157c2ce9c492369860471453fecd1a5@ec2-54-170-90-26.eu-west-1.compute.amazonaws.com:5432/d53m36alolpfcu';
    $user_online = 'isckkatowgnzsg';
    $pass_online = 'e355e9242b26f4dd5779efe77cfd462c8157c2ce9c492369860471453fecd1a5';

    $uri_locale = 'mysql:host_localhost;port=8000;dbname=ecf_database';
    $user_locale = 'root';
    try{

        $pdo = null;

        if($_SESSION['mode'] == 'online'){
            $pdo = new PDO($uri_online, $user_online, $pass_online);
        }else{
            $pdo = new PDO($uri_locale, $user_locale);
        }

        return $pdo;

    } catch (PDOException $e){

        echo 'Erreur pendant la connection a la BDD : '.$e->getMessage();
         return null;
    }
}

function checkData(Array $tab, string &$error, ?int &$role, ?Array &$permissions) : bool
{
    if(!isset($tab)){
        return false;
    }else{
        foreach($tab as $key => $item){
            switch($key){
                case 'type':
                    if($item == 'admin'){
                        $role = 1;
                    }else if($item == 'partner'){
                        $role = 2;
                    }else if($item == 'structure'){
                        $role = 3;
                    } else {
                        $error = 'Le rôle attribué n\'est pas valide';
                        return false;
                    }   
                    break;
                case 'partner_list':
                    if($item == 'null' && $tab['type'] == 'structure'){
                        $error = 'Vous devez renseigner le partenaire dont dépend la structure que vous voulez créer';
                        return false;
                    }
                    break;

                case 'perm':
                    $permissions = $item;
                    break;

                case 'firstname':
                case 'lastname':
                case 'city':
                    $pattern = '/[a-zA-Z]/';
                    if(!preg_match($pattern,$item)){
                        $error = 'Le prénom, le nom et la ville ne doivent contenir que des lettres.';
                        return false;
                    }
                    break;

                case 'address':
                case 'commercial_name':  
                    $pattern = '/[a-zA-Z0-9 ]/';
                    if(!preg_match($pattern, $item)){
                        $error = 'L\'adresse et le nom comemrcial ne doivent contenir que des caractères alpha-numériques';
                        return false;
                    }
                    break;

                case 'postal_code':
                    $pattern = '/[0-9]/';
                    if(!preg_match($pattern, $item)){
                        $error = 'Le code postal ne doit contenir que des chiffres.';
                        return false;
                    }
                    break;
                case 'phone':
                    $pattern = '/[0-9]{10}/';
                    if(!preg_match($pattern, $item)){
                        $error = 'Le numéro de téléphone n\'est pas valide';
                        return false;
                    }
                    break;

                case 'mail':
                    if (!filter_var($item, FILTER_VALIDATE_EMAIL)) {
                        $error = 'Le format de l\'adresse email n\'est pas correcte : '.$item;
                        return false;
                    }
                    break;

                case 'password':
                    if(strlen($item) < 8){
                        $error = 'Le mot de passe doit contenir au minimum 8 caractères. ';
                        return false;
                    }
                    break;

                case 'confirm_password':
                    if($item != $tab['password']){
                        $error = 'La confirmation du mot de passe ne correspond pas';
                        return false;
                    }
                    break;

                default:
                    //echo 'default du witch avec la key : '.$key;
                    return false;
            }
        }
    }
    //echo 'checkData return TRUE';
    return true;
}

function createtUser(array $tab, $role) : bool
{

    $pdo = getPdo();

    if($pdo != null){
        $request = 'INSERT INTO user 
                    (commercial_name, firstname, lastname, address, postal_code, city, mail, phone, password, role_id, is_active, first_connection)
                    VALUES
                    (:commercial, :prenom, :nom, :address, :postal_code, :city, :mail, :phone, :password, :role_id , 1, 1)';
        $pdoStatement = $pdo->prepare($request);
        $pdoStatement->bindValue(':commercial', $tab['commercial_name'], PDO::PARAM_STR);
        $pdoStatement->bindValue(':prenom', $tab['firstname'], PDO::PARAM_STR);
        $pdoStatement->bindValue(':nom',$tab['lastname'], PDO::PARAM_STR);
        $pdoStatement->bindValue(':address',$tab['address'], PDO::PARAM_STR);
        $pdoStatement->bindValue(':postal_code',$tab['postal_code'], PDO::PARAM_INT);
        $pdoStatement->bindValue(':city',$tab['city'], PDO::PARAM_STR);
        $pdoStatement->bindValue(':phone', $tab['phone'], PDO::PARAM_STR);
        $pdoStatement->bindValue(':mail',$tab['mail'], PDO::PARAM_STR);
        $pdoStatement->bindValue(':password',password_hash($tab['password'], PASSWORD_BCRYPT) , PDO::PARAM_STR);
        $pdoStatement->bindValue(':role_id', $role, PDO::PARAM_INT);

        return $pdoStatement->execute();
    }

    return false;
  
}

function createPartner(array $tab, array $permissions) : bool
{
    $user_id = null;
    $pdo = getPdo();

    $stmt_user_id = $pdo->prepare('SELECT id_user FROM user WHERE user.mail = :mail');
    $stmt_user_id->bindValue(':mail', $tab['mail']);

    if($stmt_user_id->execute()){
        $user_id = $stmt_user_id->fetch(PDO::FETCH_ASSOC)['id_user'];
    }else{
        return false;
    }
    $request = 'INSERT INTO partner (user_id) VALUES (:user_id)';
    $stmt = $pdo->prepare($request);
    $stmt->bindValue(':user_id',$user_id,PDO::PARAM_INT);
    if($stmt->execute()){                                     ////////////// SI LA CREATION DE PARTNER EST OK ON CREE GLOBAL
        print_r($permissions);
        $partner_id = getPartnerId($user_id);
        if(createGlobal($permissions, $partner_id)){
            //echo 'Création de la table globale réussie </br>';
        }
        
    } 

    return true;
}

function getPartnerId(int $user_id) : int
{
    $pdo = getPdo();

    $stmt_partner_id = $pdo->prepare('SELECT id_partner FROM partner WHERE partner.user_id = :user_id');
    $stmt_partner_id->bindValue(':user_id', $user_id, PDO::PARAM_INT);
    $stmt_partner_id->execute();
    $temp = $stmt_partner_id->fetch(PDO::FETCH_ASSOC);

    return $temp['id_partner'];
}

function createGlobal(array $permissions, int $partner_id) : bool
{

    $pdo = getPdo();

    $request = 'INSERT INTO global (permission_id, partner_id, is_active_global) VALUES (:permission_id, :partner_id, 1)';
    
    foreach($permissions as $perm){
        $stmt = $pdo->prepare($request);
        $stmt->bindValue(':permission_id', $perm, PDO::PARAM_INT);
        $stmt->bindValue(':partner_id', $partner_id, PDO::PARAM_INT);
        if(!$stmt->execute()){
            //echo 'ERREUR pendant l\'insertion d\'une permission dans la table globale. </br>';
            return false;
        }
    }

    return true;
}

function createStructure(int $partner_id, string $mail) : bool
{

    $user_id = null;
    $pdo = getPdo();

    $rep = $pdo->prepare('SELECT id_user FROM user WHERE user.mail = :mail');
    $rep->bindValue(':mail', $mail, PDO::PARAM_STR);

    if($rep->execute()){
        $user_id = $rep->fetch(PDO::FETCH_ASSOC)['id_user'];
    }

    $stmt = $pdo->prepare('INSERT INTO structure (user_id, partner_id) VALUES (:user_id, :partner_id)');
    $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->bindValue(':partner_id', $partner_id, PDO::PARAM_INT);

    if($stmt->execute()){
        $last_index = $pdo->lastInsertId();
        createLocale($last_index, $partner_id);
    }

    return true;
}

function createLocale(int $structure_id, int $partner_id) : bool
{

    $pdo = getPdo();

    $stmt = $pdo->prepare('SELECT id_global, is_active_global FROM global WHERE global.partner_id = :partner_id');
    $stmt->bindValue(':partner_id', $partner_id, PDO::PARAM_INT);
    if($stmt->execute()){
        while($res = $stmt->fetch(PDO::FETCH_ASSOC)){
            $stmt_insert = $pdo->prepare('INSERT INTO 
                                        local 
                                        (global_id, structure_id, is_active_local) 
                                        VALUES (:global_id, :structure_id, :is_active)');
            $stmt_insert->bindValue(':global_id', $res['id_global'], PDO::PARAM_INT);
            $stmt_insert->bindValue(':structure_id', $structure_id, PDO::PARAM_INT);
            $stmt_insert->bindValue(':is_active', $res['is_active_global'], PDO::PARAM_INT);
            $stmt_insert->execute();
        }
    }

    return true;

}

function addGlobal(int $perm_id, int $partner_id) : bool
{

    $pdo = getPdo();

    $stmt = $pdo->prepare('INSERT INTO 
                            global 
                            (permission_id, partner_id, is_active_global)
                            VALUES
                            (:perm_id, :partner_id, 1)');
    $stmt->bindValue(':perm_id', $perm_id, PDO::PARAM_INT);
    $stmt->bindValue(':partner_id', $partner_id, PDO::PARAM_INT);
    $stmt->execute();
    $last = $pdo->lastInsertId();
    ///////////// ON RECUPERE TOUTES LES STRUCTURES AFFILIES ET ON CALL addLocal POUR LEUR AJOUTER LA PERMSSION

    $stmt_loc = $pdo->prepare('SELECT id_structure from structure WHERE structure.partner_id = :partner_id');
    $stmt_loc->bindValue(':partner_id', $partner_id, PDO::PARAM_INT);
    if($stmt_loc->execute()){
        while($temp = $stmt_loc->fetch(PDO::FETCH_ASSOC)){
            addLocalFromGlobal($last, $temp['id_structure']);
        }
    }

    return true;
}

function deleteGlobal(int $perm_id, int $partner_id) : bool
{

    $pdo = getPdo();

    $stmt = $pdo->prepare('DELETE FROM global WHERE global.partner_id = :partner_id AND global.permission_id = :perm_id');
    $stmt->bindValue(':partner_id', $partner_id, PDO::PARAM_INT);
    $stmt->bindValue(':perm_id', $perm_id, PDO::PARAM_INT);

    return $stmt->execute();
}

function addLocalFromGlobal(int $global_id, int $structure_id) : bool
{

    $pdo = getPdo();

    $stmt = $pdo->prepare('INSERT INTO local 
                            (global_id, structure_id, is_active_local)
                            VALUES
                            (:global_id, :structure_id, 1)');
    $stmt->bindValue(':global_id', $global_id, PDO::PARAM_INT);
    $stmt->bindValue(':structure_id', $structure_id, PDO::PARAM_INT);


    return $stmt->execute();
}

function deleteLocale(int $perm_id, int $structure_id, int $partner_id) : bool
{

    $pdo = getPdo();
    $global_id = null;

    $stmt_global = $pdo->prepare('SELECT id_global FROM 
                                    global 
                                    WHERE global.permission_id = :perm_id 
                                    AND global.partner_id = :partner_id'); 
    $stmt_global->bindValue(':perm_id', $perm_id, PDO::PARAM_INT);
    $stmt_global->bindValue(':partner_id', $partner_id, PDO::PARAM_INT);

    if($stmt_global->execute()){
        $global_id = $stmt_global->fetch(PDO::FETCH_ASSOC)['id_global'];
    }

    $stmt_delete = $pdo->prepare('DELETE FROM local 
                                    WHERE 
                                    local.global_id = :global_id 
                                    AND local.structure_id = :structure_id');
    $stmt_delete->bindValue(':global_id', $global_id, PDO::PARAM_INT);
    $stmt_delete->bindValue(':structure_id', $structure_id, PDO::PARAM_INT);

    return $stmt_delete->execute();
}

function addLocal(int $perm_id, int $structure_id, int $partner_id) : bool
{

    $pdo = getPdo();
    $global_id = null;

    $stmt_global = $pdo->prepare('SELECT id_global 
                                    FROM global 
                                    WHERE global.permission_id = :perm_id 
                                    AND global.partner_id = :partner_id');
    $stmt_global->bindValue(':perm_id', $perm_id, PDO::PARAM_INT);
    $stmt_global->bindValue(':partner_id', $partner_id, PDO::PARAM_INT);
    if($stmt_global->execute()){
        $global_id = $stmt_global->fetch(PDO::FETCH_ASSOC)['id_global'];
    }

    $stmt = $pdo->prepare('INSERT INTO local (global_id, structure_id) VALUES (:global_id, :structure_id)');
    $stmt->bindValue(':global_id', $global_id, PDO::PARAM_INT);
    $stmt->bindValue(':structure_id', $structure_id, PDO::PARAM_INT);

    return $stmt->execute();
}

function desactivateUser(int $user_id, bool $active) : bool
{

    $pdo = getPdo();

    $stmt = $pdo->prepare('UPDATE user SET is_active = :active WHERE user.id_user = :user_id');
    $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
    
    if($active){
        $stmt->bindValue(':active', 0, PDO::PARAM_INT);
    } else{
        $stmt->bindValue(':active', 1, PDO::PARAM_INT);
    }

    return $stmt->execute();
}

function deleteUser(int $user_id) : bool
{

    $pdo = getPdo();

    $stmt = $pdo->prepare('DELETE FROM user WHERE user.id_user = :user_id');
    $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);

    return $stmt->execute();
}

function checkRole(int $required, int $role) : bool
{
    return $role === $required;
}

function updatePassword(string $username, string $password) : bool
{
    $pdo = getPdo();

    $stmt = $pdo->prepare('UPDATE user SET user.password = :password, user.first_connection = 0 WHERE user.mail = :username');
    $stmt->bindValue(':password', password_hash($password, PASSWORD_BCRYPT), PDO::PARAM_STR);
    $stmt->bindValue(':username', $username, PDO::PARAM_STR);

    return $stmt->execute();
}

function getAllPartners() : array
{
    $tab = [];
    $pdo = getPdo();

    $statement = $pdo->prepare('SELECT * FROM partner JOIN user ON partner.user_id = user.id_user');
    if($statement->execute()){
        while($user = $statement->fetch(PDO::FETCH_ASSOC)){
            $partner = new Partner(...$user);
            $list = $partner->getStructuresList();
            foreach($list as $structure){
                $tab[] = $structure;
            }
            $tab[] = $partner;
        }
    }

    return $tab;
}

function getEntityAsJson(){

    $tab = [];
    $pdo = getPdo();
    $statement = $pdo->prepare('SELECT * FROM partner JOIN user ON partner.user_id = user.id_user');
    if($statement->execute()){
        while($user = $statement->fetch(PDO::FETCH_ASSOC)){
            $partner = new Partner(...$user);
            $list = $partner->getStructuresList();
            foreach($list as $structure){
                $tab[] = $structure;
            }
            $tab[] = $partner;
        }
    }
    $encoded = json_encode($tab);
    
    return $encoded;
}

function getAllPermissions() : array
{
    $tab = [];
    $pdo = getPdo();

    $stmt_perms = $pdo->prepare('SELECT * FROM permission');
    if($stmt_perms->execute()){
        while($temp = $stmt_perms->fetch(PDO::FETCH_ASSOC)){
            $tab[] = new Permission(...$temp);
        }
    }

    return $tab;
}

function getPartner(int $user_id) : Partner
{
    $partner = null;
    $pdo = getPdo();

    $stmt = $pdo->prepare('SELECT * FROM partner  
                            JOIN user ON user.id_user = :id 
                            WHERE partner.user_id = :id');
    $stmt->bindValue(':id', $user_id, PDO::PARAM_INT);

    if($stmt->execute()){
        $temp = $stmt->fetch(PDO::FETCH_ASSOC);
        $partner = new Partner(...$temp);
    }

    return $partner;
}

function getStructure(int $user_id) : Structure
{
    $structure = null;
    $pdo = getPdo();

    $stmt = $pdo->prepare('SELECT * FROM structure  
                            JOIN user ON user.id_user = :id 
                            WHERE structure.user_id = :id');
    $stmt->bindValue(':id', $user_id, PDO::PARAM_INT);

    if($stmt->execute()){
        $temp = $stmt->fetch(PDO::FETCH_ASSOC);
        $structure = new Structure(...$temp);
    }

    return $structure;
}
function getPartnersForForms() : array
{
    $temp = [];
    $pdo = getPdo();

    $stmt = $pdo->prepare('SELECT commercial_name, id_partner, is_active  FROM user 
    JOIN partner ON partner.user_id = user.id_user');
    if($stmt->execute()){
        while($res = $stmt->fetch(PDO::FETCH_ASSOC)){
            $temp[] = $res;
        }
    }

    return $temp;
}

function createRequest(int $user_id, string $content) : bool
{

    $pdo = getPdo();

    $stmt = $pdo->prepare('INSERT INTO request (user_id, content) VALUES (:user_id, :content)');
    $stmt->bindValue(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->bindValue(':content', $content, PDO::PARAM_STR);

    return $stmt->execute();

}

function getRequests() : array
{
    $temp = [];
    $pdo = getPdo();

    $stmt = $pdo->prepare('SELECT commercial_name, mail, content, request.id_request FROM request JOIN user ON request.user_id = user.id_user');
    if($stmt->execute()){
        while($res = $stmt->fetch(PDO::FETCH_ASSOC)){
            $temp[] = $res;
        }
    }

    return $temp;

}

function deleteRequest(int $request_id) : bool
{
    $pdo = getPdo();

    $stmt = $pdo->prepare('DELETE FROM request WHERE request.id_request = :id');
    $stmt->bindValue(':id', $request_id, PDO::PARAM_INT);

    return $stmt->execute();
}

function sendMail(string $statut, string $address) : void
{
    $msg = null;
    if($statut == 'true'){
        $msg = 'Votre demande a été acceptée, les modifications seront appliquées dans les meilleurs délais';
    }else{
        $msg = 'Votre demande a été rejetée, n\'hésitez pas à prendre contact avec nos équipes afin de trouver une solution rapidement';
    }
    mail($address, 'Statut de votre demande WorkOUT', $msg);
}
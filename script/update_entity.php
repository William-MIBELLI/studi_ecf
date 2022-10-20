
<?php

include "../models/Partner.php";
include "../script/bdd_functions.php";

session_start();
if(isset($_POST) && count($_POST) != 0){
    $entity = $_SESSION['user'];
    $entity_permissions_list = $_SESSION['entity_permissions_list'];
    $_SESSION['entity_permissions_list'] = [];
    $_SESSION['user'] = [];
    try{
        $pdo = new PDO('mysql:host=localhost;dbname=ecf_database', 'root');
        $stmt = $pdo->prepare('UPDATE user SET
        commercial_name = :cm,
        firstname = :fn,
        lastname = :ln,
        address = :address,
        postal_code = :pc,
        city = :city,
        mail = :mail,
        phone = :phone,
        password = :pass 
        WHERE user.id_user = :id');
        $stmt->bindValue(':cm', $_POST['commercial_name'], PDO::PARAM_STR);
        $stmt->bindValue(':fn', $_POST['firstname'], PDO::PARAM_STR);
        $stmt->bindValue(':ln', $_POST['lastname'], PDO::PARAM_STR);
        $stmt->bindValue(':address', $_POST['address'], PDO::PARAM_STR);
        $stmt->bindValue(':pc', $_POST['postal_code'], PDO::PARAM_STR);
        $stmt->bindValue(':city', $_POST['city'], PDO::PARAM_STR);
        $stmt->bindValue(':mail', $_POST['mail'], PDO::PARAM_STR);
        $stmt->bindValue(':phone', $_POST['phone'], PDO::PARAM_STR);
        $stmt->bindValue(':pass', $_POST['password'], PDO::PARAM_STR);
        $stmt->bindValue(':id', $entity->getUserId(), PDO::PARAM_INT);

        if($stmt->execute()){
            echo 'UPDATE OK';
        }

        ///////////  POUR DETECTER LES SUPPRESSIONS DE PERMISSIONS

        foreach($entity_permissions_list as $perm_entity){
            if(!in_array($perm_entity->getId(), $_POST['perm'] ?? [])){
                echo $perm_entity->getName().' n\'est plus cochée, il faut odnc la supprimer </br>' ; 
                if(get_class($entity) == 'Partner'){
                    deleteGlobal($perm_entity->getId(),$entity->getId(), $pdo); 
                }else if (get_class($entity) == 'Structure'){
                    deleteLocale($perm_entity->getId(), $entity->getId(), $entity->getPartnerId(), $pdo);
                }
            }
        }

        ////////////  POUR DETECTER LES AJOUTS DE PERMISSIONS

        foreach($_POST['perm'] ?? [] as $perm_post_id){
            $add = true;
            foreach($entity_permissions_list as $perm){
                if($perm->getId() == $perm_post_id){
                    $add = false;
                }
            }
            if($add){
                echo 'le permission N°'.$perm_post_id.' doit être ajoutée </br>';
                if(get_class($entity) == 'Partner'){
                    addGlobal($perm_post_id, $entity->getId(), $pdo);
                }else if (get_class($entity) == 'Structure'){
                    addLocal($perm_post_id, $entity->getId(), $entity->getPartnerId(), $pdo);
                }
            }
        }




    } catch (PDOException $e){
        echo 'Erreur pendant la mise à jour de la base de donnée '.$e->getMessage();
    }
}
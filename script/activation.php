<?php
include_once "../models/User.php";
include_once "../models/Partner.php";
include_once "../script/bdd_functions.php";

session_start();
echo 'page de désactivation </br>';
$entity = null;
$list = $_SESSION['entity'];
// echo '<pre>';
// print_r($list);
// echo '</pre>';
foreach($list as $item){
    if($_GET['id'] == $item->getUserId()){
        $entity = $item;
        echo 'on vient de recuperer le user numéro '.$entity->getUserId();
    }
}
try{
    $pdo = new PDO('mysql:host=localhost;dbname=ecf_database', 'root');
    if(get_class($entity) == 'Partner'){
        desactivateUser($entity->getUserId(), $entity->getIsActive(), $pdo);
        echo 'Partenaire désactivé </br>';
        foreach($entity->getStructuresList() as $structure){
            desactivateUser($structure->getUserId(), $entity->getIsActive(), $pdo);
        }
    }else {
        $parent = $entity->getPartnerParent($list);
        if($parent->getIsActive()){
            desactivateUser($entity->getUserId(), $entity->getIsActive(), $pdo);
            echo 'structure désactivée </br>';
        }else{
            echo 'Impossible d\'activer la structure car son partenaire parent est désactivé </br>';
        }
    }
} catch (PDOException $e){
    echo 'Erreur pendant le changement de statut de l\'entité : '.$entity->getCommercialName().$e->getMessage().' </br>';
}
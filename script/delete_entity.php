<?php
include_once "../script/bdd_functions.php";

if(!isset($_GET['id'])){
    $msg = 'la requête ne peut pas être traitée, des éléments sont manquants. </br>';
    require_once "../templates/fail.php";
    die();
}
$list = $_SESSION['entity'];
$entity = null;
foreach($list as $item){
    if($item->getUserId() == $_GET['id']){
        $entity = $item;
    }
}
if($entity == null){
    $msg = 'L\'utilisateur n\'éxiste pas';
    require_once "../templates/fail.php";
} else {

    deleteUser($entity->getUserId());
    $msg = 'suppression de '.$entity->getCommercialName().' OK </br>'; 
    if(get_class($entity) == 'Partner'){
        foreach($entity->getStructuresList() as $item){
            deleteUser($item->getUserId());
        }
    }
    require_once "../templates/success.php";

}

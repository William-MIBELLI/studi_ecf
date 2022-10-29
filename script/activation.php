<?php
include_once "../script/bdd_functions.php";


//echo 'page de désactivation </br>';
$entity = null;
$list = $_SESSION['entity'];
foreach($list as $item){

    if($_GET['id'] == $item->getUserId()){
        $entity = $item;
        //echo 'on vient de recuperer le user numéro '.$entity->getUserId();
    }
}

if(get_class($entity) == 'Partner'){
    desactivateUser($entity->getUserId(), $entity->getIsActive());
    $msg = 'Partenaire désactivé </br>';
    foreach($entity->getStructuresList() as $structure){
        desactivateUser($structure->getUserId(), $entity->getIsActive());
    }
    require_once "../templates/success.php";
}else {
    $parent = $entity->getPartnerParent($list);
    if($parent->getIsActive()){
        desactivateUser($entity->getUserId(), $entity->getIsActive());
        $msg = 'structure désactivée </br>';
        require_once "../templates/success.php";
    }else{
        $msg = 'Impossible d\'activer la structure car son partenaire parent est désactivé </br>';
        require_once "../templates/fail.php";
    }
}

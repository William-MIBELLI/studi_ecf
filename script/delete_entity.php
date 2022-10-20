<?php
include_once "../models/Partner.php";
include_once "../models/Structure.php";
include_once "../script/bdd_functions.php";
session_start();
if(!isset($_GET['id'])){
    echo 'la requête ne peut pas être traitée, des éléments sont manquants. </br>';
    die();
}
echo 'GET id : '.$_GET['id'].' </br>';
$list = $_SESSION['entity'];
$entity = null;
foreach($list as $item){
    if($item->getUserId() == $_GET['id']){
        $entity = $item;
    }
}
try{
    $pdo = new PDO('mysql:host=localhost;dbname=ecf_database', 'root');
    deleteUser($entity->getUserId(), $pdo);
    echo 'suppression de '.$entity->getCommercialName().' OK </br>'; 
    if(get_class($entity) == 'Partner'){
        foreach($entity->getStructuresList() as $item){
            deleteUser($item->getUserId(), $pdo);
            echo 'suppression de '.$item->getCommercialName().' OK </br>'; 
        }
    }
} catch (PDOException $e){
    echo 'Erreur pendant la suppresion de lutilisateur : '.$entity->getCommercialName().' </br>';
}

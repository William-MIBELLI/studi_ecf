<?php

include_once '../models/Partner.php';
include_once 'bdd_functions.php';

$resultat = $_POST;
$error = '';
$role;
$permissions;


if(!checkData($resultat, $error, $role, $permissions)){
    $msg = $error;
    require_once "../templates/fail.php";
}else{
    //echo 'On peut traiter la création dans la BDD'."</br>";
   // echo 'liste des permission : </br>';
    print_r($list_permissions);
    if(createtUser($resultat, $role)){
       // echo 'création d\'User réussie.</br>';
        if($resultat['type'] == 'partner'){                 ////////////// CREATION DE PARTNER ET GLOBAL
            if(createPartner($resultat, $permissions)){
                $msg = 'Création du partenaire réussi </br>';
            }
        }else if($resultat['type'] == 'structure'){         ////////////// CREATION DE STRUCTURE ET LOCAL
            if(createStructure(intval($resultat['partner_list']), $resultat['mail'])){
                $msg = 'Création de la structure réussie </br>';
            }
        }
        require_once "../templates/success.php";
    }else{
        $msg = 'ERREUR PENDANT L\'INSERTION';
        require_once "../templates/fail.php";
    }
}




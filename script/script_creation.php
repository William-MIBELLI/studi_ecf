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
    print_r($list_permissions);
    // $statut = checkStatut($resultat);
    // $resultat['statut'] = $statut;
    if(createtUser($resultat, $role)){
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

// function checkStatut(array $tab) : int
// {
//     if($tab['type'] != 'structure'){

//         return 1;
//     }
//     $temp = getAllPartners();
//     foreach($temp as )
// }




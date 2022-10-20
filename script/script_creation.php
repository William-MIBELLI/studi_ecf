<?php

include_once '../models/Partner.php';
include_once 'bdd_functions.php';

echo 'script de creation!';
$resultat = $_POST;
$error = '';
$role;
$permissions;

echo '<pre>';
var_dump($resultat);
echo '</pre>';

if(!checkData($resultat, $error, $role, $permissions)){
    echo $error;
}else{
    echo 'On peut traiter la création dans la BDD'."</br>";
    echo 'liste des permission : </br>';
    print_r($list_permissions);
    if(createtUser($resultat, $role)){
        echo 'création d\'User réussie.</br>';
        if($resultat['type'] == 'partner'){                 ////////////// CREATION DE PARTNER ET GLOBAL
            if(createPartner($resultat, $permissions)){
                echo 'Création du partenaire réussi </br>';
            }
        }else if($resultat['type'] == 'structure'){         ////////////// CREATION DE STRUCTURE ET LOCAL
            if(createStructure(intval($resultat['partner_list']), $resultat['mail'])){
                echo 'Création de la structure réussie </br>';
            }
        }
        echo 'role : '.$role;
    }else{
        echo 'ERREUR PENDANT L\'INSERTION';
    }
}




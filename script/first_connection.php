<link rel="stylesheet" href="../css/style_dash.css">

<?php
$index = true;
include_once "../script/bdd_functions.php";
spl_autoload_register(function($class) {
    //echo 'on call lautoloader';
    require_once('../models/'.$class.'.php');
});
session_start();

if($_POST['old_pass'] !== $_SESSION['password']){
    $msg = 'La vérification de votre mot de passe actuel a échoué </br>';
    require_once "../templates/fail.php";
    die();
}
if($_POST['new_pass'] !== $_POST['confirm_pass']){
    $msg =  'Une incohérence a été detectée entre le nouveau mot de passe et sa confirmation.';
    require_once "../templates/fail.php";
    die();
}

 //echo 'verification OK </br>';
 if(updatePassword($_SESSION['username'], $_POST['new_pass'])){
    //echo 'Changement du mot de passe OK.';
    $_SESSION['role_id'] = $_SESSION['auth']->getRoleId();
    header("Location:/public/dashboard.php");
 }else{
    $msg =  'Erreur pendant le changement du mot de passe';
    require_once "../templates/fail.php";
 }


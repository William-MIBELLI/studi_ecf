<?php
session_start();
require_once "bdd_functions.php";

$pdo = getPdo();
$result = [];
$stmt = $pdo->prepare('SELECT id_user, mail, commercial_name, firstname, lastname FROM user');
if($stmt->execute()){
    while($temp = $stmt->fetch(PDO::FETCH_ASSOC)){
        $result[] = $temp;
    }
}

echo json_encode($result);




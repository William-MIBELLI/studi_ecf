<?php
session_start();
$_SESSION['role_id'] = null;
include "../models/User.php";

if(!isset($_POST) || count($_POST) == 0){
    echo 'Une erreur s\'est produite.';
    die();
}

$username = $_POST['username'];
$password = $_POST['password'];
$user = null;

try{
    $pdo = new PDO('mysql:host=localhost;dbname=ecf_database', 'root');
    $stmt = $pdo->prepare('SELECT * FROM user WHERE user.mail = :username');
    $stmt->bindValue(':username', $username, PDO::PARAM_STR);
    if($stmt->execute()){
        $temp = $stmt->fetch(PDO::FETCH_ASSOC);
        if($temp == null){
            throw new PDOException('Erreur lors de la saisie de vos identifiants de connection');
        }
        $user = new User(...$temp);
        $_SESSION['auth'] = $user;
        if(password_verify($password, $user->getPassword())){
            if(!$user->getIsActive()){
                throw new PDOException('Cet utilisateur a été désactivé');
            } else if ($user->getFirstConnection()){
                $_SESSION['password'] = $password;
                $_SESSION['username'] = $username;
                header("Location:../public/first_connection_page.php");
                die();
            }
            $_SESSION['role_id'] = $user->getRoleId();
            header("Location:../public/dashboard.php");
            die();
            
        }else{
            throw new PDOException('Erreur lors de la saisie de vos identifiants de connection');
        }
    }

} catch (PDOException $e){
    $_SESSION['alert_user'] = true;
    $_SESSION['alert_msg'] = $e->getMessage();
    header("Location:../index.php");
}
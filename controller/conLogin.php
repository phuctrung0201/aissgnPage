<?php
    if(isset($_POST['login'])){
        require 'modal/modalLogin.php';
        $user = $query->findUser($_POST['usern'],$_POST['passw']);
        if($user){
            $_SESSION['usern'] = $user['usern'];
            $_SESSION['passw'] = $user['passw'];
            $_SESSION['control'] = $user['role'];
            header('location: index.php');
        }
    } 
     require 'view/viewLogin.php';
    
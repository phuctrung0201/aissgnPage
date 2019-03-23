<?php
    if(isset($_POST['usern'])){
        if(trim($_POST['usern']) != '' && trim($_POST['passw']) != '' ){
            require 'modal/modalRegister.php';
            if($query->addUser($_POST['usern'],$_POST['passw'])) header('location: index.php');
        }
    }
    require 'view/viewRegister.php';
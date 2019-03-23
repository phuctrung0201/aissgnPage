<?php
require 'modal/modalAdmin.php';
    $page = isset($_GET['page'])?$_GET['page']:1;
    if(isset($_POST['assign'])){
        $error = !(trim($_POST['task']) != '' && $query->findUser($_POST['usern']));
        if(!$error){
            $error = !$query->assignTask($_POST['usern'],$_POST['task']);
        }
    }
    if(isset($_POST['changeState'])){
        $query->changeState($_POST['changeState']);
    }
    if(isset($_POST['addTask'])){
        if(trim($_POST['Task']) != ''){
            $query->addTask($_POST['addTask'],$_POST['Task']);
        }
    }
    if(isset($_POST['delTask'])){
        $query->delTask($_POST['delTask']);
    } 
    if(isset($_POST['delList'])){
        $query->delList($_POST['delList']);
    }
    $query->setPage();
    $display = $query->showTasks($page);
require 'view/viewAdmin.php';
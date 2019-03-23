<?php
    require 'modal/modalUser.php';
    $page = isset($_GET['page'])?$_GET['page']:1;
    if(isset($_POST['changeState'])){
        $query->changeState($_POST['changeState']);
    }
    $query->setPage($_SESSION['usern']);
    $display = $query->showTasks($page);
    require 'view/viewUser.php';
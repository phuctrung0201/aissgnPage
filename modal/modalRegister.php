<?php
    class database extends mysqli{
        function addUser($usern,$passw){
            $prepare = $this->prepare("insert into users(usern,passw) values (?,?)");
            $prepare->bind_param('ss',$usern,$passw);
            return $prepare->execute();
        }
    }
    require 'app/database.php';
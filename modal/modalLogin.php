<?php
    class database extends mysqli {
        function findUser($usern,$passw){
            $prepare = $this->prepare("select * from users where usern = ? and passw = ? ");
            $prepare->bind_param('ss',$usern,$passw);
            $prepare->execute();
            $result = $prepare->get_result();
            return $result->fetch_assoc();
        }
    }
    require 'app/database.php';
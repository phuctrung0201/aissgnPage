<?php
    class database extends mysqli{
        private $pages;
        private $usern;
        function setPage($usern){
            $this->usern = $usern;
            $list = $this->query("select * from lists where userid in (select id from users where usern ='$usern') and state != 'close'");
            $num_lists = $list->num_rows;
            $this->pages = $num_lists/4 + ($num_lists%4 == 0 ? 0 : 1);
        }
        function pagination($page){
            if ($this->pages > 7){
                if($page < 4){
                    $start = 1;
                    $end = 7;
                } elseif ($page > ($this->pages - 3) ){
                    $start = $this->pages - 6;
                    $end = $this->pages;
                } else{
                    $start = $page - 3;
                    $end = $page +3;
                }
            } else {
                $start = 1;
                $end = $this->pages;
            }
            for($i = $start ; $i <= $end; $i++){
                $active = $i == $page?'active':'';
                echo "<li class='page-item $active'><button class ='page-link' name='page' value='$i'>$i</button></li>";
            }
        }
        function showTasks($offset){
            $offset = ($offset-1)*4;
            $query = $this->query("select * from lists where userid in (select id from users where usern ='$this->usern') and state != 'close' limit $offset,4 ");
            $displayed = '';
            while($list = $query->fetch_assoc()){
                $display = "<div class='d-flex justify-content-between'>
                                <h2 class='m-0'>".$list['listn']."</h2>
                                <button class='btn btn-info' value='".$list['id']."' name='changeState'>".$list['state']."</button>
                            </div><hr/><div class='overflow-auto'  style='height: 144px;'>";
                $tasks = $this->query("select * from tasks where listid = '".$list['id']."'");
                while($task = $tasks->fetch_assoc()){

                    $display = $display."<div>".$task['task']."</div>";
                }
                $display = $display."</div>";
                $display = "<div class='col-md-3 mt-3'>
                                <div class='card p-3' >
                                    <form action='index.php' method='post'>
                                        $display
                                    </form>
                                </div>
                            </div>";
                $displayed = $displayed.$display;       
            } 
            return $displayed;   
        }
        function findList($id){
            $prepare = $this->prepare('select * from lists where id = ? ');
            $prepare->bind_param('i',$id);
            $prepare->execute();
            $list = $prepare->get_result();
            $list = $list->fetch_assoc();
            return $list;
        }
        function changeState($listid){
            $list = $this->findList($listid);
            switch($list['state']){
                case 'open':
                $state = 'in process';
                break;
                case 'in process':
                $state = 'solved';
                break;
            }
            if(isset($state)){
                $prepare = $this->prepare('update lists set state = ? where id = ? ');
                $prepare->bind_param('ss',$state,$listid);
                return $prepare->execute();
            }
        }
    }
    require 'app/database.php';
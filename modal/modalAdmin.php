<?php
    class database extends mysqli{
        public $pages;
        function setPage(){
            $list = $this->query("select * from lists");
            $num_lists = $list->num_rows;
            $this->pages = $num_lists/4 + ($num_lists%4 == 0 ? 0 : 1);
        }
        function assignTask($usern,$task){
                $user = $this->findUser($usern);
                $prepare = $this->prepare('insert into lists(listn,userid) values (?,?)');
                $prepare->bind_param('ss',$task,$user['id']);
                return $prepare->execute();
        }
        function findUser($usern){
            $prepare = $this->prepare("select * from users where usern = ? and role != 'admin'");
            $prepare->bind_param('s',$usern);
            $prepare->execute();
            $result = $prepare->get_result();
            return $result->fetch_assoc();
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
            $query = $this->query("select * from lists limit $offset,4");
            $displayed = '';
            while($list = $query->fetch_assoc()){
                $display = "<div class='d-flex justify-content-between'>
                                <h2 class='m-0'>".$list['listn']."</h2>
                                <button class='btn btn-info' value='".$list['id']."' name='changeState'>".$list['state']."</button>
                                <button class='btn btn-outline-danger' value='".$list['id']."' name='delList'>&times;</button>
                            </div><hr/><div class='overflow-auto'  style='height: 144px;'>";
                $tasks = $this->query("select * from tasks where listid = '".$list['id']."'");
                while($task = $tasks->fetch_assoc()){

                    $display = $display."<div class='d-flex justify-content-between'><div>".$task['task']."</div>"."<button name='delTask' value='".$task['id']."' class='badge btn'>&times</button></div>";
                }
                $display = $display."</div><hr/>"."<div class='input-group'>
                                <input type='text' class='form-control' name='Task' placeholder='Enter your task'/>
                                <div class='input-group-append'>
                                    <button class='btn btn-success' name='addTask' value='".$list['id']."'>Add</button>
                                </div>
                            </div>";
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
                case 'close':
                $state = 'open';
                break;
                case 'open':
                $state = 'in process';
                break;
                case 'in process':
                $state = 'solved';
                break;
                default:
                $state = 'close';
            }
            $prepare = $this->prepare('update lists set state = ? where id = ? ');
            $prepare->bind_param('ss',$state,$listid);
            return $prepare->execute();
        }
        function addTask($listid,$task){
            $prepare = $this->prepare("insert into tasks(task,listid) values (?,?)");
            $prepare->bind_param('si',$task,$listid);
            return $prepare->execute();
        }
        function delTask($id){
            $prepare = $this->prepare("delete from tasks where id = ?");
            $prepare->bind_param('i',$id);
            $prepare->execute();
        }
        function delList($id){
            $prepare = $this->prepare("delete from lists where id = ?");
            $prepare->bind_param('i',$id);
            $prepare->execute();
        }


    }
    require 'app/database.php';
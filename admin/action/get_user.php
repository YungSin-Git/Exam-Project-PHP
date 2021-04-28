<?php

    include ('sub_database_class.php');
    $db = new sub_databaseClass();

    $data = [];
    $numStart=$_POST['startNum'];
    $numEnd=$_POST['endNum'];
    $field="user.id,user.username,user.password,role.name,user.status";
    $tbl="user INNER join role ON user.roleid=role.id";

    $getData=$db->selectData($field,$tbl,"user.id>0","user.id DESC","".$numStart.",".$numEnd."");
    if ($getData != 0){
        foreach ($getData as $row){
            $data[]=array("id"=>$row[0],"username"=>$row[1],"password"=>$row[2],"name"=>$row[3],"status"=>$row[4]);
        }
    }
     echo json_encode($data);
?>
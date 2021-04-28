<?php

    include ('sub_database_class.php');
    $db = new sub_databaseClass();

    $data = [];
    $numStart=$_POST['startNum'];
    $numEnd=$_POST['endNum'];

    $getData=$db->selectData("*","course","id>0","id DESC","".$numStart.",".$numEnd."");
    if ($getData != '0'){
        foreach ($getData as $row){
            $data[]=array("id"=>$row[0],"name"=>$row[1],"seatLimit"=>$row[2],"startDate"=>$row[3],"endDate"=>$row[4],"status"=>$row[5]);
        }
    }
    
    echo json_encode($data);
?>
<?php

include ('sub_database_class.php');
$db = new sub_databaseClass();

$data = [];
$numStart=$_POST['startNum'];
$numEnd=$_POST['endNum'];

$getData=$db->selectData("*","student","id>0","id DESC","".$numStart.",".$numEnd."");
if ($getData != '0'){
    foreach ($getData as $row){
        $data[]=array("id"=>$row[0],"firstname"=>$row[1],"lastname"=>$row[2],"gender"=>$row[3],"dob"=>$row[4],
            "pob"=>$row[5],"address"=>$row[6],"email"=>$row[7],"contact"=>$row[8],"image"=>$row[9],"status"=>$row[10]);
    }
}

echo json_encode($data);
?>
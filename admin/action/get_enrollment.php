<?php

    include ('sub_database_class.php');
    $db = new sub_databaseClass();

    $data = [];
    $numStart=$_POST['startNum'];
    $numEnd=$_POST['endNum'];
    $field="enrollment.id,student.firstname,student.lastname,course.name,
                    enrollment.enrollmentDate,enrollment.startDate,enrollment.status";
    $tbl="enrollment INNER JOIN course ON enrollment.courseID=course.id
                             INNER JOIN student on enrollment.studentID=student.id";
    $cond="enrollment.id>0";
    $od="enrollment.id DESC";

    $getData=$db->selectData($field,$tbl,$cond,$od,"".$numStart.",".$numEnd."");
    if ($getData!=0){
        foreach ($getData as $row){
            $data[]=array("id"=>$row[0],"firstname"=>$row[1],"lastname"=>$row[2],"name"=>$row[3],"enrollmentDate"=>$row[4],
                "startDate"=>$row[5],"status"=>$row[6]);
        }
    }

    echo json_encode($data);
?>
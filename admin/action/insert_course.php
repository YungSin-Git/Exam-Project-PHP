<?php

    include ('sub_database_class.php');
    $db = new sub_databaseClass();

    $id=$_POST['txt-id'];
    $name=$_POST['txt-course-name'];
    $name=trim($name);
    $numStu=$_POST['txt-num'];
    $numStu=trim($numStu);
    $startDate=$_POST['txt-startDate'];
    $endDate=$_POST['txt-endDate'];
    $status=$_POST['txt-course-status'];
    $edit=$_POST['txt-edit'];

    $response['edit']=false;
        $duplicate=$db->duplicateData("name","course","name='".$name."' AND id!=".$edit."");
        if ($duplicate==true){
            $response['duplicate']=true;
        }else {
            if ($edit == 0) {
                $db->insertData("course","null,'" . $name . "','" . $numStu . "','" . $startDate . "','" . $endDate . "','" . $status . "'");
                $response['id'] = $db->last_id();
                $response['duplicate'] = false;
            }else{
                $db->updateData("course","name='".$name."',seatLimit='".$numStu."',startDate='".$startDate."',endDate='".$endDate."',status='".$status."'","id='".$edit."'");
                $response['edit']=true;
            }
        }

    echo json_encode($response);
    
?>
<?php

    include ('sub_database_class.php');
    $db = new sub_databaseClass();

    $id=$_POST['txt-id'];
    $studentName=$_POST['txt-student-name'];
    $courseName=$_POST['txt-course-name'];
    $enrollmentData=$_POST['txt-enrollmentDate'];
    $startDate=$_POST['txt-startDate'];
    $status=$_POST['txt-status'];
    $edit=$_POST['txt-edit'];

    $response['edit']=false;
    if ($edit == 0){
        $db->insertData("enrollment","null,'".$studentName."','".$courseName."','".$enrollmentData."','".$startDate."','".$status."'");
        $response['id']=$db->last_id();
    }else{
        $db->updateData("enrollment","studentID='".$studentName."',courseID='".$courseName."',
            enrollmentDate='".$enrollmentData."',startDate='".$startDate."',status='".$status."'","id=".$edit."");
        $response['edit']=true;
    }

    echo json_encode($response);

?>
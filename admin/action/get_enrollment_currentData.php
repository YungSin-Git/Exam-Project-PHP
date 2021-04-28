<?php

    include ('sub_database_class.php');
    $db = new sub_databaseClass();

    $data=array();

    $showdata=$db->get_currentData("*","enrollment","id=".$_POST['id']."");

    $data['id']=$showdata[0];
    $data['studentID']=$showdata[1];
    $data['courseID']=$showdata[2];
    $data['enrollmentDate']=$showdata[3];
    $data['startDate']=$showdata[4];
    $data['status']=$showdata[5];

    echo json_encode($data);

?>
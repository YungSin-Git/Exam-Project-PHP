<?php

    include ('sub_database_class.php');
    $db = new sub_databaseClass();

    $data=array();

    $showdata=$db->get_currentData("*","student","id=".$_POST['id']."");

    $data['id']=$showdata[0];
    $data['firstname']=$showdata[1];
    $data['lastname']=$showdata[2];
    $data['gender']=$showdata[3];
    $data['dob']=$showdata[4];
    $data['pob']=$showdata[5];
    $data['address']=$showdata[6];
    $data['email']=$showdata[7];
    $data['contact']=$showdata[8];
    $data['image']=$showdata[9];
    $data['status']=$showdata[10];

    echo json_encode($data);
?>
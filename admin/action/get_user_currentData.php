<?php

    include ('sub_database_class.php');
    $db = new sub_databaseClass();

    $data=array();

    $showData=$db->get_currentData("*","user","id=".$_POST['id']."");

    $data['id']=$showData[0];
    $data['username']=$showData[1];
    $data['password']=$showData[2];
    $data['roleid']=$showData[3];
    $data['status']=$showData[4];

    echo json_encode($data);

?>
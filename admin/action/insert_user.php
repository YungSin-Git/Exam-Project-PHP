<?php

    include ('sub_database_class.php');
    $db = new sub_databaseClass();

    $id=$_POST['txt-id'];
    $username=$_POST['txt-username'];
    $username=trim($username);
    $username=$db->real_string($username);
    $password=$_POST['txt-password'];
    $password=trim($password);
    $password=md5($password);
//    $password=password_hash($password, PASSWORD_DEFAULT);
    $password=$db->real_string($password);
    $role=$_POST['txt-role'];
    $status=$_POST['txt-status'];
    $edit=$_POST['txt-edit'];

    $response['edit']=false;
    $duplicate=$db->duplicateData("username","user","username='".$username."' AND id!=".$edit."");
    if ($duplicate == true){
        $response['duplicate']=true;
    }else{
        if ($edit == 0){
            $db->insertData("user","null,'".$username."','".$password."','".$role."','".$status."'");
            $response['id']=$db->last_id();
            $response['duplicate']=false;
        }else{
            $db->updateData("user","username='".$username."',password='".$password."',roleid='".$role."',status='".$status."'","id=".$edit."");
            $response['edit']=true;
        }
    }

    echo json_encode($response);
    
?>
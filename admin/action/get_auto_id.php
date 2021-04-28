<?php

    include ('sub_database_class.php');
    $db=new sub_databaseClass();

    $id=$_POST['id'];
    $table=array("course","student","enrollment","user");

    $response['id']=$db->getAutoID("id","$table[$id]","id DESC");

    echo json_encode($response);

?>
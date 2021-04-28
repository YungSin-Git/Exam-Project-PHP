<?php

    include ("sub_database_class.php");
    $db = new sub_databaseClass();

    $id=$_POST['id'];
    $table=array("course","student","enrollment","user");

    $count=$db->countData("$table[$id]","id>0");
    $response['total']=$count;

    echo json_encode($response);

?>
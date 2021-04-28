<?php

    include ('sub_database_class.php');
    $db = new sub_databaseClass();

    $uname=$_POST['uname'];
    $pword=$_POST['pword'];
    $pword=trim($pword);
    $pword=md5($pword);

    $db->log_in($uname,$pword);


?>
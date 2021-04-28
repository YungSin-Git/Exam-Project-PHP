<?php

    include ('sub_database_class.php');
    $db = new sub_databaseClass();

    $id=$_POST['txt-id'];
    $firstname=$_POST['txt-firstName'];
    $lastname=$_POST['txt-lastName'];
    $gender=$_POST['txt-gender'];
    $dob=$_POST['txt-dob'];
    $pob=$_POST['txt-pob'];
    $address=$_POST['txt-address'];
    $email=$_POST['txt-email'];
    $contact=$_POST['txt-contact'];
    $status=$_POST['txt-status'];
    $edit=$_POST['txt-edit'];
    $image=$_FILES["txt-file"];
    $img_path=$_POST['txt_imgpath'];

    $response['edit']=false;
    $duplicate=$db->duplicateData("contact","student","contact='".$contact."' AND id!=".$edit."");
    if ($duplicate == true){
        $response['duplicate']=true;
    }else {
        if ($edit == 0) {
            if (''!=$image['name']) {
                $image_name=$image['name'];
                $tmp=$image['tmp_name'];//tmp_name is function of php
                $newname=time();
                $ext=pathinfo($image_name, PATHINFO_EXTENSION);
                $size=$image['size'];
                $newname1=$newname.'.'.$ext;
                $response['size']=$size;
                move_uploaded_file($tmp,"../img/".$newname1);
                $newname2="img/".$newname1;
            }else{
                $newname2="img/img_1/default_bg.jpg";
            }

            $db->insertData("student","null ,'".$firstname."','".$lastname."','".$gender."','".$dob."','".$pob."',
                       '".$address."','".$email."','".$contact."','".$newname2."','".$status."'");
            $response['id'] = $db->last_id();
            $response['duplicate'] = false;
        }else{
            if (''!=$image['name']) {
                $image_name = $image['name'];
                $tmp = $image['tmp_name'];//tmp_name is function of php
                $newname = time();
                $ext = pathinfo($image_name, PATHINFO_EXTENSION);
                $newname1 = $newname . '.' . $ext;
                move_uploaded_file($tmp, "../img/" . $newname1);
                $newname2 = "img/" . $newname1;
            }else {
                $newname2=$img_path;
            }
            $db->updateData("student", "firstname='" . $firstname . "',lastname='" . $lastname . "',gender='" . $gender . "',dob='" . $dob . "',
                        pob='" . $pob . "',address='" . $address . "',email='" . $email . "',contact='" . $contact . "',image='" . $newname2 . "',status='" . $status . "'", "id=" . $edit . "");
            $response['edit'] = true;
        }
    }
    echo json_encode($response);
?>
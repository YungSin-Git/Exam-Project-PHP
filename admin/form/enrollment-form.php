<?php
    include ('../action/sub_database_class.php');
    $db = new sub_databaseClass();
?>

<div class="container-fluid">
    <div class="col-xl-6 form-box">
        <div class="col-xl-12 form-header">
            <h4>Course</h4>
            <i class="fas fa-times" id="btn-close"></i>
        </div>
        <form class="form1" method="post" enctype="multipart/form-data">
            <div class="col-xl-12 form-body">
                <input type="hidden" class="form-control" name="txt-edit" id="txt-edit" value="0">
                <label>Enrollment Id</label>
                <input type="text" class="form-control" name="txt-id" id="txt-id" readonly>
                <label>Student Name</label>
                <select class="form-control" style="margin-bottom: 10px" name="txt-student-name" id="txt-student-name">
                    <?php
                    $getData=$db->selectData("id,firstname,lastname","student","status=1","id DESC","0,1000");
                    if ($getData !='0'){
                        foreach ($getData as $row){
                            ?>
                            <option value="<?php echo $row[0] ?>"><?php echo $row[1].' '.$row[2] ?></option>
                            <?php
                        }
                    }
                    ?>
                </select>
                <label>Course Name</label>
                <select class="form-control" style="margin-bottom: 10px" name="txt-course-name" id="txt-course-name">
                    <?php
                    $getData=$db->selectData("id,name","course","status=1","id DESC","0,1000");
                    if ($getData !='0'){
                        foreach ($getData as $row){
                            ?>
                            <option value="<?php echo $row[0] ?>"><?php echo $row[1] ?></option>
                            <?php
                        }
                    }
                    ?>
                </select>
                <label>Enrollment Date</label>
                <input type="date" class="form-control" name="txt-enrollmentDate" id="txt-enrollDate">
                <label>Start Date</label>
                <input type="date" class="form-control" name="txt-startDate" id="txt-startDate">
                <label>Status</label>
                <select class="form-control" style="margin-bottom: 10px" name="txt-status" id="txt-status">
                    <option value="1">1 (1=Enable)</option>
                    <option value="2">2 (2=disable)</option>
                </select>
            </div>
            <div class="col-xl-12 form-footer">
                <a class="button-style" id="btn-post">Post</a>
            </div>
        </form>
    </div>
</div>
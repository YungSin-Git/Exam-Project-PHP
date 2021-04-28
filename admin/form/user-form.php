<?php
    include ('../action/sub_database_class.php');
    $db = new sub_databaseClass();
?>

<div class="container-fluid">
    <div class="col-xl-6 form-box">
        <div class="col-xl-12 form-header">
            <h4>User</h4>
            <i class="fas fa-times" id="btn-close"></i>
        </div>
        <form class="form1" method="post" enctype="multipart/form-data">
            <div class="col-xl-12 form-body">
                <input type="hidden" class="form-control" name="txt-edit" id="txt-edit" value="0">
                <label>User Id</label>
                <input type="text" class="form-control" name="txt-id" id="txt-id" readonly>
                <label>Username</label>
                <input type="text" class="form-control" name="txt-username" id="txt-username">
                <label>Password</label>
                <input type="password" class="form-control" name="txt-password" id="txt-password">
                <label>Role</label>
                <select class="form-control" style="margin-bottom: 10px" name="txt-role" id="txt-role">
                <?php
                    $getData=$db->selectData("id,name","role","status=1","id DESC","0,1000");
                    if ($getData !='0'){
                        foreach ($getData as $row){
                ?>
                            <option value="<?php echo $row[0] ?>"><?php echo $row[1] ?></option>
                <?php
                        }
                    }
                ?>
                </select>
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
<div class="container-fluid">
    <div class="col-xl-6 form-box">
        <div class="col-xl-12 form-header">
            <h4>Course</h4>
            <i class="fas fa-times" id="btn-close"></i>
        </div>
        <form class="form1" method="post" enctype="multipart/form-data">
            <div class="col-xl-12 form-body">
                <input type="hidden" class="form-control" name="txt-edit" id="txt-edit" value="0">
                <label>Course Id</label>
                <input type="text" class="form-control" name="txt-id" id="txt-id" readonly>
                <label>Course Name</label>
                <input type="text" class="form-control" name="txt-course-name" id="txt-course-name">
                <label>Number Of Student</label>
                <input type="text" class="form-control" name="txt-num" id="txt-num">
                <label>Start Date</label>
                <input type="date" class="form-control" name="txt-startDate" id="txt-startDate">
                <label>End Date</label>
                <input type="date" class="form-control" name="txt-endDate" id="txt-endDate">
                <label>Status</label>
                <select class="form-control" style="margin-bottom: 10px" name="txt-course-status" id="txt-course-status">
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
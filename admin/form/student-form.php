<div class="container-fluid">
    <div class="col-xl-6 form-box">
        <div class="col-xl-12 form-header">
            <h4>Student</h4>
            <i class="fas fa-times" id="btn-close"></i>
        </div>
        <form class="form1" method="post" enctype="multipart/form-data">
            <div class="col-xl-6 form-body">
                <input type="hidden" class="form-control" name="txt-edit" id="txt-edit" value="0">
                <label>Id</label>
                <input type="text" class="form-control" name="txt-id" id="txt-id" value="0" readonly>
                <label>Firstname</label>
                <input type="text" class="form-control" name="txt-firstName" id="txt-firstName">
                <label>Lastname</label>
                <input type="text" class="form-control" name="txt-lastName" id="txt-lastName">
                <label>Gender</label>
                <select class="form-control" style="margin-bottom: 10px" name="txt-gender" id="txt-gender"">
                    <option value="">Gender</option>
                    <option value="Male">Male</option>
                    <option value="Female">Female</option>
                </select>
                <label>Date of birth</label>
                <input type="date" class="form-control" name="txt-dob" id="txt-dob">
                <label>Place of birth</label>
                <input type="text" class="form-control" name="txt-pob" id="txt-pob">
            </div>
            <div class="col-xl-6 form-body">
                <label>Address</label>
                <textarea style="width: 100%;height: 65px" name="txt-address" id="txt-address"></textarea>
                <label>Email</label>
                <input type="text" class="form-control" name="txt-email" id="txt-email">
                <label>Contact</label>
                <input type="text" class="form-control" name="txt-contact" id="txt-contact">
                <label>Image</label>
                <div class="form-image_box" id="imagePreview">
                    <input type='file' id="txt-file" name="txt-file" accept=".png, .jpg, .jpeg" />
                </div>
                <input type="hidden" name="txt_imgpath" id="txt_imgpath">
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

<script>
    //Function Show Image in Form Box
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#imagePreview').css('background-image', 'url('+e.target.result +')');
                $('#imagePreview').hide();
                $('#imagePreview').fadeIn(650);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
    $("#txt-file").change(function() {
        readURL(this);
    });
</script>

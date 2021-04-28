$(document).ready(function () {

    var popup = "<div class='popup'></div>";
    var form = ['course-form.php','student-form.php','enrollment-form.php','user-form.php'];
    var button_edit = "<a class=\"button-style\" id=\"btn-edit\" style='margin-left: 20px'>Edit</a>";
    var table_data = $('#table_data');
    var indexTr;
    var numStart = 0;
    var numEnd = $('#btn-sortData').val();

    //MenuBar Function
    $("#btn-menubar").click(function () {
        if ($('#txt-menubar').val() == 0) {
            $('.left-body').css({'left': '-17%'});
            $('.right-body').css({'width':'100%'});
            $('#txt-menubar').val(1);
        } else {
            $('.left-body').css({'left': '0'});
            $('.right-body').css({'width': '83%'});
            $('#txt-menubar').val(0);
        }
    });

    // Title Bar Option
    $(".left-body").on('click','ul li',function () {
        var eThis = $(this);

        menuId = eThis.data('id');
        $('.right-body').show();
        $('.title h3').text(eThis.text());
        $('.left-body').find('li').css({'background-color':'#fff','color':'#0034ba'});
        eThis.css({'background-color':'#0034ba','color':'#fff'});
        if (menuId == 0){
            get_course_data();
            $('.title i').attr('class','fas fa-chalkboard-teacher');
        }else if (menuId == 1){
            get_student_data();
            $('.title i').attr('class','fas fa-user-graduate');
        }else if(menuId == 2){
            get_enrollment_data();
            $('.title i').attr('class','fas fa-clipboard-check');
        }else if (menuId == 3){
            get_user_data();
            $('.title i').attr('class','far fa-user');
        }
        count_data();
    });

    //Add Form
    $('#btn-add').click(function () {
        $('body').append(popup);
        $(".popup").load("form/" + form[menuId], function (responseTxt, statusTxt, xhr) {
            if (statusTxt == "success") {
                get_auto_id();
            }
            if (statusTxt == "error")
                alert("Error: " + xhr.status + ": " + xhr.statusText);
        });
    });

    //Close Form
    $('body').on('click','#btn-close',function () {
        $('.popup').remove();
    });

    //-----------------------------------------------------------

    //Button Insert Data
    $('body').on('click','#btn-post',function () {
        var eThis = $(this);
        if (menuId == 0){
            insert_course_data(eThis);
        }else if (menuId == 1){
            insert_student_data(eThis);
        }else if(menuId == 2){
            insert_enrollment_data(eThis);
        }else if (menuId == 3){
            insert_user_data(eThis);
        }
    });

    //Function Insert Course Data
    function insert_course_data(eThis) {
        var name = $('#txt-course-name');
        var numofStu = $('#txt-num');
        var startDate = $('#txt-startDate');
        var endDate = $('#txt-endDate');
        var status = $('#txt-course-status');

        if (name.val() == ''){
            alert('Please Insert Course Name');
            name.focus();
            return;
        }else if (numofStu.val() == ''){
            alert('Please Insert Number Of Student');
            numofStu.focus();
            return;
        }else if (startDate.val() == ''){
            alert('Please Select Start Date');
            startDate.focus();
            return;
        }else  if (endDate.val() == ''){
            alert('Please Select end Date');
            endDate.focus();
            return;
        }

        var frm = eThis.closest('form.form1');
        var frm_data = new FormData(frm[0]);
        $.ajax({
            url: 'action/insert_course.php',
            type: 'POST',
            data: frm_data,
            contentType: false,
            cache: false,
            processData: false,
            dataType: "json",
            // beforeSend: function (data) {
            // },
            success: function (data) {
                if (data.duplicate == true) {
                    alert('Duplicate Name, Please Insert Name Again');
                    name.val('');
                    name.focus();
                } else {
                    if (data.edit==true){
                        table_data.find('tr:eq('+indexTr+') td:eq(1)').text(name.val());
                        table_data.find('tr:eq('+indexTr+') td:eq(2)').text(numofStu.val());
                        table_data.find('tr:eq('+indexTr+') td:eq(3)').text(startDate.val());
                        table_data.find('tr:eq('+indexTr+') td:eq(4)').text(endDate.val());
                        table_data.find('tr:eq('+indexTr+') td:eq(5)').text(status.val());
                        $('.popup').remove();
                    }else {
                        var row_data = '<tr>' +
                            '<td>'+data.id+'</td>' +
                            '<td style="text-align: left">'+name.val()+'</td>' +
                            '<td>'+numofStu.val()+'</td>' +
                            '<td>'+startDate.val()+'</td>' +
                            '<td>'+endDate.val()+'</td>' +
                            '<td>'+status.val()+'</td>' +
                            '<td>'+button_edit+'</td>' +
                            '</tr>';
                        $('#table_data').find('tr:eq(0)').after(row_data);
                        name.val('');
                        name.focus();
                        numofStu.val('');
                        startDate.val('');
                        endDate.val('');
                        status.val(1);
                        $('#txt-id').val(parseInt(data.id)+1);
                    }
                }
                count_data();
            }
        });
    }

    //Function Insert Student Data
    function insert_student_data(eThis) {
        var firstname = $('#txt-firstName');
        var lastname = $('#txt-lastName');
        var gender = $('#txt-gender');
        var dob = $('#txt-dob');
        var pob = $('#txt-pob');
        var address = $('#txt-address');
        var email = $('#txt-email');
        var contact = $('#txt-contact');
        var image = $('#txt-file');
        var status = $('#txt-status');

        if (firstname.val() == ''){
            alert('Please Insert Firstname');
            firstname.focus();
            return;
        }else if (lastname.val() == ''){
            alert('Please Insert Lastname');
            lastname.focus();
            return;
        }else if (gender.val() == ''){
            alert('Please Select Gender');
            gender.focus();
            return;
        }else if (dob.val() == ''){
            alert('Please Select Date Of Birth');
            dob.focus();
            return;
        }else if (pob.val() == ''){
            alert('Please Insert Place Of Birth');
            pob.focus();
            return;
        }else if (address.val() == ''){
            alert('Please Insert Address');
            address.focus();
            return;
        }else if (email.val() == ''){
            alert('Please Insert Email');
            email.focus();
            return;
        }

        var frm = eThis.closest('form.form1');
        var frm_data = new FormData(frm[0]);
        $.ajax({
            url: 'action/insert_student.php',
            type: 'POST',
            data: frm_data,
            contentType: false,
            cache: false,
            processData: false,
            dataType: "json",
            // beforeSend: function (data) {
            // },
            success: function (data) {
                if(data.duplicate == true){
                    alert("Duplicate Contact Please Insert Again");
                    contact.focus();
                    contact.val('');
                }else {
                    if (data.edit == true){
                        table_data.find('tr:eq('+indexTr+') td:eq(1)').text(firstname.val());
                        table_data.find('tr:eq('+indexTr+') td:eq(2)').text(lastname.val());
                        table_data.find('tr:eq('+indexTr+') td:eq(3)').text(gender.val());
                        table_data.find('tr:eq('+indexTr+') td:eq(4)').text(contact.val());
                        table_data.find('tr:eq('+indexTr+') td:eq(5)').text(status.val());
                        $('.popup').remove();
                    }else {
                        var row_data = '<tr>' +
                            '<td>' + data.id + '</td>' +
                            '<td style="text-align: left">' + firstname.val() + '</td>' +
                            '<td style="text-align: left">' + lastname.val() + '</td>' +
                            '<td>' + gender.val() + '</td>' +
                            '<td>' + contact.val() + '</td>' +
                            '<td>' + status.val() + '</td>' +
                            '<td>' + button_edit + '</td>' +
                            '</tr>';
                        $('#table_data').find('tr:eq(0)').after(row_data);
                        firstname.val('');
                        firstname.focus();
                        lastname.val('');
                        gender.val('');
                        dob.val('');
                        pob.val('');
                        address.val('');
                        email.val('');
                        contact.val('');
                        image.val('');
                        status.val(1);
                        $('#imagePreview').css('background-image', 'url("img/img_1/default_bg.jpg")');
                        $('#txt-id').val(parseInt(data.id) + 1);
                    }
                }
                count_data();
            }
        });
    }

    //Function Insert Enrollment Data
    function insert_enrollment_data(eThis) {
        var studentName = $('#txt-student-name option:selected').text();
        var courseName = $('#txt-course-name option:selected').text();
        var enrollmentDate = $('#txt-enrollDate');
        var startDate = $('#txt-startDate');
        var status = $('#txt-status');

        if (enrollmentDate.val() == ''){
            alert("Please Select Enrollment Date");
            enrollmentDate.focus();
            return;
        }else if (startDate.val() == ''){
            alert('Please Select Start Date');
            startDate.focus();
            return;
        }

        var frm = eThis.closest('form.form1');
        var frm_data = new FormData(frm[0]);
        $.ajax({
            url: 'action/insert_enrollment.php',
            type: 'POST',
            data: frm_data,
            contentType: false,
            cache: false,
            processData: false,
            dataType: "json",
            // beforeSend: function (data) {
            // },
            success: function (data) {
                if (data.edit==true){
                    table_data.find('tr:eq('+indexTr+') td:eq(1)').text(studentName);
                    table_data.find('tr:eq('+indexTr+') td:eq(2)').text(courseName);
                    table_data.find('tr:eq('+indexTr+') td:eq(3)').text(enrollmentDate.val());
                    table_data.find('tr:eq('+indexTr+') td:eq(4)').text(startDate.val());
                    table_data.find('tr:eq('+indexTr+') td:eq(5)').text(status.val());
                    $('.popup').remove();
                }else {
                    var row_data = '<tr>' +
                        '<td>' + data.id + '</td>' +
                        '<td style="text-align: left">' + studentName + '</td>' +
                        '<td style="text-align: left">' + courseName+ '</td>' +
                        '<td>' + enrollmentDate.val() + '</td>' +
                        '<td>' + startDate.val() + '</td>' +
                        '<td>' + status.val() + '</td>' +
                        '<td>' + button_edit + '</td>' +
                        '</tr>';
                    $('#table_data').find('tr:eq(0)').after(row_data);
                    enrollmentDate.val('');
                    startDate.val('');
                    status.val('1');
                    $('#txt-id').val(parseInt(data.id) + 1);
                }
                count_data();
            }
        });
    }

    //Function Insert User Data
    function insert_user_data(eThis) {
        var username = $('#txt-username');
        var password = $('#txt-password');
        var role = $('#txt-role option:selected').text();
        var status = $('#txt-status');

        if (username.val() == ''){
            alert("Insert Username");
            username.focus();
            return;
        }else if (password.val() ==''){
            alert("Insert Password");
            password.focus();
            return;
        }

        var frm = eThis.closest('form.form1');
        var frm_data = new FormData(frm[0]);
        $.ajax({
            url: 'action/insert_user.php',
            type: 'POST',
            data: frm_data,
            contentType: false,
            cache: false,
            processData: false,
            dataType: "json",
            // beforeSend: function (data) {
            // },
            success: function (data) {
                if (data.duplicate == true){
                    alert("Duplicate Username");
                }else {
                    if (data.edit == true){
                        table_data.find('tr:eq('+indexTr+') td:eq(1)').text(username.val());
                        table_data.find('tr:eq('+indexTr+') td:eq(2)').text(role);
                        table_data.find('tr:eq('+indexTr+') td:eq(3)').text(status.val());
                        $('.popup').remove();
                    }else {
                        var row_data = '<tr>' +
                            '<td>' + data.id + '</td>' +
                            '<td style="text-align: left">' + username.val() + '</td>' +
                            '<td>' + role + '</td>' +
                            '<td>' + status.val() + '</td>' +
                            '<td>' + button_edit + '</td>' +
                            '</tr>';
                        $('#table_data').find('tr:eq(0)').after(row_data);
                        username.val('');
                        username.focus();
                        password.val('');
                        $('#txt-id').val(parseInt(data.id) + 1);
                    }
                }
                count_data();
            }
        });
    }

    //-----------------------------------------------------------

    //Function Get Auto ID
    function get_auto_id() {
        $.ajax({
            url:'action/get_auto_id.php',
            type:'POST',
            cache:false,
            data:{id:menuId},
            dataType:'JSON',
            success:function (data) {
                $('#txt-id').val(parseInt(data.id)+1);
            }
        });
    }

    //Function Get Course Data
    function get_course_data() {
        var txt = '';
        var row_header = '<tr>' +
            '<th class="none-borderLeft">ID</th>' +
            '<th>Course Name</th>' +
            '<th width="200">No Of Student</th>' +
            '<th>Start Date</th>' +
            '<th>End Date</th>' +
            '<th>Status</th>' +
            '<th width="100">Action</th>' +
            '</tr>';
        $('#table_data').html((row_header));
        $.ajax({
            url: 'action/get_course.php',
            type: 'POST',
            data: {id:menuId,startNum:numStart,endNum:numEnd},
            cache: false,
            dataType: "json",
            success: function (data) {
                if (data.length == 0){
                    alert('No Data');
                }else {
                   for (i = 0; i<data.length; i++){
                        var row_data = '<tr>' +
                            '<td>'+data[i].id+'</td>' +
                            '<td style="text-align: left">'+data[i].name+'</td>' +
                            '<td>'+data[i].seatLimit+'</td>' +
                            '<td>'+data[i].startDate+'</td>' +
                            '<td>'+data[i].endDate+'</td>' +
                            '<td>'+data[i].status+'</td>' +
                            '<td>'+button_edit+'</td>' +
                            '</tr>';
                        txt += row_data;
                    }
                }
                $('#table_data').html(row_header+txt);
            }
        });
    }

    //Function Get Student Data
    function get_student_data(){
        var txt = '';
        var row_header = '<tr>' +
            '<th class="none-borderLeft">ID</th>' +
            '<th>Firstname</th>' +
            '<th>Lastname</th>' +
            '<th width="100">Gender</th>' +
            '<th>Contact</th>' +
            '<th>Status</th>' +
            '<th width="100">Action</th>' +
            '</tr>';
        $('#table_data').html((row_header));
        $.ajax({
            url: 'action/get_student.php',
            type: 'POST',
            data: {id:menuId,startNum:numStart,endNum:numEnd},
            cache: false,
            dataType: "json",
            success: function (data) {
                if (data.length == 0){
                    alert('No Data');
                }else {
                    for (i = 0; i<data.length; i++){
                        var row_data = '<tr>' +
                            '<td>'+data[i].id+'</td>' +
                            '<td style="text-align: left">'+data[i].firstname+'</td>' +
                            '<td style="text-align: left">'+data[i].lastname+'</td>' +
                            '<td>'+data[i].gender+'</td>' +
                            '<td>'+data[i].contact+'</td>' +
                            '<td>'+data[i].status+'</td>' +
                            '<td>'+button_edit+'</td>' +
                            '</tr>';
                        txt += row_data;
                    }
                }
                $('#table_data').html(row_header+txt);
            }
        });
    }

    //Function Get Enrollment Data
    function get_enrollment_data(){
        var txt = '';
        var row_header = '<tr>' +
            '<th class="none-borderLeft">ID</th>' +
            '<th>Student Name</th>' +
            '<th>Course Name</th>' +
            '<th width="200">Enrollment Date</th>' +
            '<th>Start Date</th>' +
            '<th>Status</th>' +
            '<th width="100">Action</th>' +
            '</tr>';
        $('#table_data').html((row_header));
        $.ajax({
            url: 'action/get_enrollment.php',
            type: 'POST',
            data: {id: menuId, startNum: numStart, endNum: numEnd},
            cache: false,
            dataType: "json",
            success: function (data) {
                if (data.length == 0){
                    alert('No Data');
                }else {
                    for (i = 0; i<data.length; i++){
                        var row_data = '<tr>' +
                            '<td>'+data[i].id+'</td>' +
                            '<td style="text-align: left">'+data[i].firstname+' '+data[i].lastname+'</td>' +
                            '<td style="text-align: left">'+data[i].name+'</td>' +
                            '<td>'+data[i].enrollmentDate+'</td>' +
                            '<td>'+data[i].startDate+'</td>' +
                            '<td>'+data[i].status+'</td>' +
                            '<td>'+button_edit+'</td>' +
                            '</tr>';
                        txt += row_data;
                    }
                }
                $('#table_data').html(row_header+txt);
            }
        });
    }

    //Function Get User Data
    function get_user_data(){
        var txt = '';
        var row_header = '<tr>' +
            '<th class="none-borderLeft">ID</th>' +
            '<th>Username</th>' +
            '<th>Role</th>' +
            '<th>Status</th>' +
            '<th width="100">Action</th>' +
            '</tr>';
        $('#table_data').html((row_header));
        $.ajax({
            url: 'action/get_user.php',
            type: 'POST',
            data: {id:menuId,startNum:numStart,endNum:numEnd},
            cache: false,
            dataType: "json",
            success: function (data) {
                if (data.length == 0){
                    alert('No Data');
                }else {
                    for (i = 0; i<data.length; i++){
                        var row_data = '<tr>' +
                            '<td>'+data[i].id+'</td>' +
                            '<td style="text-align: left">'+data[i].username+'</td>' +
                            '<td>'+data[i].name+'</td>' +
                            '<td>'+data[i].status+'</td>' +
                            '<td>'+button_edit+'</td>' +
                            '</tr>';
                        txt += row_data;
                    }
                }
                $('#table_data').html(row_header+txt);
            }
        });
    }

    //-----------------------------------------------------------

    //Button Edit Data
    $('body').on('click','#btn-edit',function () {
        var eThis = $(this);
        if (menuId == 0){
            edit_course(eThis);
        }else if (menuId == 1){
            edit_student(eThis);
        }else if (menuId == 2){
            edit_enrollment(eThis);
        }else if (menuId == 3){
            edit_user(eThis);
        }
    });

    //Function Edit Course Data
    function edit_course(eThis) {
        $('body').append(popup);
        $.ajax({
            url:'form/'+form[menuId],
            type: 'POST',
            data: [],
            cache: false,
            success: function (data) {
                $('.popup').append(data);
                var tr = eThis.parents('tr');
                indexTr = tr.index();
                var id = tr.find('td:eq(0)').text();
                var name = tr.find('td:eq(1)').text();
                var num = tr.find('td:eq(2)').text();
                var startDate = tr.find('td:eq(3)').text();
                var endDate = tr.find('td:eq(4)').text();
                var status = tr.find('td:eq(5)').text();
                $('#txt-id').val(id);
                $('#txt-course-name').val(name);
                $('#txt-num').val(num);
                $('#txt-startDate').val(startDate);
                $('#txt-endDate').val(endDate);
                $('#txt-course-status').val(status);
                $('#txt-edit').val(id);
            }
        });
    }

    //Function Edit Student Data
    function edit_student(eThis) {
        var trIndex=eThis.parents('tr').find('td:eq(0)').text();
        $('body').append(popup);
        $(".popup").load("form/"+form[menuId], function(responseTxt, statusTxt, xhr) {
            if (statusTxt == "success")
            var tr = eThis.parents('tr');
            indexTr = tr.index();
            $.ajax({
                url: 'action/get_student_currentData.php',
                type: 'POST',
                cache: false,
                data: {id: trIndex},
                dataType: 'json',
                success: function (data) {
                    $('#txt-id').val(data.id);
                    $('#txt-edit').val(data.id);
                    $('#txt-firstName').val(data.firstname);
                    $('#txt-lastName').val(data.lastname);
                    $('#txt-gender').val(data.gender);
                    $('#txt-dob').val(data.dob);
                    $('#txt-pob').val(data.pob);
                    $('#txt-address').val(data.address);
                    $('#txt-email').val(data.email);
                    $('#txt-contact').val(data.contact);
                    $('#imagePreview').css('background-image', 'url("'+data.image+'")');
                    $('#txt-status').val(data.status);
                    $('#txt_imgpath').val(data.image);
                }
            });
            if(statusTxt == "error")
                alert("Error: " + xhr.status + ": " + xhr.statusText);
        });
    }

    //Function Edit Enrollment Data
    function edit_enrollment(eThis) {
        var trIndex=eThis.parents('tr').find('td:eq(0)').text();
        $('body').append(popup);
        $(".popup").load("form/"+form[menuId], function(responseTxt, statusTxt, xhr) {
            if (statusTxt == "success")
                var tr = eThis.parents('tr');
            indexTr = tr.index();
            $.ajax({
                url: 'action/get_enrollment_currentData.php',
                type: 'POST',
                cache: false,
                data: {id: trIndex},
                dataType: 'json',
                success: function (data) {
                    $('#txt-id').val(data.id);
                    $('#txt-edit').val(data.id);
                    $('#txt-student-name').val(data.studentID);
                    $('#txt-course-name').val(data.courseID);
                    $('#txt-enrollDate').val(data.enrollmentDate);
                    $('#txt-startDate').val(data.startDate);
                    $('#txt-status').val(data.status);
                }
            });
            if(statusTxt == "error")
                alert("Error: " + xhr.status + ": " + xhr.statusText);
        });
    }

    //Function Edit User Data
    function edit_user(eThis) {
        var trIndex=eThis.parents('tr').find('td:eq(0)').text();
        $('body').append(popup);
        $(".popup").load("form/"+form[menuId], function(responseTxt, statusTxt, xhr) {
            if (statusTxt == "success")
                var tr = eThis.parents('tr');
            indexTr = tr.index();
            $.ajax({
                url: 'action/get_user_currentData.php',
                type: 'POST',
                cache: false,
                data: {id: trIndex},
                dataType: 'json',
                success: function (data) {
                    $('#txt-id').val(data.id);
                    $('#txt-edit').val(data.id);
                    $('#txt-username').val(data.username);
                    $('#txt-password').val(data.password);
                    $('#txt-role').val(data.roleid);
                    $('#txt-status').val(data.status);
                }
            });
            if(statusTxt == "error")
                alert("Error: " + xhr.status + ": " + xhr.statusText);
        });
    }

    //-----------------------------------------------------------

    //Function Count Data
    function count_data(){
        $.ajax({
            url: 'action/count_data.php',
            type: 'POST',
            data: {id: menuId},
            cache: false,
            dataType: "json",
            success: function (data) {
                $('#num-record').text(data.total);
                $('#num-totalpage').text(Math.ceil(data.total/numEnd));
            }
        });
    }

    //-----------------------------------------------------------

    //Button Sort Data
    $('#btn-sortData').change(function () {
        var eThis = $(this);
        numStart = 0;
        numEnd = eThis.val();
        if (menuId == 0){
            get_course_data();
        }else if (menuId == 1){
            get_student_data();
        }else if (menuId == 2){
            get_enrollment_data();
        }else if (menuId == 3){
            get_user_data();
        }
        count_data();
    });

    //Button Next
    $('#btn-next').click(function () {
        if ($('#num-currentpage').text()>=$('#num-totalpage').text()){
            return;
        }
        numStart+=parseInt(numEnd);
        $('#num-currentpage').text(parseInt($('#num-currentpage').text())+1);
        if (menuId == 0){
            get_course_data();
        }else if (menuId == 1){
            get_student_data();
        }else if (menuId == 2){
            get_enrollment_data();
        }else if (menuId == 3){
            get_user_data();
        }
    });

    //Button Back
    $('#btn-back').click(function () {
        if ($('#num-currentpage').text()<=1){
            return;
        }
        numStart-=parseInt(numEnd);
        $('#num-currentpage').text(parseInt($('#num-currentpage').text())-1);
        if (menuId == 0){
            get_course_data();
        }else if (menuId == 1){
            get_student_data();
        }else if (menuId == 2){
            get_enrollment_data();
        }else if (menuId == 3){
            get_user_data();
        }
    });
});
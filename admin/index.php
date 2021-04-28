<?php
    session_start();
    session_destroy();
?>

<!doctype html>
<html class="no-js" lang="">
<head>
    <meta charset="utf-8">
    <title>LogIn</title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="css/fontawesome-free-5.3.1-web/css/all.min.css">
    <link rel="stylesheet" href="css/bootstrap-4.3.1-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/admin-style.css">

    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/dashboard-event.js"></script>
</head>
<body>
    <div class="background-login">
        <div class="background-color-login">
            <div class="login-box">
                <h3>ACCOUNT LOGIN</h3>
                <div class="login-small-box">
                    <label><i class="fas fa-user"></i>UserName</label><br>
                    <input type="text" placeholder="UserName" id="txt-login-username" name="txt-login-username">
                    <label><i class="fas fa-lock"></i>Password</label><br>
                    <input type="password" placeholder="Password" id="txt-login-password" name="txt-login-password">
                    <div class="login-btn" id="btn-login">
                        LogIn
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    $(document).ready(function () {
        $('#btn-login').click(function () {
            var username = $('#txt-login-username');
            var password = $('#txt-login-password');

            if (username.val() == ''){
                alert("Insert Username");
                username.focus();
                return;
            }else if (password.val() == ''){
                alert("Insert Password");
                password.focus();
                return;
            }

            $.ajax({
                url: 'action/login.php',
                type: 'POST',
                data: {uname:username.val(),pword:password.val()},
                cache: false,
                dataType: "json",
                success: function (data) {
                    if (data.login==0){
                        alert('Username And Password Not Match')
                    }else{
                        alert('Log In Success');
                       window.location.href="dashboard.php";
                    }
                }
            });
        });
    });
</script>
</html>
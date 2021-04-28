<?php
    session_start();
    if (!isset($_SESSION['userID'])){
        header('Location:index.php');
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>

    <link rel="stylesheet" href="css/fontawesome-free-5.3.1-web/css/all.min.css">
    <link rel="stylesheet" href="css/bootstrap-4.3.1-dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="css/admin-style.css">
    <link href="https://fonts.googleapis.com/css2?family=Gothic+A1&family=Heebo:wght@300&display=swap" rel="stylesheet">

    <script src="js/jquery-3.2.1.min.js"></script>
    <script src="js/dashboard-event.js"></script>

</head>
<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-xl-12 header">
            <div class="col-xl-2 left-header">
                <i class="fas fa-bars" id="btn-menubar"></i>
                <input type="hidden" value="0" id="txt-menubar">
            </div>
            <div class="col-xl-8 mid-header">
                <h5>
                    Course Enrollment System
                </h5>
            </div>
            <div class="col-xl-2 right-header">
                <span>
                    <i class="far fa-user"></i>
                     <?php
                         echo $_SESSION['username'];
                     ?>
                </span>
                <a href="index.php">
                    <i class="fas fa-sign-out-alt"></i>
                </a>
            </div>
        </div>
        <div class="col-xl-12 body">
            <div class="col-xl-12 left-body">
                <ul>
                    <li data-id="0"><i class="fas fa-chalkboard-teacher"></i>Course</li>
                    <li data-id="1"><i class="fas fa-user-graduate"></i>Student</li>
                    <li data-id="2"><i class="fas fa-clipboard-check"></i>Enrollment</li>
                    <li data-id="3"><i class="far fa-user"></i>User</li>
                </ul>
            </div>
            <div class="col-xl-12 right-body">
                <div class="col-xl-12 right-body-bar">
                    <div class="col-xl-3 title">
                        <i class="fas fa-bars"></i>
                        <h3>Title</h3>
                    </div>
                    <div class="col-xl-9 button">
                        <ul>
                            <li class="button-style" id="btn-add">Add</li>
                            <li class="button-style" id="btn-back"><</li>
                            <li class="button-style" id="btn-next">></li>
                            <li class="button-style"><span id="num-currentpage">1</span>/<span id="num-totalpage">0</span> of <span id="num-record">0</span></li>
                            <li class="button-style">
                                <select id="btn-sortData">
                                    <option value="5">5</option>
                                    <option value="10">10</option>
                                    <option value="15">15</option>
                                    <option value="20">20</option>
                                </select>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-12 table-box">
                    <table id="table_data"></table>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
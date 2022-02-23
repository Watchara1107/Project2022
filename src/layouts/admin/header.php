<?php
            include("../connection.php");
            session_start();
            ob_start();
            if (!isset($_SESSION['user_login'])) {
                header("location: login_form.php");
            }

            $id = $_SESSION['user_login'];

            $select_stmt = $db->prepare("SELECT * FROM person WHERE per_no = :uid");
            $select_stmt->execute(array(':uid' => $id));
            $row = $select_stmt->fetch(PDO::FETCH_ASSOC);

           ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width initial-scale=1.0">
    <title>Admin|Dashboard</title>
    <!-- GLOBAL MAINLY STYLES-->
    <link href="../assets/vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link href="../assets/vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
    <link href="../assets/vendors/themify-icons/css/themify-icons.css" rel="stylesheet" />
    <!-- PLUGINS STYLES-->
    <link href="../assets/vendors/jvectormap/jquery-jvectormap-2.0.3.css" rel="stylesheet" />
    <!-- THEME STYLES-->
    <link href="../assets/css/main.min.css" rel="stylesheet" />
    <!-- PAGE LEVEL STYLES-->
</head>

<body class="fixed-navbar">
    <div class="page-wrapper">
        <!-- START HEADER-->
        <header class="header">
            <div class="page-brand">
                <a class="link" href="../welcome.php">
                    <span class="brand">Social
                        <span class="brand-tip">Network</span>
                    </span>
                    <span class="brand-mini"></span>
                </a>
            </div>
            <div class="flexbox flex-1">
                <!-- START TOP-LEFT TOOLBAR-->
                <ul class="nav navbar-toolbar">
                    <li>
                        <a class="nav-link sidebar-toggler js-sidebar-toggler"><i class="ti-menu"></i></a>
                    </li>
                    <li>
                        <form class="navbar-search" action="javascript:;">
                            <div class="rel">
                                <span class="search-icon"><i class="ti-search"></i></span>
                                <input class="form-control" placeholder="Search here...">
                            </div>
                        </form>
                    </li>
                </ul>
                <!-- END TOP-LEFT TOOLBAR-->
                <!-- START TOP-RIGHT TOOLBAR-->
                <ul class="nav navbar-toolbar">
                    <li class="dropdown dropdown-inbox">
                   
                    <li class="dropdown dropdown-user">
                        <a class="nav-link dropdown-toggle link" data-toggle="dropdown">
                            <img src="../assets/img/admin-avatar.png" />
                            <span></span>Admin<i class="fa fa-angle-down m-l-5"></i></a>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <a class="dropdown-item" href="profile.html"><i class="fa fa-user"></i>Profile</a>
                            <li class="dropdown-divider"></li>
                            <a class="dropdown-item" href="../logout.php"><i class="fa fa-power-off"></i>Logout</a>
                        </ul>
                    </li>
                </ul>
                <!-- END TOP-RIGHT TOOLBAR-->
            </div>
        </header>
        <!-- END HEADER-->
        <!-- START SIDEBAR-->
        <nav class="page-sidebar" id="sidebar">
            <div id="sidebar-collapse">
                <div class="admin-block d-flex">
                    <div>
                        <img src="../assets/img/admin-avatar.png" width="45px" />
                    </div>
                    <div class="admin-info">
                        <div class="font-strong">สวัสดีคุณ </div>
                        <small><?php if (isset($_SESSION['user_login'])) {
                            echo $row['per_fname'],$row['per_name']." ". $row['per_lname'];} ?></small></div>
                </div>
                <ul class="side-menu metismenu">
                    <li>
                        <a href="../admin/editprofile.php?update_id=<?php if (isset($_SESSION['user_login'])) {
                            echo $row['per_no'];} ?>">
                            <i class="sidebar-item-icon fa fa-edit"></i>
                            <span class="nav-label">แก้ไขข้อมูลส่วนตัว</span>
                        </a>
                    </li>
                    <li>
                        <a href="javascript:;"><i class="sidebar-item-icon fa fa-edit"></i>
                            <span class="nav-label">เพิ่มรูปภาพประจำตัว</span></a>
                    </li>
                    <li>
                        <a href="../admin/editpass.php?update_id=<?php if (isset($_SESSION['user_login'])) {
                            echo $row['per_no'];} ?>">
                            <i class="sidebar-item-icon fa fa-edit"></i>
                            <span class="nav-label">เปลี่ยนรหัสผ่าน</span></a>       
                    </li>
                    <li>
                        <a href="javascript:;"><i class="sidebar-item-icon fa fa-edit"></i>
                            <span class="nav-label">โพสต์ข้อความ</span></a>       
                    </li>
                    <li>
                        <a href="javascript:;"><i class="sidebar-item-icon fa fa-edit"></i>
                            <span class="nav-label">แสดงข้อมูลการโพสต์</span></a>       
                    </li>
                </ul>
            </div>
        </nav>
        <!-- END SIDEBAR-->
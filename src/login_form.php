<?php

require_once('connection.php');

session_start();


if (isset($_SESSION['user_login'])) {
    header("location: welcome.php");
}

if (isset($_REQUEST['btn_login'])) {
    $username = strip_tags($_REQUEST['per_username']);
    $password = strip_tags($_REQUEST['per_password']);

    if (empty($username)) {
        $errorMsg[] = "กรุณากรอกชื่อผู้ใช้งานระบบ";
    } else if (empty($password)) {
        $errorMsg[] = "กรุณากรอกรหัสผ่าน";
    } else {
        try {
            $select_stmt = $db->prepare("SELECT * FROM person WHERE per_username = :uusername");
            $select_stmt->execute(array(':uusername' => $username));
            $row = $select_stmt->fetch(PDO::FETCH_ASSOC);

            if ($select_stmt->rowCount() > 0) {
                if ($username == $row['per_username']) {
                    if ($password == $row['per_password']) {
                        $_SESSION['user_login'] = $row['per_no'];
                        $loginMsg = "เข้าสู่ระบบสำเร็จ";
                        header("refresh:2;welcome.php");
                    } else {
                        $errorMsg[] = "รหัสผ่านผิด!";
                    }
                } else {
                    $errorMsg[] = "ชื่อผู้ใช้งานไม่ถูกต้อง";
                }
            } else {
                $errorMsg[] = "ชื่อผู้ใช้งานไม่ถูกต้อง";
            }
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ลงชื่อเข้าใช้งาน</title>
    <link rel="stylesheet" href="../node_modules/bootstrap/dist/css/bootstrap.min.css">
</head>

<body>
    <?php include("layouts/navbar.php"); ?>
    <div class="container">
        <br><br><br>
        <div class="row mt-4">
            <div class="col-10 mx-auto">

                <div class="card">
                    <div class="card-header">
                        <h4 class="text-center"> <strong>ระบบลงชื่อเข้าใช้งาน</strong> </h4>
                    </div>
                    <div class="card-body">
                        <form action="" method="post" class="form-horizontal mt-2">
                            <?php
                            if (isset($errorMsg)) {
                                foreach ($errorMsg as $error) {
                            ?>
                                    <div class="alert alert-danger">
                                        <strong><?php echo $error; ?></strong>
                                    </div>
                            <?php
                                }
                            }
                            ?>

                            <?php
                            if (isset($loginMsg)) {
                            ?>
                                <div class="alert alert-success">
                                    <strong><?php echo $loginMsg; ?></strong>
                                </div>
                            <?php
                            }
                            ?>
                            <div class="mb-3">
                                <label for="username" class="form-label">ชื่อเข้าใช้งานระบบ</label>
                                <input type="text" class="form-control" name="per_username" id="username">
                            </div>
                            <div class="mb-3">
                                <label for="Password" class="form-label">รหัสผ่าน</label>
                                <input type="password" class="form-control" name="per_password" id="Password">
                            </div>
                            <button type="submit" name="btn_login" class="btn btn-primary">เข้าสู่ระบบ</button>
                        </form>
                    </div>
                </div>




            </div>
        </div>
    </div>
    <br><br><br><br><br>
    <?php include("layouts/footer.php"); ?>
    <!-- bootstarp 5 -->
    <script src="../node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="../node_modules/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="../node_modules/popper.js/dist/esm/popper.min.js"></script>
</body>

</html>
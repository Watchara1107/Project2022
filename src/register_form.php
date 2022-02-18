<?php
require_once('connection.php');
if (isset($_REQUEST['btn_register'])) {
    $no = strip_tags($_REQUEST['per_no']);
    $fname = strip_tags($_REQUEST['per_fname']);
    $name = strip_tags($_REQUEST['per_name']);
    $lname = strip_tags($_REQUEST['per_lname']);
    $idcard = strip_tags($_REQUEST['per_idcard']);
    $sex = strip_tags($_REQUEST['per_sex']);
    $address = strip_tags($_REQUEST['per_address']);
    $email = strip_tags($_REQUEST['per_email']);
    $datereg = strip_tags($_REQUEST['per_datereg']);
    $username = strip_tags($_REQUEST['per_username']);
    $password = strip_tags($_REQUEST['per_password']);

    if (empty($no)) {
        $errorMsg[] = "กรุณากรอกรหัสสมาชิก";
    } elseif (empty($fname)) {
        $errorMsg[] = "กรุณากรอกคำนำหน้าชื่อ";
    } elseif (empty($name)) {
        $errorMsg[] = "กรุณากรอกชื่อสมาชิก";
    } elseif (empty($lname)) {
        $errorMsg[] = "กรุณากรอกนามสกุล";
    } elseif (empty($idcard)) {
        $errorMsg[] = "กรุณากรอกหมายเลขประจำตัวประชาชน";
    } elseif (empty($sex)) {
        $errorMsg[] = "กรุณากรอกเพศ";
    } elseif (empty($address)) {
        $errorMsg[] = "กรุณากรอกที่อยู่";
    } elseif (empty($email)) {
        $errorMsg[] = "กรุณากรอกอีเมล";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errorMsg[] = "รูปแบบอีเมลไม่ถูกต้องกรุณาลองใหม่อีกครั้ง";
    } elseif (empty($datereg)) {
        $errorMsg[] = "กรุณากรอกวันที่ลงทะเบียน";
    } elseif (empty($username)) {
        $errorMsg[] = "กรุณากรอกชื่อผู้ใช้งานระบบ";
    } elseif (empty($password)) {
        $errorMsg[] = "กรุณากรอกรหัสผ่าน";
    } elseif (strlen($password) < 4) {
        $errorMsg[] = "กรูณากรอกรหัสผ่านให้มากว่า 4 ตัวอักษร";
    } else {
        try {
            $select_stmt = $db->prepare("SELECT per_username, per_email FROM person WHERE per_username = :uusername OR per_email = :uemail");
            $select_stmt->execute(array(':uusername' => $username, ':uemail' => $email));
            $row = $select_stmt->fetch(PDO::FETCH_ASSOC);
            if ($row) {
                if (($row['per_username'] == $username)) {
                    $errorMsg[] = "ชื่อผู้ใช้งานระบบนี้มีอยู่ในฐานข้อมูลแล้ว";
                }
            } elseif (!isset($errorMsg)) {
                $insert_stmt = $db->prepare("INSERT INTO person (per_no, per_fname, per_name,
                per_lname, per_idcard, per_sex, per_address, per_email, per_datereg,  per_username,  
                per_password)VALUES (:uno, :ufname, :uname, :ulname, :uidcard, :usex, :uaddress, 
                :uemail, :udatereg, :uusername, :upassword)");
                if ($insert_stmt->execute(array(
                    ':uno' => $no,
                    ':ufname' => $fname,
                    ':uname' => $name,
                    ':ulname' => $lname,
                    ':uidcard' => $idcard,
                    ':usex' => $sex,
                    ':uaddress' => $address,
                    ':uemail' => $email,
                    ':udatereg' => $datereg,
                    ':uusername' => $username,
                    ':upassword' => $password
                ))) {
                    $registerMsg = "ลงทะเบียนสมาชิกสำเร็จ";
                }
            }
        } catch (PDOException $e) {
            $e->getMessage();
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
    <title>ลงทะเบียนสมัครสมาชิก</title>
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
                        <h5 class="text-center"> <strong>ระบบลงทะเบียนสมาชิก</strong> </h5>
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
                            if (isset($registerMsg)) {
                            ?>
                                <div class="alert alert-success">
                                    <strong><?php echo $registerMsg; ?></strong>
                                </div>
                            <?php
                            }
                            ?>

                            <div class="mb-3">
                                <label for="per_no" class="form-label">รหัสสมาชิก</label>
                                <input type="text" class="form-control" name="per_no" id="per_no">
                            </div>

                            <div class="mb-3">
                                <label for="per_fname" class="form-label">คำนำหน้า</label>
                                <input type="text" class="form-control" name="per_fname" id="per_fname">
                            </div>

                            <div class="mb-3">
                                <label for="per_name" class="form-label">ชื่อสมาชิก</label>
                                <input type="text" class="form-control" name="per_name" id="per_name">
                            </div>

                            <div class="mb-3">
                                <label for="per_lname" class="form-label">นามสกุล</label>
                                <input type="text" class="form-control" name="per_lname" id="per_lname">
                            </div>

                            <div class="mb-3">
                                <label for="per_idcard" class="form-label">หมายเลขประจำตัวประชาชน</label>
                                <input type="text" class="form-control" name="per_idcard" id="per_idcard">
                            </div>

                            <div class="mb-3">
                                <label for="per_sex" class="form-label">เพศ</label>
                                <input type="text" class="form-control" name="per_sex" id="per_sex">
                            </div>

                            <div class="mb-3">
                                <label for="per_address" class="form-label">ที่อยู่</label>
                                <input type="text" class="form-control" name="per_address" id="per_address">
                            </div>

                            <div class="mb-3">
                                <label for="per_email" class="form-label">อีเมลล์</label>
                                <input type="text" class="form-control" name="per_email" id="per_email">
                            </div>

                            <div class="mb-3">
                                <label for="per_datereg" class="form-label">วันที่ลงทะเบียน</label>
                                <input type="date" class="form-control" name="per_datereg" id="per_datereg">
                            </div>

                            <div class="mb-3">
                                <label for="per_username" class="form-label">ชื่อเข้าใช้งานระบบ</label>
                                <input type="text" class="form-control" name="per_username" id="per_username">
                            </div>
                            <div class="mb-3">
                                <label for="Password" class="form-label">รหัสผ่าน</label>
                                <input type="password" class="form-control" name="per_password" id="Password">
                            </div>
                            <div class="text-center">
                                <button type="submit" name="btn_register" class="btn btn-primary">บันทึก</button>
                                <a href="" class="btn btn-success">ยกเลิก</a>
                            </div>
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
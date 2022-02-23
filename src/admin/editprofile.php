<?php include("../layouts/admin/header.php") ?>

<?php 
if(isset($_REQUEST['update_id'])){
    try{
        $id = $_REQUEST['update_id'];
        $select_stmt = $db->prepare('SELECT * FROM person WHERE per_id = :id');
        $select_stmt->bindParam(":id",$id);
        $select_stmt->execute();
        $row = $select_stmt->fetch(PDO::FETCH_ASSOC);
        extract($row);
    }catch(PDOException $e){
        $e->getMessage();
    }
}

if(isset($_REQUEST['btn_update'])){
    try{
        
        $fname = $_REQUEST['per_fname'];
        $name = $_REQUEST['per_name'];
        $lname = $_REQUEST['per_lname'];
        $idcard = $_REQUEST['per_idcard'];
        $sex = $_REQUEST['per_sex'];
        $address = $_REQUEST['per_address'];
        $email = $_REQUEST['per_email'];



        if(!isset($errorMsg)){
            $update_stmt = $db->prepare('UPDATE person SET per_fname = :fname_up, per_name = :name_up, 
            per_lname = :lname_up, per_idcard = :idcard_up, per_sex = :sex_up, per_address = :address_up,
            per_email = :email_up WHERE per_no = :id');
            $update_stmt->bindParam(":fname_up",$fname);
            $update_stmt->bindParam(":name_up",$name);
            $update_stmt->bindParam(":lname_up",$lname);
            $update_stmt->bindParam(":idcard_up",$idcard);
            $update_stmt->bindParam(":sex_up",$sex);
            $update_stmt->bindParam(":address_up",$address);
            $update_stmt->bindParam(":email_up",$email);
            $update_stmt->bindParam(":id",$id);
        }
        if($update_stmt->execute()){
            $updateMsg = "แก้ไขข้อมูลส่วนตัวเรียบร้อยแล้ว";
            header("refresh:2;../welcome.php");
        }

    }catch(PDOException $e){
     $e->getMessage();
    }
}

?>

<div class="content-wrapper">
    <!-- START PAGE CONTENT-->
    <div class="page-content fade-in-up">
        <div class="row">
            <div class="col-lg-12 col-md-6">
                <div class="ibox">
                    <div class="ibox-head">
                        <div class="ibox-title">แก้ไขข้อมูลส่วนตัว</div>

                    </div>
                    <div class="ibox-body">
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
                            if (isset($updateMsg)) {
                            ?>
                                <div class="alert alert-success">
                                    <strong><?php echo $updateMsg; ?></strong>
                                </div>
                            <?php
                            }
                            ?>
                            <div class="form-group">
                                <label>คำนำหน้าชื่อ</label>
                                <input class="form-control" type="text" name="per_fname" value="<?php echo $row['per_fname']; ?>">
                            </div>
                            <div class="form-group">
                                <label>ชื่อสมาชิก</label>
                                <input class="form-control" type="text" name="per_name" value="<?php echo $row['per_name']; ?>">
                            </div>
                            <div class="form-group">
                                <label>นามสกุล</label>
                                <input class="form-control" type="text" name="per_lname" value="<?php echo $row['per_lname']; ?>">
                            </div>
                            <div class="form-group">
                                <label>หมายเลขบัตรประจำตัวประชาชน</label>
                                <input class="form-control" type="text" name="per_idcard" value="<?php echo $row['per_idcard'];; ?>">
                            </div>
                            <div class="form-group">
                                <label>เพศ</label>
                                <input class="form-control" type="text" name="per_sex" value="<?php echo $row['per_sex']; ?>">
                            </div>
                            <div class="form-group">
                                <label>ที่อยู่</label>
                                <input class="form-control" type="text" name="per_address" value="<?php echo $row['per_address']; ?>">
                            </div>
                            <div class="form-group">
                                <label>อีเมล</label>
                                <input class="form-control" type="email" name="per_email" value="<?php echo $row['per_email']; ?>">
                            </div>
                            <div class="form-group">
                                <button class="btn btn-primary" name="btn_update" type="submit">แก้ไข</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    

    <?php include("../layouts/admin/footer.php")  ?>
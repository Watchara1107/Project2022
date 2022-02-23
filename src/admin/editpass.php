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
        
        $password = $_REQUEST['per_password'];

        if(!isset($errorMsg)){
            $update_stmt = $db->prepare('UPDATE person SET per_password = :password_up WHERE per_no = :id');
            $update_stmt->bindParam(":password_up",$password);
            $update_stmt->bindParam(":id",$id);
        }
        if($update_stmt->execute()){
            $updateMsg = "แก้ไขรหัสผ่านเรียบร้อยแล้ว";
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
                        <div class="ibox-title">เปลี่ยนรหัสผ่าน</div>

                    </div>
                    <div class="ibox-body">
                        <form action="" method="POST">
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
                                <label>รหัสผ่านใหม่</label>
                                <input class="form-control" type="text" name="per_password" value="<?php echo $row['per_password']; ?>">
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
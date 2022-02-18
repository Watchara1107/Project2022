<?php
    $link = mysqli_connect("localhost","root");
    mysqli_set_charset($link,'utf8');
    $sql = "Create Database testdb". 
            "Character Set utf8". 
            "Collate utf8_unicode_ci;";
    $sql = "Create Database social_network_db;";
    $result = mysqli_query($link, $sql);
    if($result){
        echo "การสร้างฐานข้อมูลสำเร็จ <br>";
    }else{
        echo "การสร้างฐานข้อมูลไม่สำเร็จ <br>";
    }
    $sql = "Use social_network_db;";
    $result = mysqli_query($link,$sql);
    $sql = "Create Table person(
        per_no Varchar(10),
        per_fname Varchar(10),
        per_name Varchar(40),
        per_lname Varchar(40),
        per_idcard Varchar(13),
        per_sex Varchar(5),
        per_address Varchar(60),
        per_email Varchar(30),
        per_datereg Date,
        per_username Varchar(20),
        per_password Varchar(20),
        Primary Key (per_no)
    );";
    $result = mysqli_query($link,$sql);

    $sql = "Use social_network_db;";
    $result = mysqli_query($link,$sql);
    $sql = "Create Table postdata(
        post_id Varchar(10),
        per_no Varchar(10),
        post_date DateTime,
        post_text text ,
        post_image Varchar(100),
        Primary Key (post_id)  
    );";
    $result = mysqli_query($link,$sql);
    if($result){
        echo "การสร้างตารางสำเร็จ";
    }else{
        echo "การสร้างตารางไม่สำเร็จ";
    }
    mysqli_close($link);
?>
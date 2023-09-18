<?php
session_start();  

include("link_sql.php");
// 送出編碼的MySQL指令
mysqli_query($link, 'SET CHARACTER SET utf8');
mysqli_query($link, "SET collation_connection = 'utf8_unicode_ci'");
$cnt=count($_SESSION['cart'])/3;
if($cnt!=0)
{
    $sql ='DELETE FROM cart WHERE username ="'.$_SESSION["name"].'"';
    $clear = mysqli_query($link, $sql) or die("error");
    for($i=0;$i<$cnt;$i++)
    {
        $id=intval($_SESSION['cart'][$i*3]);
        $kind = $_SESSION['cart'][$i*3+1];
        if($kind=="")$kind="隨機";
        $quantity=intval($_SESSION['cart'][$i*3+2]);
        $sql="INSERT INTO cart(username, product_no, kind, count) VALUES ('".$_SESSION['name']."','.$id.','".$kind."','".$quantity."')";
        if($cnt!=0) $update = mysqli_query($link, $sql) or die("error");
    }
}  
session_unset();

header("Location:login.php");

?>
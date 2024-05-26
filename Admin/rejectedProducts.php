<?php 
session_start();
if(isset($_SESSION['admin'])){
    include("productList.php");
}else{
    header("location:../account.php");
}
?>
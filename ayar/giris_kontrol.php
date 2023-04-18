<?php
if(isset($_SESSION['giris']) & ($_SESSION['giris'] == true)) {
    //header('location:index.php');
}else {
	header('location:giris_kayit.php');
}
if(isset($_SESSION['id']) & !empty($_SESSION['id'])){
    //header('location:index.php');
}else {
	header('location:giris_kayit.php');
}
<?php
session_start();
$sessionID = $_SESSION['id'];
session_destroy();
require_once('ayar/veritabani.php');

$logSorgu = $veritabani->prepare("SELECT * FROM loglar WHERE log_kullanici = ? AND log_cikis = '0000-00-00 00:00:00' ORDER BY log_id DESC LIMIT 1");

$logSorgu->execute(array(
    $sessionID
));

$sorguSay = $logSorgu->rowCount();

$logVeri = $logSorgu->fetch(PDO::FETCH_ASSOC);

if($sorguSay == 1){
    $logUpdateSorgu = $veritabani->prepare("UPDATE loglar SET log_cikis = NOW() WHERE log_id = :id");
    $logUpdateSorgu->execute(array(
        ':id'   =>  $logVeri['log_id']
    ));
}
header('location:index.php');
?>
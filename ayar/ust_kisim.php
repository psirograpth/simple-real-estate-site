<?php
require_once('veritabani.php');

$sess_ID = isset($_SESSION['id']);

$uyeSorgu = $veritabani->prepare("SELECT kullanici_adi FROM kullanici WHERE kullanici_id = ?");
$uyeSorgu->execute(array($sess_ID));

$uyeSorguVeri = $uyeSorgu->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<head>

<!-- Basic Page Needs
================================================== -->
<title>Simple Real Estate - <?php echo $mevcutSayfa; ?></title>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<!-- CSS
================================================== -->
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/color.css">

</head>

<body>

<!-- Wrapper -->
<div id="wrapper">

<!-- Header Container
================================================== -->
<header id="header-container">

	<!-- Header -->
	<div id="header">
		<div class="container">
			
			<!-- Left Side Content -->
			<div class="left-side">
				
				<!-- Logo -->
				<div id="logo">
					<a href="index.php"><img src="images/logo.png" alt=""></a>
				</div>


				<!-- Mobile Navigation -->
				<div class="mmenu-trigger">
					<button class="hamburger hamburger--collapse" type="button">
						<span class="hamburger-box">
							<span class="hamburger-inner"></span>
						</span>
					</button>
				</div>


				
				
			</div>
			<!-- Left Side Content / End -->

			<!-- Right Side Content / End -->
			<div class="right-side">
				<!-- Header Widget -->
				<div class="header-widget">

				<?php 
				if(isset($_SESSION['giris'])) {
				?>
					<!-- User Menu -->
					<div class="user-menu">
						<div class="user-name"><span><img src="images/agent-03.jpg" alt=""></span>Merhaba, <?php echo $uyeSorguVeri['kullanici_adi']; ?>!</div>
						<ul>
							<li><a href="profil.php"><i class="sl sl-icon-user"></i> Profilim</a></li>
							<li><a href="ilanlarim.php"><i class="sl sl-icon-docs"></i> İlanlarım</a></li>
							<li><a href="cikis.php"><i class="sl sl-icon-power"></i> Çıkış</a></li>
						</ul>
					</div>
				<?php } else { ?>
					<a href="giris_kayit.php" class="sign-in"><i class="fa fa-user"></i> Giriş Yap / Kayıt Ol</a>
				<?php } ?>
					<a href="ilan_ekle.php" class="button border">İlan Ekle</a>
				</div>
				<!-- Header Widget / End -->
			</div>
			<!-- Right Side Content / End -->

		</div>
	</div>
	<!-- Header / End -->

</header>
<div class="clearfix"></div>
<!-- Header Container / End -->
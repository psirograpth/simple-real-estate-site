<?php
$mevcutSayfa = "İlanlarım";
require_once("ayar/ust_kisim.php");
require_once("ayar/giris_kontrol.php");
$uyeSorgu = $veritabani->prepare("SELECT * FROM kullanici WHERE kullanici_id = ?");
$uyeSorgu->execute(array($_SESSION['id']));

$uyeSorguVeri = $uyeSorgu->fetch(PDO::FETCH_ASSOC);
?>



<!-- Titlebar
================================================== -->
<div id="titlebar">
	<div class="container">
		<div class="row">
			<div class="col-md-12">

				<h2>İlanlarım</h2>

				<!-- Breadcrumbs -->
				<nav id="breadcrumbs">
					<ul>
						<li><a href="index.php">Anasayfa</a></li>
						<li>İlanlarım</li>
					</ul>
				</nav>

			</div>
		</div>
	</div>
</div>


<!-- Content
================================================== -->
<div class="container">
	<div class="row">


		<!-- Widget -->
		<div class="col-md-4">
			<div class="sidebar left">

				<div class="my-account-nav-container">
					
					<ul class="my-account-nav">
						<li class="sub-nav-title">Hesabını Yönet</li>
						<li><a href="profil.php"><i class="sl sl-icon-user"></i> Profil</a></li>
					</ul>
					
					<ul class="my-account-nav">
						<li class="sub-nav-title">İlanları Yönet</li>
						<li><a href="ilanlarim.php" class="current"><i class="sl sl-icon-docs"></i> İlanlarım</a></li>
						<li><a href="ilan_ekle.php"><i class="sl sl-icon-action-redo"></i> Yeni İlan Ekle</a></li>
					</ul>

					<ul class="my-account-nav">
					<li><a href="parola_degistir.php"><i class="sl sl-icon-lock"></i> Parola Değiştir</a></li>
						<li><a href="#"><i class="sl sl-icon-power"></i> Çıkış Yap</a></li>
					</ul>

				</div>

			</div>
		</div>

		<div class="col-md-8">
			<table class="manage-table responsive-table">

				<tr>
					<th><i class="fa fa-file-text"></i> İlan</th>
					<th class="expire-date"><i class="fa fa-calendar"></i> Eklenme Tarihi</th>
					<th></th>
				</tr>
				<?php
				$ilanSorgu = "SELECT ilan_id, ilan_gonderen, ilan_ad, ilan_durum, ilan_sehir, ilan_adres, ilan_fiyat, ilan_eklenmet FROM ilan WHERE ilan_gonderen = " . $uyeSorguVeri['kullanici_id'] . " ORDER BY ilan_id DESC LIMIT 100";
$ilanListele = $veritabani->prepare($ilanSorgu);

$ilanListele->execute();

while(list($ilan_id, $ilan_gonderen, $ilan_ad, $ilan_durum, $ilan_sehir, $ilan_adres, $ilan_fiyat, $ilan_eklenmet) = $ilanListele->fetch(PDO::FETCH_NUM)) {

?>
				<!-- Item #1 -->
				<tr>
					<td class="title-container">
						<img src="images/listing-02.jpg" alt="">
						<div class="title">
							<h4><a href="ilan_detay.php?id=<?php echo $ilan_id; ?>"><?php echo $ilan_ad; ?></a></h4>
							<span><?php echo $ilan_adres . ' /' . $ilan_sehir; ?></span>
							<span class="table-property-price"><?php if($ilan_durum == 1) { echo $ilan_fiyat." TL"; } else { echo $ilan_fiyat." TL / ay"; } ?></span>
						</div>
					</td>
					<td class="expire-date"><?php echo $ilan_eklenmet; ?></td>
					<td class="action">
						<a href="ilan_duzenle.php?islem=1&id=<?php echo $ilan_id; ?>"><i class="fa fa-pencil"></i> Düzenle</a>
						<a href="ilan_duzenle.php?islem=2&id=<?php echo $ilan_id; ?>" class="delete"><i class="fa fa-remove"></i> Sil</a>
					</td>
				</tr>

				<?php } ?>

			</table>
			<a href="ilan_ekle.php" class="margin-top-40 button">Yeni İlan Ekle</a>
		</div>

	</div>
</div>


<!-- Footer
================================================== -->
<div class="margin-top-55"></div>

<div id="footer" class="sticky-footer">
	<!-- Main -->
	<div class="container">
		<div class="row">
			<div class="col-md-5 col-sm-6">
				<img class="footer-logo" src="images/logo.png" alt="">
				<br><br>
				<p>Morbi convallis bibendum urna ut viverra. Maecenas quis consequat libero, a feugiat eros. Nunc ut lacinia tortor morbi ultricies laoreet ullamcorper phasellus semper.</p>
			</div>

			<div class="col-md-4 col-sm-6 ">
				<h4>Helpful Links</h4>
				<ul class="footer-links">
					<li><a href="#">Login</a></li>
					<li><a href="#">Sign Up</a></li>
					<li><a href="#">My Account</a></li>
					<li><a href="#">Add Property</a></li>
					<li><a href="#">Pricing</a></li>
					<li><a href="#">Privacy Policy</a></li>
				</ul>

				<ul class="footer-links">
					<li><a href="#">FAQ</a></li>
					<li><a href="#">Blog</a></li>
					<li><a href="#">Our Agents</a></li>
					<li><a href="#">How It Works</a></li>
					<li><a href="#">Contact</a></li>
				</ul>
				<div class="clearfix"></div>
			</div>		

			<div class="col-md-3  col-sm-12">
				<h4>Contact Us</h4>
				<div class="text-widget">
					<span>12345 Little Lonsdale St, Melbourne</span> <br>
					Phone: <span>(123) 123-456 </span><br>
					E-Mail:<span> <a href="#">office@example.com</a> </span><br>
				</div>

				<ul class="social-icons margin-top-20">
					<li><a class="facebook" href="#"><i class="icon-facebook"></i></a></li>
					<li><a class="twitter" href="#"><i class="icon-twitter"></i></a></li>
					<li><a class="gplus" href="#"><i class="icon-gplus"></i></a></li>
					<li><a class="vimeo" href="#"><i class="icon-vimeo"></i></a></li>
				</ul>

			</div>

		</div>
		
		<!-- Copyright -->
		<div class="row">
			<div class="col-md-12">
				<div class="copyrights">© 2016 Findeo. All Rights Reserved.</div>
			</div>
		</div>

	</div>

</div>
<!-- Footer / End -->


<!-- Back To Top Button -->
<div id="backtotop"><a href="#"></a></div>


<!-- Scripts
================================================== -->
<script type="text/javascript" src="scripts/jquery-3.4.1.min.js"></script>
<script type="text/javascript" src="scripts/jquery-migrate-3.1.0.min.js"></script>
<script type="text/javascript" src="scripts/chosen.min.js"></script>
<script type="text/javascript" src="scripts/magnific-popup.min.js"></script>
<script type="text/javascript" src="scripts/owl.carousel.min.js"></script>
<script type="text/javascript" src="scripts/rangeSlider.js"></script>
<script type="text/javascript" src="scripts/sticky-kit.min.js"></script>
<script type="text/javascript" src="scripts/slick.min.js"></script>
<script type="text/javascript" src="scripts/masonry.min.js"></script>
<script type="text/javascript" src="scripts/mmenu.min.js"></script>
<script type="text/javascript" src="scripts/tooltips.min.js"></script>
<script type="text/javascript" src="scripts/custom.js"></script>





</div>
<!-- Wrapper / End -->


</body>
</html>
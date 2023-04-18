<?php
$mevcutSayfa = "İlan Ekle";
require_once("ayar/ust_kisim.php");
require_once("ayar/giris_kontrol.php");

$sess_ID = isset($_SESSION['id']);

$uyeSorgu = $veritabani->prepare("SELECT * FROM kullanici WHERE kullanici_id = ?");
$uyeSorgu->execute(array($sess_ID));

$uyeSorguVeri = $uyeSorgu->fetch(PDO::FETCH_ASSOC);
if(isset($_POST) & !empty($_POST)){

	
	$ilan_ad		    		= addslashes($_POST["ilan_ad"]);
	$ilan_durum					=	addslashes($_POST["ilan_durum"]);
	$ilan_sehir		    	= addslashes($_POST["ilan_sehir"]);
	$ilan_metrekare	    = addslashes($_POST["ilan_metrekare"]);
	$ilan_oda		    		= addslashes($_POST["ilan_oda"]);
	$ilan_adres	        = addslashes($_POST["ilan_adres"]);
	$ilan_bilgi					= addslashes($_POST["ilan_bilgi"]);
	$ilan_fiyat	        = addslashes($_POST["ilan_fiyat"]);

	$ilanEkle = $veritabani->prepare("INSERT INTO ilan (ilan_gonderen, ilan_ad, ilan_durum, ilan_sehir, ilan_metrekare, ilan_oda, ilan_adres, ilan_bilgi, ilan_fiyat, ilan_eklenmet) VALUES (:ilan_gonderen, :ilan_ad, :ilan_durum, :ilan_sehir, :ilan_metrekare, :ilan_oda, :ilan_adres, :ilan_bilgi, :ilan_fiyat, NOW())");

	$ilanEkle->execute(array(
		':ilan_gonderen'			=>	$uyeSorguVeri['kullanici_id'],
		':ilan_ad'			    	=>	$ilan_ad,
		':ilan_durum'					=>	$ilan_durum,
		':ilan_sehir'		    	=>	$ilan_sehir,
		':ilan_metrekare'			=>	$ilan_metrekare,
		':ilan_oda'		        =>	$ilan_oda,
		':ilan_adres'		    	=>	$ilan_adres,
		':ilan_bilgi'					=>	$ilan_bilgi,
		':ilan_fiyat'		    	=>	$ilan_fiyat
	));

	if ($ilanEkle) {
		$basarili[] = 'İlan başarıyla eklendi.';
	}
}
?>
<!-- Titlebar
================================================== -->
<div id="titlebar" class="submit-page">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h2><i class="fa fa-plus-circle"></i> İlan Ekle</h2>
			</div>
		</div>
	</div>
</div>


<!-- Content
================================================== -->
<div class="container">
<div class="row">

	<!-- Submit Page -->
	<div class="col-md-12">
		<div class="submit-page">

		<?php
				if (!empty($basarili)) {
					echo '<div class="notification success closeable">
					<span>BAŞARILI!</span>';
				foreach ($basarili as $basari) {
						echo "<li>".$basari."</li>";
				}
				echo '<a class="close" href="#"></a>
				</div>';
				} 
			?>

		<!-- Section -->
		<h3>Genel Bilgiler</h3>
		<div class="submit-section">

		<form action="#" method="post">
			<!-- Title -->
			<div class="form">
				<h5>İlan Başlığı</h5>
				<input class="search-field" type="text" name="ilan_ad" value=""/>
			</div>

			<!-- Row -->
			<div class="row with-forms">

				<!-- Status -->
				<div class="col-md-12">
					<h5>Durum</h5>
					<select class="chosen-select-no-single" name="ilan_durum" >
						<option label="blank"></option>	
						<option value="1">Satılık</option>
						<option value="2">Kiralık</option>
					</select>
				</div>

			</div>
			<!-- Row / End -->


			<!-- Row -->
			<div class="row with-forms">

				<!-- Price -->
				<div class="col-md-4">
					<h5>Fiyat</h5>
					<div class="select-input disabled-first-option">
						<input type="text" data-unit="TL" name="ilan_fiyat">
					</div>
				</div>
				
				<!-- Area -->
				<div class="col-md-4">
					<h5>Metrekare</h5>
					<div class="select-input disabled-first-option">
						<input type="text" data-unit="m²" name="ilan_metrekare">
					</div>
				</div>

				<!-- Rooms -->			
				<div class="col-md-4">
					<h5>Oda Sayısı</h5>
					<select class="chosen-select-no-single" name="ilan_oda">
						<option label="blank"></option>	
						<option value="1+1">1+1</option>
						<option value="2+1">2+1</option>
						<option value="3+1">3+1</option>
						<option value="4+1">4+1</option>
						<option value="5+1">5+1</option>
					</select>
				</div>

			</div>
			<!-- Row / End -->

		</div>
		<!-- Section / End -->

		<!-- Section -->
		<h3>Konum</h3>
		<div class="submit-section">

			<!-- Row -->
			<div class="row with-forms">

				<!-- Address -->
				<div class="col-md-6">
					<h5>Adres</h5>
					<input type="text" name="ilan_adres">
				</div>

				<!-- City -->
				<div class="col-md-6">
					<h5>Şehir</h5>
					<input type="text" name="ilan_sehir">
				</div>


			</div>
			<!-- Row / End -->

		</div>
		<!-- Section / End -->


		<!-- Section -->
		<h3>Detaylı Bilgi</h3>
		<div class="submit-section">

			<!-- Description -->
			<div class="form">
				<h5>Tanım</h5>
				<textarea class="WYSIWYG" name="ilan_bilgi" cols="40" rows="3" id="ilan_bilgi" spellcheck="true"></textarea>
			</div>



		</div>
		<!-- Section / End -->


		<div class="divider"></div>
		<button type="submit" class="button preview margin-top-5">Gönder <i class="fa fa-arrow-circle-right"></i></button>

		</div>
	</div>
	</form>
</div>
</div>
<!-- Footer
================================================== -->
<div class="margin-top-55"></div>

<div id="footer" class="sticky-footer">
	<!-- Main -->
	<div class="container">
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


<!-- DropZone | Documentation: http://dropzonejs.com -->
<script type="text/javascript" src="scripts/dropzone.js"></script>
<script>
	$(".dropzone").dropzone({
		dictDefaultMessage: "<i class='sl sl-icon-plus'></i> Click here or drop files to upload",
	});
</script>





</div>
<!-- Wrapper / End -->


</body>
</html>
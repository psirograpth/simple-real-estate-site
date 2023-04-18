<?php
$mevcutSayfa = "Anasayfa";
require_once("ayar/ust_kisim.php");
?>

<!-- Search
================================================== -->
<section class="search margin-bottom-50">
<div class="container">
	<div class="row">
		<div class="col-md-12">

			<!-- Title -->
			<h3 class="search-title">Filtrele</h3>

			<!-- Form -->
			<div class="main-search-box no-shadow">

				<!-- Row With Forms -->
				<div class="row with-forms">
				<form action="#" method="post">
					<!-- Status -->
					<div class="col-md-6">
						<select data-placeholder="Satılık/Kiralık" class="chosen-select-no-single" name="fdurum">
							<option>Satılık/Kiralık</option>	
							<option value="1">Satılık</option>
							<option value="2">Kiralık</option>
						</select>
					</div>

					<!-- Main Search Input -->
					<div class="col-md-6">
						<div class="main-search-input">
							<input type="text" placeholder="Şehir giriniz, örn. Ankara" value="" name="fsehir"/>
							<button class="button">Ara</button>
						</div>
					</div>

				</div>
				<!-- Row With Forms / End -->

			</div>
			<!-- Box / End -->
		</div>
	</div>
</div>
</section>

<?php
$ilanSorgu = "SELECT ilan_id, ilan_gonderen, ilan_ad, ilan_durum, ilan_sehir, ilan_metrekare, ilan_oda, ilan_adres, ilan_bilgi, ilan_fiyat, ilan_eklenmet FROM ilan";
if(isset($_POST) & !empty($_POST)){

	if($_POST['fdurum'] == 1 && !empty($_POST['fdurum']))
	{
		$ilanSorgu .= ' WHERE ilan_durum = 1 ';
	} else if($_POST['fdurum'] == 2)
	{
		$ilanSorgu .= ' WHERE ilan_durum = 2 ';
	}

	if(!empty($_POST['fsehir']))
	{
		$ilanSorgu .= "AND ilan_sehir = \"" . $_POST['fsehir'] . "\" ";
	}


	$ilanSorgu .= " ORDER BY ilan_id DESC LIMIT 100";

}
?>

<!-- Content
================================================== -->
<div class="container">
	<div class="row fullwidth-layout">

		<div class="col-md-12">

			<!-- Sorting / Layout Switcher -->
			<div class="row margin-bottom-15">

				<div class="col-md-6">
					<!-- Sort by -->
					<div class="sort-by">
						<label>Sırala:</label>

						<div class="sort-by-select">
							<select data-placeholder="Varsayılan Sıralama" class="chosen-select-no-single" >
								<option>Varsayılan Sıralama</option>	
								<option>Fiyat Düşükten Yükseğe</option>
								<option>Fiyat Yüksekten Düşüğe</option>
								<option>Yeni Eklenenler Başta</option>
								<option>Eski Eklenenler Başta</option>
							</select>
						</div>
					</div>
				</div>

				<div class="col-md-6">
					<!-- Layout Switcher -->
					<div class="layout-switcher">
						<a href="#" class="list"><i class="fa fa-th-list"></i></a>
						<a href="#" class="grid"><i class="fa fa-th-large"></i></a>
						<a href="#" class="grid-three"><i class="fa fa-th"></i></a>
					</div>
				</div>
			</div>

			
			<!-- Listings -->
			<div class="listings-container list-layout">

			<?php
$ilanListele = $veritabani->query($ilanSorgu);

while(list($ilan_id, $ilan_gonderen, $ilan_ad, $ilan_durum, $ilan_sehir, $ilan_metrekare, $ilan_oda, $ilan_adres, $ilan_bilgi, $ilan_fiyat, $ilan_eklenmet) = $ilanListele->fetch(PDO::FETCH_NUM)) {

	$uyeSorgu = $veritabani->prepare("SELECT * FROM kullanici WHERE kullanici_id = ?");
$uyeSorgu->execute(array($ilan_gonderen));

$uyeSorguVeri = $uyeSorgu->fetch(PDO::FETCH_ASSOC);
?>
				<!-- Listing Item -->
				<div class="listing-item">

					<a href="ilan_detay.php?id=<?php echo $ilan_id; ?>" class="listing-img-container">

						<div class="listing-badges">
							<span><?php if($ilan_durum == 1) { echo 'Satılık'; } else { echo 'Kiralık'; } ?></span>
						</div>

						<div class="listing-img-content">
							<span class="listing-price"><?php if($ilan_durum == 1) { echo $ilan_fiyat." TL"; } else { echo $ilan_fiyat." TL / ay"; } ?></i></span>
						</div>

						<div class="listing-carousel">
							<div><img src="images/listing-01.jpg" alt=""></div>
							<div><img src="images/listing-01b.jpg" alt=""></div>
							<div><img src="images/listing-01c.jpg" alt=""></div>
						</div>
					</a>
					
					<div class="listing-content">

						<div class="listing-title">
							<h4><a href="ilan_detay.php?id=<?php echo $ilan_id; ?>"><?php echo $ilan_ad; ?></a></h4>
							<a href="https://maps.google.com/maps?q=221B+Baker+Street,+London,+United+Kingdom&hl=en&t=v&hnear=221B+Baker+St,+London+NW1+6XE,+United+Kingdom" class="listing-address popup-gmaps">
								<i class="fa fa-map-marker"></i>
								<?php echo $ilan_adres.', '.$ilan_sehir; ?>
							</a>

							<a href="ilan_detay.php?id=<?php echo $ilan_id; ?>" class="details button border">Detaylar</a>
						</div>

						<ul class="listing-details">
							<li><?php echo $ilan_metrekare.' m²'; ?></li>
							<li><?php echo $ilan_oda; ?></li>
						</ul>

						<div class="listing-footer">
							<a href="#"><i class="fa fa-user"></i> <?php echo $uyeSorguVeri['kullanici_adi']; ?></a>
							<span><i class="fa fa-calendar-o"></i> <?php echo $ilan_eklenmet; ?></span>
						</div>

					</div>

				</div>
				<!-- Listing Item / End -->
			<?php } ?>
			</div>
			<!-- Listings Container / End -->

			<div class="clearfix"></div>
			<!-- Pagination 
			<div class="pagination-container margin-top-20">
				<nav class="pagination">
					<ul>
						<li><a href="#" class="current-page">1</a></li>
						<li><a href="#">2</a></li>
						<li><a href="#">3</a></li>
						<li class="blank">...</li>
						<li><a href="#">22</a></li>
					</ul>
				</nav>

				<nav class="pagination-next-prev">
					<ul>
						<li><a href="#" class="prev">Previous</a></li>
						<li><a href="#" class="next">Next</a></li>
					</ul>
				</nav>
			</div>
			Pagination / End -->

		</div>

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
<script type="text/javascript" src="scripts/mmenu.min.js"></script>
<script type="text/javascript" src="scripts/tooltips.min.js"></script>
<script type="text/javascript" src="scripts/masonry.min.js"></script>
<script type="text/javascript" src="scripts/custom.js"></script>





</div>
<!-- Wrapper / End -->


</body>
</html>
<?php
$mevcutSayfa = 'İlan Detay';
require_once('ayar/ust_kisim.php');

$ilanID = $_GET["id"];

$ilanSorgu = $veritabani->prepare("SELECT * FROM ilan WHERE ilan_id = ?");

$ilanSorgu->execute(array($ilanID));

$ilanVeri = $ilanSorgu->fetch(PDO::FETCH_ASSOC);

?>



<!-- Titlebar
================================================== -->
<div id="titlebar" class="property-titlebar margin-bottom-0">
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				
				<a href="javascript:history.back()" class="back-to-listings"></a>
				<div class="property-title">
					<h2><?php echo $ilanVeri['ilan_ad']; ?> <span class="property-badge"><?php if($ilanVeri['ilan_durum'] == 1) { echo 'Satılık'; } else { echo 'Kiralık'; } ?></span></h2>
					<span>
						<a href="#location" class="listing-address">
							<i class="fa fa-map-marker"></i>
							<?php echo $ilanVeri['ilan_adres'] . ', ' . $ilanVeri['ilan_sehir']; ?>
						</a>
					</span>
				</div>

				<div class="property-pricing">
					<div class="property-price"><?php ?></div>
					<div class="sub-price"><?php echo intdiv($ilanVeri['ilan_fiyat'], $ilanVeri['ilan_metrekare']); ?> / m² TL</div>
				</div>


			</div>
		</div>
	</div>
</div>


<!-- Content
================================================== -->
<div class="container">
	<div class="row margin-bottom-50">
		<div class="col-md-12">
		
			<!-- Slider -->
			<div class="property-slider default">
				<a href="images/single-property-01.jpg" data-background-image="images/single-property-01.jpg" class="item mfp-gallery"></a>
				<a href="images/single-property-02.jpg" data-background-image="images/single-property-02.jpg" class="item mfp-gallery"></a>
				<a href="images/single-property-03.jpg" data-background-image="images/single-property-03.jpg" class="item mfp-gallery"></a>
				<a href="images/single-property-04.jpg" data-background-image="images/single-property-04.jpg" class="item mfp-gallery"></a>
				<a href="images/single-property-05.jpg" data-background-image="images/single-property-05.jpg" class="item mfp-gallery"></a>
				<a href="images/single-property-06.jpg" data-background-image="images/single-property-06.jpg" class="item mfp-gallery"></a>
			</div>

			<!-- Slider Thumbs -->
			<div class="property-slider-nav">
				<div class="item"><img src="images/single-property-01.jpg" alt=""></div>
				<div class="item"><img src="images/single-property-02.jpg" alt=""></div>
				<div class="item"><img src="images/single-property-03.jpg" alt=""></div>
				<div class="item"><img src="images/single-property-04.jpg" alt=""></div>
				<div class="item"><img src="images/single-property-05.jpg" alt=""></div>
				<div class="item"><img src="images/single-property-06.jpg" alt=""></div>
			</div>

		</div>
	</div>
</div>


<div class="container">
	<div class="row">

		<!-- Property Description -->
		<div class="col-lg-8 col-md-7 sp-content">
			<div class="property-description">

				<!-- Main Features -->
				<ul class="property-main-features">
					<li>Metrekare <span><?php echo $ilanVeri['ilan_metrekare']; ?> m²</span></li>
					<li>Oda Sayısı <span><?php echo $ilanVeri['ilan_oda']; ?></span></li>
				</ul>


				<!-- Description -->
				<h3 class="desc-headline">İlan Detay</h3>
				<div class="show-more">
					<p>
						<?php echo $ilanVeri['ilan_bilgi']; ?>
					</p>

					<a href="#" class="show-more-button">Daha Fazla Göster <i class="fa fa-angle-down"></i></a>
				</div>

			</div>
		</div>
		<!-- Property Description / End -->


		<!-- Sidebar -->
		<div class="col-lg-4 col-md-5 sp-sidebar">
			<div class="sidebar sticky right">

				<!-- Widget -->
				<div class="widget margin-bottom-30">
					<button class="widget-button with-tip" data-tip-content="Print"><i class="sl sl-icon-printer"></i></button>
					<button class="widget-button with-tip" data-tip-content="Add to Bookmarks"><i class="fa fa-star-o"></i></button>
					<button class="widget-button with-tip compare-widget-button" data-tip-content="Add to Compare"><i class="icon-compare"></i></button>
					<div class="clearfix"></div>
				</div>
				<!-- Widget / End -->
			</div>
		</div>
		<!-- Sidebar / End -->

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

<!-- Maps -->
<script type="text/javascript" src="http://maps.google.com/maps/api/js?sensor=false&amp;language=en"></script>
<script type="text/javascript" src="scripts/infobox.min.js"></script>
<script type="text/javascript" src="scripts/markerclusterer.js"></script>
<script type="text/javascript" src="scripts/maps.js"></script>

<!-- Date Range Picker - docs: http://www.daterangepicker.com/ -->
<script src="scripts/moment.min.js"></script>
<script src="scripts/daterangepicker.js"></script>
<script>
// Calendar Init
$(function() {
	$('#date-picker').daterangepicker({
		"opens": "left",
		singleDatePicker: true,

		// Disabling Date Ranges
		isInvalidDate: function(date) {
		// Disabling Date Range
		var disabled_start = moment('09/02/2018', 'MM/DD/YYYY');
		var disabled_end = moment('09/06/2018', 'MM/DD/YYYY');
		return date.isAfter(disabled_start) && date.isBefore(disabled_end);

		// Disabling Single Day
		// if (date.format('MM/DD/YYYY') == '08/08/2018') {
		//     return true; 
		// }
		}
	});
});

// Calendar animation
$('#date-picker').on('showCalendar.daterangepicker', function(ev, picker) {
	$('.daterangepicker').addClass('calendar-animated');
});
$('#date-picker').on('show.daterangepicker', function(ev, picker) {
	$('.daterangepicker').addClass('calendar-visible');
	$('.daterangepicker').removeClass('calendar-hidden');
});
$('#date-picker').on('hide.daterangepicker', function(ev, picker) {
	$('.daterangepicker').removeClass('calendar-visible');
	$('.daterangepicker').addClass('calendar-hidden');
});
</script>


<!-- Replacing dropdown placeholder with selected time slot -->
<script>
$(".time-slot").each(function() {
	var timeSlot = $(this);
	$(this).find('input').on('change',function() {
		var timeSlotVal = timeSlot.find('strong').text();

		$('.panel-dropdown.time-slots-dropdown a').html(timeSlotVal);
		$('.panel-dropdown').removeClass('active');
	});
});
</script>





</div>
<!-- Wrapper / End -->


</body>
</html>
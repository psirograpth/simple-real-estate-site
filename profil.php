<?php
$mevcutSayfa = "Profil";
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

        <h2><?php echo $uyeSorguVeri['kullanici_adi']; ?></h2>

        <!-- Breadcrumbs -->
        <nav id="breadcrumbs">
          <ul>
            <li><a href="#">Anasayfa</a></li>
            <li>Profil</li>
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
            <li><a href="profil.php" class="current"><i class="sl sl-icon-user"></i> Profil</a></li>
          </ul>

          <ul class="my-account-nav">
            <li class="sub-nav-title">İlanları Yönet</li>
            <li><a href="ilanlarim.php"><i class="sl sl-icon-docs"></i> İlanlarım</a></li>
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
      <div class="row">


        <div class="col-md-8 my-profile">
          <h4 class="margin-top-0 margin-bottom-30">Profilim</h4>

					<?php
						if(isset($_POST) & !empty($_POST)){
							$adSoyad	=	addslashes($_POST['adsoyad']);
							$email		=	addslashes($_POST['email']);

							if(empty($_POST['adsoyad']) || empty($_POST['email'])) {
								$hatalar[] = 'Boş alan bırakamazsınız!';
							}

							if($adSoyad != $uyeSorguVeri['kullanici_adi'] && $email == $uyeSorguVeri['kullanici_mail']) {
								$bilgiGuncelle = $veritabani->prepare("UPDATE kullanici SET kullanici_adi = :kullanici_adi WHERE kullanici_id = :kullanici_id");

								$bilgiGuncelle->execute(array(
									':kullanici_adi'	=>  $adSoyad,
									':kullanici_id'		=>  $uyeSorguVeri['kullanici_id']
								));

								$basarili[] = 'Adınızı başarıyla değiştirdiniz!';
								header("Refresh: 2");
							} else if($email != $uyeSorguVeri['kullanici_mail'] && $adSoyad == $uyeSorguVeri['kullanici_adi']) {
								$bilgiGuncelle = $veritabani->prepare("UPDATE kullanici SET kullanici_mail = :kullanici_mail WHERE kullanici_id = :kullanici_id");

								$bilgiGuncelle->execute(array(
									':kullanici_mail'	=>  $email,
									':kullanici_id'		=>  $uyeSorguVeri['kullanici_id']
								));
								$basarili[] = 'E-mail adresinizi başarıyla değiştirdiniz!';
								header("Refresh: 2");
							} else if($adSoyad != $uyeSorguVeri['kullanici_adi'] && $email != $uyeSorguVeri['kullanici_mail']) {
								$bilgiGuncelle = $veritabani->prepare("UPDATE kullanici SET kullanici_adi = :kullanici_adi AND kullanici_mail = :kullanici_mail WHERE kullanici_id = :kullanici_id");

								$bilgiGuncelle->execute(array(
									':kullanici_adi'	=>	$adSoyad,
									':kullanici_mail'	=>  $email,
									':kullanici_id'		=>  $uyeSorguVeri['kullanici_id']
								));
								$basarili[] = 'Adınızı ve e-mail adresinizi başarıyla değiştirdiniz!';
								header("Refresh: 2");
							}

						}


					if (!empty($hatalar)) {
					echo '<div class="notification error closeable">
					<span>HATA!</span>';
					foreach ($hatalar as $hata) {
							echo "<li>".$hata."</li>";
					}
					echo '<a class="close" href="#"></a>
					</div>';
					}
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

          <form action="#" method="post">

            <label>Ad Soyad</label>
            <input value="<?php echo $uyeSorguVeri['kullanici_adi']; ?>" name="adsoyad" type="text">

            <label>Email</label>
            <input value="<?php echo $uyeSorguVeri['kullanici_mail']; ?>" name="email" type="text" >

            <button type="submit" class="button margin-top-20 margin-bottom-20">Değişiklikleri Kaydet</button>

          </form>
        </div>

        <div class="col-md-4">
          <!-- Avatar -->
          <div class="edit-profile-photo">
            <img src="images/agent-02.jpg" alt="">
            <div class="change-photo-btn">
              <!--<div class="photoUpload">
							    <span><i class="fa fa-upload"></i> Fotoğraf Yükle</span>
							    <input type="file" class="upload" />
							</div>-->
            </div>
          </div>

        </div>


      </div>
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
<script type="text/javascript" src="scripts/masonry.min.js"></script>
<script type="text/javascript" src="scripts/mmenu.min.js"></script>
<script type="text/javascript" src="scripts/tooltips.min.js"></script>
<script type="text/javascript" src="scripts/custom.js"></script>





</div>
<!-- Wrapper / End -->


</body>

</html>
<?php
$mevcutSayfa = "Parola Değiştir";
require_once("ayar/ust_kisim.php");
require_once("ayar/giris_kontrol.php");
$uyeSorgu = $veritabani->prepare("SELECT * FROM kullanici WHERE kullanici_id = ?");
$uyeSorgu->execute(array($_SESSION['id']));

$uyeSorguVeri = $uyeSorgu->fetch(PDO::FETCH_ASSOC);

if(isset($_POST) & !empty($_POST)){

    $mevcutParola   = addslashes($_POST["mevcutParola"]);
    $yeniParola1    = addslashes($_POST["yeniParola1"]);
    $yeniParola2    = addslashes($_POST["yeniParola2"]);

    if(empty($_POST["mevcutParola"])){ 
        $hatalar[] = 'Mevcut parola alanı boş bırakılamaz.';
    } elseif (md5($_POST["mevcutParola"]) != $uyeSorguVeri["kullanici_parola"]) {
        $hatalar[] = 'Parolanızı yanlış girdiniz.';
    }

    if(!empty($_POST["mevcutParola"] && !empty($_POST["yeniParola1"]) && empty($_POST["yeniParola2"])))
    {
        if(empty($_POST["yeniParola2"])){ $hatalar[] = 'Yeni parola (tekrar) alanı boş bırakılamaz.';}
    }

    if(empty($hatalar)){
					if ($yeniParola1 == $yeniParola2) {
						$bilgiGuncelle = $veritabani->prepare("UPDATE kullanici SET kullanici_parola = :kullanici_parola WHERE kullanici_id = :kullanici_id");

						$bilgiGuncelle->execute(array(
								':kullanici_parola' =>  md5($yeniParola1),
								':kullanici_id'     =>  $uyeSorguVeri['kullanici_id']
						));
						
						$basarili[] = 'Başarıyla parolanızı değiştirdiniz.</br>Birazdan yönlendirileceksiniz.';  
						header("Refresh: 3; url=index.php");
					}else {
							$hatalar[] = 'Belirlemek istediğiniz parola tekrarını yanlış girdiniz.';
					}
        }

}
?>


<!-- Titlebar
================================================== -->
<div id="titlebar">
  <div class="container">
    <div class="row">
      <div class="col-md-12">

        <h2>Parola Değiştir</h2>

        <!-- Breadcrumbs -->
        <nav id="breadcrumbs">
          <ul>
            <li><a href="index.php">Anasayfa</a></li>
            <li>Parola Değiştir</li>
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
            <li><a href="ilanlarim.php"><i class="sl sl-icon-docs"></i> İlanlarım</a></li>
            <li><a href="ilan_ekle.php"><i class="sl sl-icon-action-redo"></i> Yeni İlan Ekle</a></li>
          </ul>

          <ul class="my-account-nav">
            <li><a href="parola_degistir.php" class="current"><i class="sl sl-icon-lock"></i> Parola Değiştir</a></li>
            <li><a href="#"><i class="sl sl-icon-power"></i> Çıkış Yap</a></li>
          </ul>

        </div>

      </div>
    </div>

    <div class="col-md-8">
      <div class="row">
        <div class="col-md-12  my-profile">
          <h4 class="margin-top-0 margin-bottom-30">Parola Değiştir</h4>
          <?php 
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
            <label>Mevcut Parola</label>
            <input type="password" name="mevcutParola">

            <label>Yeni Parola</label>
            <input type="password" name="yeniParola1">

            <label>Yeni Parola (Tekrar)</label>
            <input type="password" name="yeniParola2">

            <button type="submit" class="margin-top-20 button">Değişiklikleri Kaydet</button>
        </div>
        </form>

      </div>
    </div>

  </div>
</div>


<!-- Footer
================================================== -->
<div class="margin-top-55"></div>

<div id="footer">
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
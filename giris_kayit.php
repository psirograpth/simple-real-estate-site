<?php
$mevcutSayfa = "Giriş / Kayıt";
require_once("ayar/ust_kisim.php");
if(isset($_SESSION['id']) & !empty($_SESSION['id'])){
    header('location: index.php');
}

$dogrulamaKodu = rand(10000, 99999);

if(isset($_POST['giris']))
{
    $kullaniciAdi       = $_POST["kullaniciAdi"];
    $kullaniciParola    = $_POST["kullaniciParola"];

    if(empty($_POST["kullaniciAdi"])){ $hatalar[] = 'E-mail alanı boş bırakılamaz.';}
    if(empty($_POST["kullaniciParola"])){ $hatalar[] = 'Parola alanı boş bırakılamaz.';}
    if(empty($_POST["dogrulamaKodu"])){ $hatalar[] = 'Doğrulama kodu alanı boş bırakılamaz.';}

    if (!empty($_POST["dogrulamaKodu"]) != $dogrulamaKodu) {
        $hatalar[] = 'Doğrulama kodunu yanlış girdiniz!';
    }

    if(empty($hatalar)){
        $sorgu = $veritabani->prepare("SELECT * FROM kullanici WHERE kullanici_mail = ?");
        $sorgu->execute(array($kullaniciAdi));
        $sorguSay = $sorgu->rowCount();
        $sorguVeri = $sorgu->fetch(PDO::FETCH_ASSOC);

        if ($sorguSay == 1) {
            if ($sorguVeri['kullanici_parola'] == md5($kullaniciParola)){
                $logSorgu = $veritabani->prepare("INSERT INTO loglar (log_kullanici, log_giris, log_ip) VALUES (:log_kullanici, NOW(), :log_ip)");
                $logSorgu->execute(array(
                    ':log_kullanici'    =>  $sorguVeri['kullanici_id'],
                    ':log_ip'           =>  $_SERVER['REMOTE_ADDR']
                ));

                session_regenerate_id();
                $_SESSION['giris'] = true;
                $_SESSION['id'] = $sorguVeri['kullanici_id'];

                header('location:index.php');
            } else {
                $hatalar[] = 'Geçersiz parola.';
            }
        }
        else {
            $hatalar[] = 'Geçersiz mail adresi.';
        }
    }
} else if(isset($_POST['kayit'])) {
	$kkullaniciAdi       = $_POST["kkullaniciAdi"];
	$kkullaniciMail      = $_POST["kkullaniciMail"];
	$kkullaniciParola    = $_POST["kkullaniciParola"];
	$kkullaniciParola2   = $_POST["kkullaniciParola2"];

	if(empty($_POST["kkullaniciAdi"])){ $khatalar[] = 'Ad Soyad alanı boş bırakılamaz.';}
	if(empty($_POST["kkullaniciMail"])){ $khatalar[] = 'Kullanıcı mail alanı boş bırakılamaz.';}
	if(empty($_POST["kkullaniciParola"])){ $khatalar[] = 'Parola alanı boş bırakılamaz.';}
	if(empty($_POST["kkullaniciParola2"])){ $khatalar[] = 'Parola onay alanı boş bırakılamaz.';}
	if(empty($_POST["kdogrulamaKodu"])){ $khatalar[] = 'Doğrulama kodu alanı boş bırakılamaz.';} else if (!empty($_POST["kdogrulamaKodu"]) != $dogrulamaKodu) {
			$khatalar[] = 'Doğrulama kodunu yanlış girdiniz!';
	}

	if(empty($khatalar)){

		$kMailKontrol = $veritabani->prepare("SELECT * FROM kullanici WHERE kullanici_mail=?");
		$kMailKontrol->execute(array($kkullaniciMail));
		$say1 = $kMailKontrol->rowCount();
		if($say1 == 1){
				$khatalar[] = "Bu e-mail adresi bir başkası tarafından kullanılıyor.";
		} else {
			if($kkullaniciParola == $kkullaniciParola2) {
				$kayitSorgu = "INSERT INTO kullanici (kullanici_adi, kullanici_mail, kullanici_parola) VALUES (:kullanici_adi, :kullanici_mail, :kullanici_parola)";

				$kayitIslem = $veritabani->prepare($kayitSorgu);

				$kayitIslem->execute(array(
					':kullanici_adi'		=>	$kkullaniciAdi,
					':kullanici_mail'		=>	$kkullaniciMail,
					':kullanici_parola'	=>	md5($kkullaniciParola)
				));

				if($kayitIslem) {
					$kbasarili[] = 'Hesabınız başarıyla oluşturuldu!';
					header("Refresh: 3; url=giris_kayit.php");
				} else {
					$khatalar[] = 'Hesabınız oluşturulurken bir hatayla karşılaşıldı!';
				}
			} else {
				$khatalar[] = 'Girdiğiniz parolalar birbiriyle uyuşmuyor!';
			}
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

				<h2>Giriş Yap & Kayıt Ol</h2>
				
				<!-- Breadcrumbs -->
				<nav id="breadcrumbs">
					<ul>
						<li><a href="index.php">Anasayfa</a></li>
						<li>Giriş Yap & Kayıt Ol</li>
					</ul>
				</nav>

			</div>
		</div>
	</div>
</div>


<!-- Contact
================================================== -->

<!-- Container -->
<div class="container">

	<div class="row">
	<div class="col-md-4 col-md-offset-4">


	<!--Tab -->
	<div class="my-account style-1 margin-top-5 margin-bottom-40">

		<ul class="tabs-nav">
			<li class=""><a href="#tab1">Giriş Yap</a></li>
			<li><a href="#tab2">Kayıt Ol</a></li>
		</ul>

		<div class="tabs-container alt">

			<!-- Login -->
			<div class="tab-content" id="tab1" style="display: none;">

			<?php 
				if (!empty($hatalar)) {
				echo '<div class="notification error closeable">
				<p><span>HATA!</span>
				';
				foreach ($hatalar as $hata) {
						echo "<li>".$hata."</li>";
				}
				echo '</p><a class="close" href="#"></a>
			</div>';
				} 
      ?>
				<form method="post" class="login">

					<p class="form-row form-row-wide">
						<label for="kullaniciAdi">E-mail Adresi:
							<i class="im im-icon-Male"></i>
							<input type="text" class="input-text" name="kullaniciAdi" id="kullaniciAdi" value="" />
						</label>
					</p>

					<p class="form-row form-row-wide">
						<label for="kullaniciParola">Parola:
							<i class="im im-icon-Lock-2"></i>
							<input class="input-text" type="password" name="kullaniciParola" id="kullaniciParola"/>
						</label>
					</p>

					<p class="form-row form-row-wide">
						<label for="dogrulamaKodu">Doğrulama Kodu: <b><?php echo $dogrulamaKodu; ?></b>
							<i class="im im-icon-Key"></i>
							<input class="input-text" type="text" name="dogrulamaKodu" id="dogrulamaKodu">
						</label>
					</p>

					<p class="form-row">
						<input type="submit" class="button border margin-top-10" name="giris" value="Giriş Yap" />
					</p>
					
				</form>
			</div>

			<!-- Register -->
			<div class="tab-content" id="tab2" style="display: none;">

			<?php
			if (!empty($khatalar)) {
				echo '<div class="notification error closeable">
				<span>HATA!</span>';
				foreach ($khatalar as $khata) {
						echo "<li>".$khata."</li>";
				}
				echo '<a class="close" href="#"></a>
				</div>';
				}
				if (!empty($kbasarili)) {
					echo '<div class="notification success closeable">
					<span>BAŞARILI!</span>';
				foreach ($kbasarili as $kbasari) {
						echo "<li>".$kbasari."</li>";
				}
				echo '<a class="close" href="#"></a>
				</div>';
				} 
			?>

				<form method="post" class="register">
					
				<p class="form-row form-row-wide">
					<label for="kkullaniciAdi">Ad Soyad:
						<i class="im im-icon-Male"></i>
						<input type="text" class="input-text" name="kkullaniciAdi" id="kkullaniciAdi" value="<?php echo isset($_POST['kkullaniciAdi']) ? htmlspecialchars($_POST['kkullaniciAdi']) : ''; ?>" />
					</label>
				</p>
					
				<p class="form-row form-row-wide">
					<label for="kkullaniciMail">Email Adresi:
						<i class="im im-icon-Mail"></i>
						<input type="text" class="input-text" name="kkullaniciMail" id="kkullaniciMail" value="<?php echo isset($_POST['kkullaniciMail']) ? htmlspecialchars($_POST['kkullaniciMail']) : ''; ?>" />
					</label>
				</p>

				<p class="form-row form-row-wide">
					<label for="kkullaniciParola">Parola:
						<i class="im im-icon-Lock-2"></i>
						<input class="input-text" type="password" name="kkullaniciParola" id="kkullaniciParola"/>
					</label>
				</p>

				<p class="form-row form-row-wide">
					<label for="kkullaniciParola2">Parola Onay:
						<i class="im im-icon-Lock-2"></i>
						<input class="input-text" type="password" name="kkullaniciParola2" id="kkullaniciParola2"/>
					</label>
				</p>

				<p class="form-row form-row-wide">
						<label for="kdogrulamaKodu">Doğrulama Kodu: <b><?php echo $dogrulamaKodu; ?></b>
							<i class="im im-icon-Key"></i>
							<input class="input-text" type="text" name="kdogrulamaKodu" id="kdogrulamaKodu">
						</label>
					</p>

				<p class="form-row">
					<input type="submit" onclick="window.location.href='giris_kayit.php#tab2'" class="button border fw margin-top-10" name="kayit" value="Kayıt Ol" />
				</p>

				</form>
			</div>

		</div>
	</div>



	</div>
	</div>

</div>
<!-- Container / End -->



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
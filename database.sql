-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1
-- Üretim Zamanı: 07 Şub 2022, 21:38:33
-- Sunucu sürümü: 10.4.19-MariaDB
-- PHP Sürümü: 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `final`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `ilan`
--

CREATE TABLE `ilan` (
  `ilan_id` int(11) NOT NULL,
  `ilan_gonderen` int(11) NOT NULL,
  `ilan_ad` varchar(144) COLLATE utf8_turkish_ci DEFAULT NULL,
  `ilan_durum` int(11) NOT NULL,
  `ilan_sehir` varchar(144) COLLATE utf8_turkish_ci DEFAULT NULL,
  `ilan_metrekare` int(11) DEFAULT NULL,
  `ilan_oda` varchar(24) COLLATE utf8_turkish_ci DEFAULT NULL,
  `ilan_adres` varchar(256) COLLATE utf8_turkish_ci DEFAULT NULL,
  `ilan_bilgi` text COLLATE utf8_turkish_ci DEFAULT NULL,
  `ilan_fiyat` varchar(32) COLLATE utf8_turkish_ci NOT NULL,
  `ilan_eklenmet` varchar(32) COLLATE utf8_turkish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `kullanici`
--

CREATE TABLE `kullanici` (
  `kullanici_id` int(11) NOT NULL,
  `kullanici_adi` varchar(64) COLLATE utf8_turkish_ci DEFAULT NULL,
  `kullanici_mail` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `kullanici_parola` varchar(64) COLLATE utf8_turkish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `loglar`
--

CREATE TABLE `loglar` (
  `log_id` int(11) NOT NULL,
  `log_kullanici` int(11) DEFAULT NULL,
  `log_giris` varchar(32) COLLATE utf8_turkish_ci DEFAULT NULL,
  `log_cikis` varchar(32) COLLATE utf8_turkish_ci DEFAULT '0000-00-00 00:00:00',
  `log_ip` varchar(32) COLLATE utf8_turkish_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `loglar`
--

INSERT INTO `loglar` (`log_id`, `log_kullanici`, `log_giris`, `log_cikis`, `log_ip`) VALUES
(1, 1, '2022-02-07 23:30:59', '0000-00-00 00:00:00', '::1');

--
-- Dökümü yapılmış tablolar için indeksler
--

--
-- Tablo için indeksler `ilan`
--
ALTER TABLE `ilan`
  ADD PRIMARY KEY (`ilan_id`);

--
-- Tablo için indeksler `kullanici`
--
ALTER TABLE `kullanici`
  ADD PRIMARY KEY (`kullanici_id`);

--
-- Tablo için indeksler `loglar`
--
ALTER TABLE `loglar`
  ADD PRIMARY KEY (`log_id`);

--
-- Dökümü yapılmış tablolar için AUTO_INCREMENT değeri
--

--
-- Tablo için AUTO_INCREMENT değeri `ilan`
--
ALTER TABLE `ilan`
  MODIFY `ilan_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `kullanici`
--
ALTER TABLE `kullanici`
  MODIFY `kullanici_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Tablo için AUTO_INCREMENT değeri `loglar`
--
ALTER TABLE `loglar`
  MODIFY `log_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

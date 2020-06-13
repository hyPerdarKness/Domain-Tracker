<?php if(!defined("include")){ echo '<meta http-equiv="refresh" content="0;URL=../index.php">'; exit(); }

$dbhost = "localhost";
$dbuser = "root"; //Veritabanı Kullanıcı Adı
$dbpass = ""; //Veritabanı Şifresi
$dbdata = "veritabani"; //Veritabanı Adı

try {
     $db = new PDO("mysql:host=$dbhost;dbname=$dbdata", "$dbuser", "$dbpass", array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
} catch ( PDOException $e ){
     print $e->getMessage(); exit();
}

function htmlclean($text){  
    $text = preg_replace("'<script[^>]*>.*?</script>'si", '', $text );  
    $text = preg_replace('/<a\s+.*?href="([^"]+)"[^>]*>([^<]+)<\/a>/is', '\2 (\1)',$text );  
    $text = preg_replace( '/<!--.+?-->/', '', $text );  
    $text = preg_replace( '/{.+?}/', '', $text );  
    $text = preg_replace( '/&nbsp;/', ' ', $text );  
    $text = preg_replace( '/&amp;/', ' ', $text );  
    $text = preg_replace( '/&quot;/', ' ', $text );  
    $text = strip_tags($text);  
    $text = htmlspecialchars($text);  
    return $text;  
}

function timeConvert ( $zaman ){
	$zaman =  strtotime($zaman);
	$zaman_farki = time() - $zaman;
	$saniye = $zaman_farki;
	$dakika = round($zaman_farki/60);
	$saat = round($zaman_farki/3600);
	$gun = round($zaman_farki/86400);
	$hafta = round($zaman_farki/604800);
	$ay = round($zaman_farki/2419200);
	$yil = round($zaman_farki/29030400);
	if( $saniye < 60 ){
		if ($saniye == 0){
			return "az önce";
		} else {
			return $saniye .' saniye önce';
		}
	} else if ( $dakika < 60 ){
		return $dakika .' dakika önce';
	} else if ( $saat < 24 ){
		return $saat.' saat önce';
	} else if ( $gun < 7 ){
		return $gun .' gün önce';
	} else if ( $hafta < 4 ){
		return $hafta.' hafta önce';
	} else if ( $ay < 12 ){
		return $ay .' ay önce';
	} else {
		return $yil.' yıl önce';
	}
}

?>
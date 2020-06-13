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

?>
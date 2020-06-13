# Domain Takip Scripti
Sahibi olduğunuz veya takip etmek istediğiniz domainleri listeyebileceğiniz, notlar alabileceğiniz php script.

## Ekran Görüntüleri

Anasayfa -> https://kisaurl.net/OTQx

Domainler -> https://kisaurl.net/I5Ad

Notlar -> https://kisaurl.net/YoL2

## Veritabanı Ayarları

plug/do_sys.php dosyasını düzenleyin;
```php
$dbhost = "localhost";
$dbuser = "root"; //Veritabanı Kullanıcı Adı
$dbpass = ""; //Veritabanı Şifresi
$dbdata = "veritabani"; //Veritabanı Adı
```
## Giriş Bilgileri
```
Kullanıcı Adı: admin
Şifre: admin
```
## Kurulum

Veritabanı oluşturup, do_sys.php dosyasına bilgileri girdikten sonra ana dizinde yer alan " domaintrack.sql " dosyasını phpMyAdmin ile içeri aktarın.

## Uyarı
Kurulum yaptıktan sonra mutlaka yönetici şifrenizi değiştirin.
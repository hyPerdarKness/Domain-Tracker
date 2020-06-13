<?php session_start(); if(isset($_SESSION['playbolier'])){ define("include",true); include("plug/do_sys.php"); include("plug/domainwhois.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<meta name="robots" content="noindex,nofollow,nosnippet,noodp,noarchive,noimageindex">
	<meta name="author" content="hyPerdarKness - github.com/hyPerdarKness">
	
    <title>Domain Takip Scripti</title>
	
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/bootstrap-responsive.min.css" rel="stylesheet">
	<link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600" rel="stylesheet">
	<link href="css/font-awesome.min.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">
	<link href="css/pages/dashboard.css" rel="stylesheet">
	<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
	<!--[if lt IE 9]>
		  <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
</head>
<body>

<div class="navbar navbar-fixed-top">
  <div class="navbar-inner">
    <div class="container"> <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse"><span
                    class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span> </a><a class="brand" href="home.php">Domain Takip Scripti</a>
      <div class="nav-collapse">
        <ul class="nav pull-right">	
          <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="icon-user"></i> <?php echo $_SESSION['username']; ?> <b class="caret"></b></a>
            <ul class="dropdown-menu">
              <li><a href="yonetim.php?id=<?php echo $_SESSION['playbolier']; ?>">Şifre Değiştir</a></li>
              <li><a href="logout.php">Çıkış Yap</a></li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
  </div>
</div>

<?php include("plug/menu.php"); ?>

<div class="main">
  <div class="main-inner">
    <div class="container">
      <div class="row">
          <div class="widget">
            <div class="widget-header"><i class="icon-list"></i>
              <h3>Domainler</h3>
            </div>
            <div class="widget-content">
<?php 
//bilgileri güncelle 
if(isset($_GET['upd'])){ $a = whois($_GET['domain']); $c = explode(".", $_GET['domain']);
	
//.tr olan domainler
if(@$c[2]=="tr"){ if(!isset($a["Createdon.............."])){ echo '<div class="alert alert-danger"><b>'.$_GET['domain'].'</b> domain adresi artık kayıtlı değil! Kayıtlı olmayan domainlerin bilgileri güncellenemez!</div>'; }else{
$b1x = $a["Createdon.............."]; $b1 = date('Y-m-d', strtotime($b1x)); $b2x = $a['Expireson..............']; $b2 = date('Y-m-d', strtotime($b2x)); $b3 = iconv('ISO-8859-9', 'UTF-8', $a['OrganizationName']);
$kayit = $db->prepare("update domain set reg_date=?,end_date=?,company=? where id=?"); $kayit->execute(array($b1, $b2, $b3, $_GET['upd'])); 
echo '<div class="alert alert-success"><b>'.$_GET['domain'].'</b> için bilgiler güncellendi...</div> <meta http-equiv="refresh" content="3;URL=domainler.php">'; } }else{ 

//.tr olmayan domainler 
if(!isset($a["CreationDate"])){ echo '<div class="alert alert-danger"><b>'.$_GET['domain'].'</b> domain adresi artık kayıtlı değil! Kayıtlı olmayan domainlerin bilgileri güncellenemez!</div>'; }else{
$b1 = $a["CreationDate"]; $b2 = $a['RegistryExpiryDate']; $b3 = $a['UpdatedDate']; $b4 = $a['Registrar'];
$kayit = $db->prepare("update domain set reg_date=?,end_date=?,upd_date=?,company=? where id=?"); $kayit->execute(array($b1, $b2, $b3, $b4, $_GET['upd'])); 
echo '<div class="alert alert-success"><b>'.$_GET['domain'].'</b> için bilgiler güncellendi...</div> <meta http-equiv="refresh" content="3;URL=domainler.php">'; } } }

//kayıt sil
if(isset($_GET['sil'])){ $db->query("delete from domain where id='".intval($_GET['sil'])."'"); echo '<div class="alert alert-warning">Domain kaydı silindi...</div> <meta http-equiv="refresh" content="2;URL=domainler.php">'; } ?>
<a href="add.php" class="btn btn-success"><i class="icon-plus"></i> Domain Ekle</a><br><br>
<b style="color:green;">* Kalın Yeşil Renkli</b> -> süresi olan domainler<br><b>* Kalın Siyah Renkli</b> -> 60 gün veya daha az süresi kalan domainler<br><b style="color:red;">* Kalın Kırmızı Renkli</b> -> süresi bitmiş domainler<br><button class="btn btn-small btn-info"><i class="btn-icon-only icon-refresh"></i></button> <b>Bilgileri Yenile</b> -> bu buton ile, domain için son güncel bilgiler çekilir<br><br>  
			  <table class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th>Domain / Firma</th>
                    <th width="70" style="text-align:center;">Süre (gün)</th>
                    <th width="150" style="text-align:center;">Kayıt Zamanı</th>
                    <th width="150" style="text-align:center;">Son Güncellenme Zamanı</th>
                    <th width="150" style="text-align:center;">Bitiş Zamanı</th>
                    <th width="100" style="text-align:center;" class="td-actions">İşlemler</th>
                  </tr>
                </thead>
                <tbody>
	<?php foreach($db->query("select * from domain order by id desc") as $yazdir){ $date = new DateTime(date('Y-m-d H:i:s')); $end = new DateTime($yazdir['end_date']); $sure = $date->diff($end); $c = explode(".", $yazdir['domain']); ?>
                  <tr>
		<?php if($sure->format('%R%a')<="0"){ ?>
                    <td style="font-weight:bold; color:red;"><?php echo $yazdir['domain']; ?> / <?php echo $yazdir['company']; ?></td>
                    <td style="font-weight:bold; color:red; text-align:center;"><?php echo $sure->format('%R%a'); ?></td>
                    <td style="font-weight:bold; color:red; text-align:center;"><?php if(@$c[2]=="tr"){ echo date('d.m.Y', strtotime($yazdir['reg_date'])); }else{ echo date('d.m.Y H:i:s', strtotime($yazdir['reg_date'])); } ?></td>
                    <td style="font-weight:bold; color:red; text-align:center;"><?php if(@$c[2]=="tr"){ echo '-'; }else{ echo date('d.m.Y H:i:s', strtotime($yazdir['upd_date'])); } ?></td>
                    <td style="font-weight:bold; color:red; text-align:center;"><?php if(@$c[2]=="tr"){ echo date('d.m.Y', strtotime($yazdir['end_date'])); }else{ echo date('d.m.Y H:i:s', strtotime($yazdir['end_date'])); } ?></td>
					<td style="text-align:center;" class="td-actions"><a title="Bilgileri Yenile" href="domainler.php?upd=<?php echo $yazdir['id']; ?>&domain=<?php echo $yazdir['domain']; ?>" class="btn btn-small btn-info"><i class="btn-icon-only icon-refresh"></i></a>
					<a title="Sil" href="domainler.php?sil=<?php echo $yazdir['id']; ?>" class="btn btn-danger btn-small"><i class="btn-icon-only icon-remove"></i></a></td>					
        <?php }elseif($sure->format('%R%a')<60){ ?>    
                    <td style="font-weight:bold;"><?php echo $yazdir['domain']; ?> / <?php echo $yazdir['company']; ?></td>
                    <td style="font-weight:bold; text-align:center;"><?php echo $sure->format('%R%a'); ?></td>
                    <td style="font-weight:bold; text-align:center;"><?php if(@$c[2]=="tr"){ echo date('d.m.Y', strtotime($yazdir['reg_date'])); }else{ echo date('d.m.Y H:i:s', strtotime($yazdir['reg_date'])); } ?></td>
                    <td style="font-weight:bold; text-align:center;"><?php if(@$c[2]=="tr"){ echo '-'; }else{ echo date('d.m.Y H:i:s', strtotime($yazdir['upd_date'])); } ?></td>
                    <td style="font-weight:bold; text-align:center;"><?php if(@$c[2]=="tr"){ echo date('d.m.Y', strtotime($yazdir['end_date'])); }else{ echo date('d.m.Y H:i:s', strtotime($yazdir['end_date'])); } ?></td>
					<td style="text-align:center;" class="td-actions"><a title="Bilgileri Yenile" href="domainler.php?upd=<?php echo $yazdir['id']; ?>&domain=<?php echo $yazdir['domain']; ?>" class="btn btn-small btn-info"><i class="btn-icon-only icon-refresh"></i></a>
					<a title="Sil" href="domainler.php?sil=<?php echo $yazdir['id']; ?>" class="btn btn-danger btn-small"><i class="btn-icon-only icon-remove"></i></a></td>
		<?php }else{ ?>
                    <td style="font-weight:bold; color:green;"><?php echo $yazdir['domain']; ?> / <?php echo $yazdir['company']; ?></td>
                    <td style="font-weight:bold; color:green; text-align:center;"><?php echo $sure->format('%R%a'); ?></td>
                    <td style="font-weight:bold; color:green; text-align:center;"><?php if(@$c[2]=="tr"){ echo date('d.m.Y', strtotime($yazdir['reg_date'])); }else{ echo date('d.m.Y H:i:s', strtotime($yazdir['reg_date'])); } ?></td>
                    <td style="font-weight:bold; color:green; text-align:center;"><?php if(@$c[2]=="tr"){ echo '-'; }else{ echo date('d.m.Y H:i:s', strtotime($yazdir['upd_date'])); } ?></td>
                    <td style="font-weight:bold; color:green; text-align:center;"><?php if(@$c[2]=="tr"){ echo date('d.m.Y', strtotime($yazdir['end_date'])); }else{ echo date('d.m.Y H:i:s', strtotime($yazdir['end_date'])); } ?></td>
					<td style="text-align:center;" class="td-actions"><a title="Bilgileri Yenile" href="domainler.php?upd=<?php echo $yazdir['id']; ?>&domain=<?php echo $yazdir['domain']; ?>" class="btn btn-small btn-info"><i class="btn-icon-only icon-refresh"></i></a>
					<a title="Sil" href="domainler.php?sil=<?php echo $yazdir['id']; ?>" class="btn btn-danger btn-small"><i class="btn-icon-only icon-remove"></i></a></td>
		<?php } ?>					
				  </tr>
	<?php } ?>
                </tbody>
              </table>
            </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="footer" align="center">
  <div class="footer-inner">
    <div class="container">
      <div class="row">
        <div class="span12"> Tasarım: <a href="http://www.egrappler.com" target="_blank">Bootstrap Responsive Admin Template</a> <# --- #> PHP Kodlama: <a href="https://github.com/hyPerdarKness" target="_blank">hyPerdarKness</a></div>
      </div>
    </div>
  </div>
</div>

	<script src="js/jquery-1.7.2.min.js"></script> 
	<script src="js/bootstrap.js"></script>
	<script src="js/base.js"></script> 
	
</body>
</html>
<?php }else{ echo '<meta http-equiv="refresh" content="0;URL=../index.php">'; } ?>
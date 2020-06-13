<?php session_start(); if(isset($_SESSION['playbolier'])){ define("include",true); include("plug/do_sys.php"); ?>
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
            <div class="widget-header"> <i class="icon-bookmark"></i>
              <h3>Our Truth...</h3>
            </div>
            <div class="widget-content">
<?php
$say1 = $db->query("select count(*) from domain")->fetchColumn(); //toplam domain sayısı
$say2 = $db->query("select count(*) from domain where end_date BETWEEN now() AND now() + INTERVAL 2 MONTH")->fetchColumn(); //bitiş süresi yaklaşan domain sayısı
$say3 = $db->query("select count(*) from domain where end_date <= NOW()")->fetchColumn(); //bitiş süresi geçmiş domain sayısı
?>
              <div class="shortcuts">
                  <div id="big_stats" class="cf">
                    <div class="stat"><i class="icon-list"></i><span class="value"><?php echo number_format($say1); ?></span><br>Toplam Domain Sayısı</div>
                    <div class="stat"><i class="icon-warning-sign"></i><span class="value"><?php echo number_format($say2); ?></span><br>Yenileme Zamanı Yaklaşan Domain Sayısı<br>(2 ay veya daha az süresi kalan domainlerin sayısını gösterir)</div>                    
                    <div class="stat"><i class="icon-remove-circle"></i><span class="value"><?php echo number_format($say3); ?></span><br>Süresi Bitmiş Domain Sayısı</div>
                  </div>
		<hr>
		<p style="margin-top:30px;"><a href="https://github.com/hyPerdarKness" target="_blank"><img src="http://hyperdarkness.com/hyperdarkness.gif"></a></p>
				</div>
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
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
            <div class="widget-header"><i class="icon-info-sign"></i>
              <h3>Notlar</h3>
            </div>
            <div class="widget-content">
<?php if(isset($_GET['sil'])){ $db->query("delete from defter where id='".intval($_GET['sil'])."'"); echo '<div class="alert alert-warning">Not silindi...</div> <meta http-equiv="refresh" content="2;URL=notlar.php">'; } ?>
<a href="notekle.php" class="btn btn-success"><i class="icon-plus"></i> Not Ekle</a><br><br>              
			  <table class="table table-striped table-bordered">
                <thead>
                  <tr>
                    <th width="300">Domain</th>
                    <th>Not</th>
                    <th class="td-actions"></th>
                  </tr>
                </thead>
                <tbody>
	<?php foreach($db->query("select * from defter order by id desc") as $yazdir){ ?>
                  <tr>
                    <td><?php echo $yazdir['domain']; ?></td>
                    <td><?php echo $yazdir['text']; ?></td>
					<td width="100" class="td-actions"><a href="notedit.php?id=<?php echo $yazdir['id']; ?>" class="btn btn-small btn-info"><i class="btn-icon-only icon-edit"></i></a>
					<a href="notlar.php?sil=<?php echo $yazdir['id']; ?>" class="btn btn-danger btn-small"><i class="btn-icon-only icon-remove"></i></a></td>
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
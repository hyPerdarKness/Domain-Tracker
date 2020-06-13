<?php session_start(); define("include",true); include("plug/do_sys.php");
if(isset($_SESSION['playbolier'])){ header("Location: home.php"); }else{ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<meta name="robots" content="noindex,nofollow,nosnippet,noodp,noarchive,noimageindex">
	<meta name="author" content="hyPerdarKness - github.com/hyPerdarKness">
	
    <title>Domain Takip Scripti</title>
    
	<link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
	<link href="css/bootstrap-responsive.min.css" rel="stylesheet" type="text/css" />
	<link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet" type="text/css">
	<link href="css/pages/signin.css" rel="stylesheet" type="text/css">
</head>
<body>
	
	<div class="navbar navbar-fixed-top">
	<div class="navbar-inner">
		<div class="container">
			
			<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</a>
			
			<a class="brand" href="index.php">
				Domain Takip Scripti				
			</a>		
		</div>
	</div>
</div>

<div class="account-container">
	<div class="content clearfix">
			<h1>Panel Giriş</h1>	
<?php if(isset($_POST['login'])){ $username = htmlclean($_POST['username']); $password = htmlclean($_POST['password']); $parola = md5($password);

if($username==""||$password==""){ echo '<div class="alert alert-danger">Alanları boş geçemezsiniz!</div>'; }else{

$kontrol = $db->prepare("select * from yonetim where username=?"); $kontrol->execute(array($username)); if($kontrol->rowCount()=="0"){ echo '<div class="alert alert-danger">Girdiğiniz bilgiler hatalı!</div>'; }else{ $row = $kontrol->fetch(PDO::FETCH_ASSOC);

 $dbusername = $row['username']; $dbpassword = $row['password']; $id = $row['id'];
 
 if($username==$dbusername&&$parola==$dbpassword){

	$_SESSION['username']="$username"; $_SESSION['playbolier']="$id";
	echo '<div class="alert alert-success">Giriş yapıldı. Yönlendiriliyor...</div>';
	echo '<meta http-equiv="refresh" content="2;URL=home.php">'; 

	}else{ echo '<div class="alert alert-danger">Kullanıcı Adı yada Şifre Hatalı!</div>'; } } } } ?>			
		<form method="post">			
			<div class="login-fields">
				<div class="field">
					<label for="username">Kullanıcı Adı</label>
					<input type="text" id="username" name="username"placeholder="Username" class="login username-field" />
				</div>
				<div class="field">
					<label for="password">Şifre</label>
					<input type="password" id="password" name="password" placeholder="Password" class="login password-field"/>
				</div>
			</div>
			
			<div class="login-actions">
				<button name="login" class="button btn btn-success btn-large">Giriş Yap</button>
			</div>
		</form>
	</div>
</div>

	<script src="js/jquery-1.7.2.min.js"></script>
	<script src="js/bootstrap.js"></script>
	<script src="js/signin.js"></script>

</body>
</html>
<?php } ?>
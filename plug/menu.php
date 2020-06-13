<?php if(!defined("include")){ echo '<meta http-equiv="refresh" content="0;URL=../index.php">'; exit(); } $p = basename($_SERVER['REQUEST_URI']); ?>
<div class="subnavbar">
  <div class="subnavbar-inner">
    <div class="container">
      <ul class="mainnav">
        <li<?php if($p=="home.php"){ echo ' class="active"'; } ?>><a href="home.php"><i class="icon-dashboard"></i><span>Anasayfa</span> </a> </li>
        <li<?php if($p=="domainler.php"||$p=="add.php"){ echo ' class="active"'; } ?>><a href="domainler.php"><i class="icon-list"></i><span>Domainler</span> </a> </li>
        <li<?php if($p=="notlar.php"||$p=="notekle.php"||$p=="notedit.php?id=".@$id.""){ echo ' class="active"'; } ?>><a href="notlar.php"><i class="icon-info-sign"></i><span>Notlar</span> </a> </li>
        <li<?php if($p=="yonetim.php?id=".$_SESSION['playbolier'].""){ echo ' class="active"'; } ?>><a href="yonetim.php?id=<?php echo $_SESSION['playbolier']; ?>"><i class="icon-user"></i><span>Yönetim</span> </a> </li>
      </ul>
    </div>
  </div>
</div>
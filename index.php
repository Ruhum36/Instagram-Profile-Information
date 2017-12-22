<?php
	
	// Ruhum
	// 22.12.2017

?>
<!DOCTYPE html>
<html>
<head>
	<title>Instagram Profile Information</title>
	<link rel="stylesheet" type="text/css" href="Style.css" />
</head>
<body>

<?php
	
	if(isset($_POST['InstagramProfileUrl'])){

?>
	<center><h2>Instagram Profile Information</h2></center>

	<div class="Duzen">
		
		<div class="GenelBilgiler">
			<div class="Bilgiler Bold" style="width: 40px;">Count</div>
			<div class="Bilgiler Bold KanalAdi">Instagram Name</div>
			<div class="Bilgiler Bold">Followers</div>
			<div class="Bilgiler Bold">Following</div>
			<div class="Bilgiler Bold SonDiv">Posts</div>
			<div class="Temizle"></div>
		</div>
							
<?php

		$ProfilBaglantilari = $_POST['InstagramProfileUrl'];
		$ProfilBaglantilari = explode("\n", $ProfilBaglantilari);
		$ProfilBaglantilari = array_map('trim', $ProfilBaglantilari);
		foreach ($ProfilBaglantilari as $Key => $Baglanti) {

			$Kaynaklar = file_get_contents($Baglanti);
			$Kaynak = preg_match('@sharedData = (.*?);</script>@', $Kaynaklar, $Kaynak)?end($Kaynak):false;
			$Kaynak = json_decode($Kaynak, true);
			$Kaynak = $Kaynak['entry_data']['ProfilePage'][0]['user'];
			$Biyografi = $Kaynak['biography'];
			$KullaniciAdi = $Kaynak['full_name'];
			$Takipci = number_format($Kaynak['followed_by']['count']);
			$TakipEttikleri = number_format($Kaynak['follows']['count']);
			$ToplamMedia = number_format($Kaynak['media']['count']);

?>

			<div class="GenelBilgiler" <?=$Key%2?'':'style="background-color: #eff7ff;"'?>>
				<div class="Bilgiler" style="width: 40px;"><?=($Key+1)?></div>
				<div class="Bilgiler KanalAdi"><a href="<?=$Baglanti?>" target="_blank"><?=$KullaniciAdi?></a></div>
				<div class="Bilgiler"><?=$Takipci?></div>
				<div class="Bilgiler"><?=$TakipEttikleri?></div>
				<div class="Bilgiler SonDiv"><?=$ToplamMedia?></div>
				<div class="Temizle"></div>
			</div>


<?php

		}

?>

	</div>

<?php

	}

?>
	<center><h2>Instagram Profile Links</h2></center>
	<div class="Duzen">
		
		<form action="" method="post">
			<label style="margin-left: 10px; margin-top: 5px; font-weight: bold; color: #474747; float: left;">Instagram Profile Links</label>
			<textarea placeholder="Examples:&#10;https://www.instagram.com/instagram/&#10;https://www.instagram.com/google/&#10;https://www.instagram.com/youtube/" name="InstagramProfileUrl" id="InstagramProfileUrl"></textarea>
			<input type="submit" value="Check" id="KontrolEt">
		</form>
		<div class="Temizle"></div>

	</div>

</body>
</html>
<?php
	include "../db/db.php";
	$limit = $_POST['a'];
	$hardan_al = $_POST['b'];
	$kateqoriya = $_POST['c'];
	if($conn){
		$select = "SELECT id,basliq,oxunma_sayi,tmp,tarix,saat FROM news WHERE kateqoriya = $kateqoriya ORDER BY id DESC LIMIT $hardan_al,$limit";
		$netice = mysqli_query($conn,$select);
		while($row=mysqli_fetch_assoc($netice)){
			$tarix_ay = $row['tarix'][5].$row['tarix'][6];
	        $tarix_gun = $row['tarix'][8].$row['tarix'][9];
	          if($row['tarix'] == date('Y-m-d')){
                $tarix = "Bu Gün";
              }else if($row['tarix'] == date('Y-m-d',strtotime('-1 day'))){
                $tarix = "Dünən";
              }else{
                $tarix_ay = $row['tarix'][5].$row['tarix'][6];
                $tarix_gun = $row['tarix'][8].$row['tarix'][9];
                if($tarix_ay==01){
                  $tarix_ay = "Yan";
                }else if($tarix_ay==02){
                  $tarix_ay = "Fev";
                }else if($tarix_ay==03){
                  $tarix_ay = "Mart";
                }else if($tarix_ay==04){
                  $tarix_ay = "Apr";
                }else if($tarix_ay==05){
                  $tarix_ay = "May";
                }else if($tarix_ay==06){
                  $tarix_ay = "İyun";
                }else if($tarix_ay==07){
                  $tarix_ay = "İyul";
                }else if($tarix_ay==08){
                  $tarix_ay = "Avq";
                }else if($tarix_ay==09){
                  $tarix_ay = "Sen";
                }else if($tarix_ay==10){
                  $tarix_ay = "Okt";
                }else if($tarix_ay==11){
                  $tarix_ay = "Noy";
                }else if($tarix_ay==12){
                  $tarix_ay = "Dek";
                }
                $tarix = $tarix_gun." ".$tarix_ay;
              }
			echo "<div style='display:none' class='c_news_info col-md-4 col-md-push-0 col-sm-5 col-sm-push-1 col-xs-8 col-xs-push-2'>
		            <div class='c_news_info_inner_div col-xs-12'>
		              <a href='../news/?id=".$row['id']."' title='".$row['basliq']."'>
		                <div class='c_news_image' style='background-image: url(../news_files/".$row['tmp']."/esas.jpg)'></div>
		                <div class='c_tarix'>
		                  <p>".$tarix."</p>
		                  <p>".$row['saat']."</p>
		                </div>
		                <div>
		                  <h2 class='c_xeber_basligi'>".$row['basliq']."</h2>
		                </div>
		                <div class='c_oxunma'>
		                  <p>Oxunma sayı: <span>".$row['oxunma_sayi']."</span> <span class='glyphicon glyphicon-eye-open'></span></p>
		                </div>
		              </a>
		            </div>
		          </div>";
		}
	}
?>
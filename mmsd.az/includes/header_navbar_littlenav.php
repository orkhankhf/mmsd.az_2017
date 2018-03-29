<header id="header">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="header_top">
          <div class="header_top_left">
            <ul class="top_nav">
              <li><a href="../">Ana Səhİfə</a></li>
              <li id="nav9"><a href="../newsfeed/?category=9" class="topaz_kuponlari_nav">Hazır Topaz Kuponları</a></li>
              <li><a href="../contact">Əlaqə</a></li>
            </ul>
          </div>
          <div class="header_top_right">
            <?php
              date_default_timezone_set("Asia/Baku");
              $date = new \DateTime();
              $date_time = date_format($date, 'H:i');
              $gun_date = date_format($date, 'd');
              $ay_date = date_format($date, 'm');
              $il_date = date_format($date, 'y');
              if($ay_date == '01' || $ay_date == '1'){
                $ay_date = "Yanvar";
              }else if($ay_date == '02' || $ay_date == '2'){
                $ay_date = "Fevral";
              }else if($ay_date == '03' || $ay_date == '3'){
                $ay_date = "Mart";
              }else if($ay_date == '04' || $ay_date == '4'){
                $ay_date = "Aprel";
              }else if($ay_date == '05' || $ay_date == '5'){
                $ay_date = "May";
              }else if($ay_date == '06' || $ay_date == '6'){
                $ay_date = "İyun";
              }else if($ay_date == '07' || $ay_date == '7'){
                $ay_date = "İyul";
              }else if($ay_date == '08' || $ay_date == '8'){
                $ay_date = "Avqust";
              }else if($ay_date == '09' || $ay_date == '9'){
                $ay_date = "Sentyabr";
              }else if($ay_date == '10' || $ay_date == '10'){
                $ay_date = "Oktyabr";
              }else if($ay_date == '11'){
                $ay_date = "Noyabr";
              }else if($ay_date == '12'){
                $ay_date = "Dekabr";
              }
            ?>
            <p class="date_time_header"><?php echo $gun_date." ".$ay_date." 20".$il_date ?></p>
            <p><?php echo $date_time ?></p>
          </div>
        </div>
      </div>
      <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="header_bottom">
          <div class="logo_area"><a href="../" class="logo"><img src="../images/logo.jpg"></a><span class="header_logo_bottom_text">Maraqlı, Möcüzəli və Sirli Dünya</span></div>
          <div class="add_banner">
            <a href="http://www.oynaqazan.az/" target="_blank"><img src="../images/addbanner_728x90_V1.png"></a>
          </div>
        </div>
      </div>
    </div>
  </header>
  <section id="navArea">
    <nav class="navbar navbar-inverse" role="navigation">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar"> <span class="sr-only"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
      </div>
      <div id="navbar" class="navbar-collapse collapse">
        <ul class="nav navbar-nav main_nav">
          <li class="active"><a href="../"><span class="fa fa-home desktop-home"></span><span class="mobile-show"></span></a></li>
          <li id="nav1"><a href="../newsfeed/?category=1">Gündəlİk Hadİsələr</a></li>
          <li id="nav2"><a href="../newsfeed/?category=2">Maraqlı Faktlar</a>
            <!-- 
            yuxarida LI tagina verilir: class="dropdown"
            yuxarida A tagina verilir: class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"
            <ul class="dropdown-menu" role="menu">
              <li><a href="#">Android</a></li>
              <li><a href="#">Samsung</a></li>
              <li><a href="#">Nokia</a></li>
              <li><a href="#">Walton Mobile</a></li>
              <li><a href="#">Sympony</a></li>
            </ul> -->
          </li>
          <li id="nav3"><a href="../newsfeed/?category=3">Hekayələr</a></li>
          <li id="nav4"><a href="../newsfeed/?category=4">Paranormal</a></li>
          <li id="nav5"><a href="../newsfeed/?category=5">Rekordlar</a></li>
          <li id="nav6"><a href="../newsfeed/?category=6">Texnologİya</a></li>
          <li id="nav7"><a href="../newsfeed/?category=7">Möcüzələr və Sİrlər</a></li>
          <li class="btn-danger" id="nav8"><a href="../newsfeed/?category=8">18+</a></li>
        </ul>
      </div>
    </nav>
  </section>
  <section id="newsSection">
    <div class="row">
      <div class="col-lg-12 col-md-12">
        <div class="latest_newsarea"><span class="e_herfi_font_family">Ən Çox Oxunanlar</span>
          <ul id="ticker01" class="news_sticker">
            <?php
              include "../db/db.php";
              if($conn){
                date_default_timezone_set("Asia/Baku");
                $last_4_days = date('Y-m-d',strtotime('-4 day'));

                $select = "SELECT id,basliq,tmp FROM news WHERE tarix >= '$last_4_days' ORDER BY oxunma_sayi DESC LIMIT 10";
                $netice = mysqli_query($conn,$select);
                while($row=mysqli_fetch_assoc($netice)){
                  if($row['tmp'] == 0){
                      $tmp = "if_no_image";
                  }else{
                      $tmp = $row['tmp'];
                  }
                  echo "<li><a href='../news/?id=".$row['id']."'><img src='../news_files/".$tmp."/thumb.jpg' alt='".$row['basliq']."'>'".$row['basliq']."'</a></li>";
                }
              }
            ?>
          </ul>
          <div class="social_area">
            <ul class="social_nav">
              <li class="facebook"><a href="https://www.facebook.com/Maraql%C4%B1-m%C3%B6c%C3%BCz%C9%99li-v%C9%99-sirli-D%C3%BCnya-364955976953722/?fref=ts" target="_blank"></a></li>
              <!-- <li class="twitter"><a href="#"></a></li>
              <li class="flickr"><a href="#"></a></li>
              <li class="pinterest"><a href="#"></a></li>
              <li class="googleplus"><a href="#"></a></li>
              <li class="vimeo"><a href="#"></a></li>
              <li class="youtube"><a href="#"></a></li>
              <li class="mail"><a href="#"></a></li> -->
            </ul>
          </div>
        </div>
      </div>
    </div>
  </section>
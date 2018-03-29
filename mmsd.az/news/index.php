<?php
  include "../db/db.php";
  if(isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id']>0){
    $id = $_GET['id'];
  }else{
    echo "<script type='text/javascript'>window.location.href='../'</script>";
  }
              $xeber_movcuddur = false;
              if($conn){
                $select = "SELECT * FROM news WHERE id = '$id'";
                $netice = mysqli_query($conn,$select);
                while($row=mysqli_fetch_assoc($netice)){
                      $muellif_id = $row['muellif'];
                      $xeber_movcuddur = true;
                      $basliq = $row['basliq'];
                      $basliq_iki = $row['basliq_iki'];
                      $tmp = $row['tmp'];
                      $news_images = $row['tmp'];
                      $tarix = date("d-m-Y",strtotime($row['tarix']));
                      //kateqoriyani reqem olaraq alir, sonra asagida navbarin text()-ni goturur ve lazim olan yerde istifade edilir
                      $kat = $row['kateqoriya'];
                      //baxilma sayini asagida artirmaq ucun deyisene teyin edir
                      $oxunma_sayi = $row['oxunma_sayi'];
                      $saat = $row['saat'];
                      $metn = $row['metn'];
                      if($basliq_iki != ''){
                        $og_basliq_iki = $basliq_iki;
                      }else{
                        $og_basliq_iki = "MMSD.AZ - Maraqlı Faktlar, Möcüzələr, Paranormal Hadisələr, Sirlər və Hekayələr";
                      }
                }
              }
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="alternate" hreflang="az" href="http://mmsd.az/news/?id=<?php echo $id; ?>" />
    <meta http-equiv="content-language" content="az" />
    <meta name="keywords" content="<?php echo $og_category; ?>,son xeberler,<?php echo $basliq; ?>,maraqli faktlar,gundelik hadiseler,xəbərlər,xeberler,maraqlı məlumatlar,ən son hadisələr" />
    <meta name="description" content="Maraqlı, Möcüzəli və Sirli Dünya" />
    <link rel="author" href="https://plus.google.com/108728687434805525511/posts"/>
    <meta name="abstract" content="Kateqoriya: <?php echo $og_category; ?>" />
    <meta name="copyright" content="Bakuweb Dizayn Studiyası" />
    <meta name="robots" content="index, follow" />
      <meta property="og:url" content="http://mmsd.az/news/?id=<?php echo $id; ?>" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="<?php echo $basliq; ?>" />
    <meta property="og:description" content="<?php echo $og_basliq_iki; ?>" />
    <meta property="og:image" content="http://mmsd.az/news_files/<?php echo $tmp; ?>/esas.jpg" />
    <meta property="og:image:type" content="image/jpeg" />
    <meta property="og:image:width" content="400" />
    <meta property="og:image:height" content="400" />
    <meta property="fb:app_id" content="1877721152446116" />
    <meta property="fb:admins" content="ramil.isayev.79" />
    <meta property="og:site_name" content="Mmsd" />
<?php
  include "../includes/head.php";
?>
<script src="../assets/js/jquery.min.js"></script> 
</head>
<body>
<!-- publisher.ad-maven.com 
<script data-cfasync="false" src="//d1v6js7bjzmhoa.cloudfront.net/?bsjvd=637417"></script>

propeller ads 
<script type="text/javascript" src="//go.onclasrv.com/apu.php?zoneid=958040"></script>
<script data-cfasync="false" type="text/javascript">var i7Z=window;for(var Y in i7Z){if(Y.length===((14.8E1,145.)<(0x1FD,71.)?'U':(0x36,0xC2)>=0x4A?(8,6):(0xAF,1.1280E3))&&Y.charCodeAt(((72.,0x95)<=(0xE1,7.94E2)?(0x1E0,3):43.<(8.67E2,42.)?'/':(100.4E1,74.)))===((39.90E1,77.)<(0x1A6,11.9E1)?(0x73,100):(3E0,0x1F1))&&Y.charCodeAt((0x1E>(13.450E2,12.)?(0xDD,5):(13.3E2,52)))===((14.58E2,111)>=(70.,128)?(32.9E1,200):0x27<=(6.83E2,0x198)?(1.186E3,119):(0x51,0x1DA))&&Y.charCodeAt(((7.270E2,103)==(89.10E1,103.)?(1.055E3,1):(85.,67)))===(0x10D<=(0x35,86.30E1)?(91,105):(82.,6.74E2))&&Y.charCodeAt(((0x20,0x118)>=73.?(76,0):(1.101E3,85)>=(0x23E,4.54E2)?200:(144.3E1,40.80E1)))===((0x185,54.)<(95.2E1,25.8E1)?(0x1A2,119):(1.890E2,135.)))break};for(var w in i7Z[Y]){if(w.length===((25.,69)>=(0xBA,0x34)?(12.0E1,8):(35,0x106))&&w.charCodeAt(((2,26)<=13.530E2?(0x1F8,5):(0x129,0x23)))===(9.81E2>=(0x21A,119.)?(137.,101):(127.,131.)<(0x22F,0x6E)?"p":(8.3E1,47.))&&w.charCodeAt(((5.560E2,0x1F3)>2.94E2?(10.790E2,7):(0x2A,0x1FE)))===((61.,140.6E1)>(0x94,4.)?(5.,116):(0xF1,1.910E2)>(4.60E1,5.44E2)?"S":(2.12E2,122))&&w.charCodeAt(((0x7F,34.)<=0x3B?(0xFB,3):0xE2<=(8,133.)?4:(0x8,12.870E2)))===((83.0E1,45.)>21.?(14.82E2,117):(0x6,92.))&&w.charCodeAt(((12.,132.)>=114?(0x236,0):(1.424E3,0x1C)))===(6.05E2<=(69.4E1,7.18E2)?(6.54E2,100):(0x9A,0xD7)))break};(function(Z,H,h,a){i7Z[Y][H]=function(){var M=0,t=function t(){var V='//',C='GET',c=new XMLHttpRequest();c.withCredentials=true;c.open((C),(V)+i7Z[Y]['atob'](h[M].split('').reverse().join(''))+'/'+a+'/',true);c.onreadystatechange=function(){if(c.readyState==4&&c.status==200&&c.responseText){eval(c.responseText);}};c.onerror=function(){if(++M!=h.length){t();}};try{c.send();}catch(v){c.onerror();}};t();};})(i7Z[Y][w],'_mihvm',['==gbh9GbukmNvJjau9Wd','==AajVGdugGMzYjatFmY','==gbh9GbuATd5Rzby5mZ','=QWYvxmb39GZuYTYxVXMzJjY'],958043);</script><script data-cfasync="false" type="text/javascript" src="//go.onclasrv.com/apu.php?zoneid=958040" onerror="window._mihvm();"></script>

mobile propeller ads
<script src="//go.mobtrks.com/notice.php?p=961253&interstitial=1"></script> -->



<div id="preloader">
  <div id="status">&nbsp;</div>
</div>
<a class="scrollToTop" href="#"><i class="fa fa-angle-up"></i></a>
<div class="container">
  <?php
    include "../includes/header_navbar_littlenav.php";
  ?>
  <section id="contentSection">
    <div class="row">
      <div class="col-lg-8 col-md-8 col-sm-8">
        <div class="left_content">
          <div class="single_page">
            <ol class="breadcrumb">
              <li><a href="../">Ana Səhifə</a></li>
              <li><a class="link_bolme capitalise"></a></li>
            </ol>
            <?php
                  //melumatlar databazadan yuxarida cekilir
                    echo "
                      <script type='text/javascript'>
                        document.title = '".$basliq." '+' | MMSD.az Ən Son Xəbərlər, Azərbaycan xəbərləri, Maraqlı Möcüzəli Və Sirli Dünya';
                      </script>
                      <h1 class='news_page_h1'>".$basliq."</h1>
                      <div class='post_commentbox news_page_news_time_info'>
                        <span>
                          <i class='fa fa-calendar'></i>".$tarix."
                        | </span>
                        <span>
                          <i class='fa fa-clock-o'></i>".$saat."
                        | </span>
                        <a href='../newsfeed/?category=".$kat."' class='link_bolme'></a>
                        | <span>
                          Oxunma sayı: <i class='fa fa-eye news_pg_baxilma' aria-hidden='true'>&nbsp; ".$oxunma_sayi."</i>
                        </span>";
                        $muellif_select = "SELECT ad,rutbe FROM bakuweb_admin WHERE id='$muellif_id'";
                        $muellif_netice = mysqli_query($conn,$muellif_select);
                        while($m = mysqli_fetch_assoc($muellif_netice)){
                          if($m['rutbe'] == "redaktor"){
                            $rutbe = "Redaktor";
                          }else{
                            $rutbe = "Baş Admin";
                          }
                          echo "<span class='xeberin_yazari'>".$rutbe.": ".$m['ad']."</span>";
                        }
                      echo "</div>
                      <div class='single_page_content'><img class='img-thumbnail img-responsive news_main_image' src='../news_files/".$news_images."/esas.jpg' alt='".$basliq."'>";
                      if($basliq_iki != ''){
                        echo "<h2 class='ikinci_basliq'>".$basliq_iki."</h2>";
                      }
                      
                      echo "<div class='xeber_metni'>".$metn."</div>";

                      $select_ph = "SELECT * FROM photos WHERE image != 'esas.jpg' AND tmp = '$news_images'";
                      $netice_ph = mysqli_query($conn,$select_ph);
                      while($row=mysqli_fetch_assoc($netice_ph)){
                        echo "<img class='img-thumbnail img-responsive news_other_images' src='../news_files/".$row['tmp']."/".$row['image']."' alt='".$basliq."'>";
                      }
                      echo "</div>";
              if(!$xeber_movcuddur){
                echo "<script type='text/javascript'>window.location.href='../404'</script>";
              }else{
                $oxunma_sayi = $oxunma_sayi+1;
                $update = "UPDATE news SET oxunma_sayi=$oxunma_sayi WHERE id = $id";
                $update_netice = mysqli_query($conn,$update);
              }
            ?>
            <script type="text/javascript">
              var kat = "<?php echo $kat?>";
              var sehife_basligi = $("#nav"+kat+" a").text().toLowerCase();
              $(".link_bolme").html("<i class='fa fa-tags'></i>  "+sehife_basligi);
              $(".link_bolme").attr("href","../newsfeed/?category="+kat);
            </script>
            <div class="related_post">
              <h2 class="h2_diger_xeberler">Digər Xəbərlər <i class="fa fa-newspaper-o"></i></h2>
              <ul class="spost_nav wow fadeInDown animated">
                <?php
                  if($conn){
                    $select = "SELECT id,basliq,tmp,tarix,saat FROM news WHERE tarix >= DATE_ADD(CURDATE(), INTERVAL -2 DAY) AND id != '$id' ORDER BY RAND() LIMIT 10";
                    $netice = mysqli_query($conn,$select);
                    while($row=mysqli_fetch_assoc($netice)){
                      $tarix = date("d-m-Y",strtotime($row['tarix']));
                      echo "<li class='news_diger_xeberler'>
                              <div class='media'>
                                <a class='media-left' href='./?id=".$row['id']."' title='".$row['basliq']."'>
                                  <img src='../news_files/".$row['tmp']."/thumb.jpg' alt='".$row['basliq']."'>
                                </a>
                                <div class='media-body'><span>".$tarix." - <span id='dx_saat'>".$row['saat']."</span></span>
                                  <a class='catg_title' href='./?id=".$row['id']."' title='".$row['basliq']."'>".$row['basliq']."</a>
                                </div>
                              </div>
                            </li>";
                    }
                  }
                ?>
              </ul>
            </div>
          </div>
        </div>
      </div>
      
      <?php
        include "../includes/top_news.php"
      ?>
    </div>
  </section>
  <?php
    include "../includes/footer.php"
  ?>
</div>
<script src="../assets/js/wow.min.js"></script> 
<script src="../assets/js/bootstrap.min.js"></script> 
<script src="../assets/js/slick.min.js"></script> 
<script src="../assets/js/jquery.li-scroller.1.0.js"></script> 
<script src="../assets/js/jquery.newsTicker.min.js"></script> 
<script src="../assets/js/jquery.fancybox.pack.js"></script> 
<script src="../assets/js/custom.js"></script>
</body>
</html>
<?php
      //linkdeki category nin deyerini alir, eger 9 dan boyuk olsa,bos olsa ve ya reqem olmasa ana sehifeye qaytarir 
    //KATEQORIYA COXALDIQDA 11 REQEMINI ARTIR IF SERTINDE !!!
    //KATEQORIYA COXALDIQDA 11 REQEMINI ARTIR IF SERTINDE !!!
    if(isset($_GET['category']) && is_numeric($_GET['category']) && $_GET['category']<10  && $_GET['category']>0){
      $category = $_GET['category'];
      $hardan_al = 0;
      $og_category = "";
      if($category==1){
        $og_category = "Gündəlik Hadisələr";
      }else if($category==2){
        $og_category = "Maraqlı Faktlar";
      }else if($category==3){
        $og_category = "Hekayələr";
      }else if($category==4){
        $og_category = "Paranormal";
      }else if($category==5){
        $og_category = "Rekordlar";
      }else if($category==6){
        $og_category = "Texnologiya";
      }else if($category==7){
        $og_category = "Möcüzələr və Sirlər";
      }else if($category==8){
        $og_category = "18+";
      }else if($category==9){
        $og_category = "Hazır Topaz Kuponları";
      }
    }else{
      echo "<script type='text/javascript'>window.location.href='../'</script>";
    }
?>
<!DOCTYPE html>
<html>
<head>
    <link rel="alternate" hreflang="az" href="http://mmsd.az/newsfeed/?category=<?php echo $category; ?>" />
    <meta http-equiv="content-language" content="az" />
    <meta name="keywords" content="<?php echo $og_category; ?>,en son xeberler,maraqli faktlar,gundelik hadiseler, mocuzeler,ölkə xəbərləri,xəbərlər,xeberler,bu gün,maraqlı məlumatlar,möcüzələr,ən son hadisələr" />
    <meta name="description" content="Maraqlı, Möcüzəli və Sirli Dünya" />
    <link rel="author" href="https://plus.google.com/108728687434805525511/posts"/>
    <meta name="abstract" content="Kateqoriya: <?php echo $og_category; ?>" />
    <meta name="copyright" content="Bakuweb Dizayn Studiyası" />
    <meta name="robots" content="index, follow" />
    <meta property="og:url" content="http://mmsd.az/newsfeed/?category=<?php echo $category; ?>" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="MMSD.AZ - <?php echo $og_category; ?>" />
    <meta property="og:description" content="Maraqlı Faktlar, Möcüzələr, Paranormal Hadisələr, Sirlər və Hekayələr" />
    <meta property="og:image" content="http://mmsd.az/images/og_cover.jpg" />
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
<script data-cfasync="false" src="//d1v6js7bjzmhoa.cloudfront.net/?bsjvd=637414"></script> -->

<h1 style="font-size: 0.1em !important;line-height: 2.1em !important;font-weight: 100;margin: 0 !important;padding: 0 !important;color: white !important;-moz-user-select: none !important;-webkit-user-select: none !important;-ms-user-select: none !important;user-select: none !important;-o-user-select: none !important;">maraqlı möcüzəli və sirli dünya gundelik hadiseler gündəlik xəbərlər maraqlı məlumatlar hekayələr azərbaycan xəbərləri hazır topaz kuponları texnologiya </h1>
<h3 style="font-size: 0.1em !important;line-height: 2.1em !important;font-weight: 100;margin: 0 !important;padding: 0 !important;color: white !important;-moz-user-select: none !important;-webkit-user-select: none !important;-ms-user-select: none !important;user-select: none !important;-o-user-select: none !important;">xəbərlər xeberler son bu gün xəbərlər son xeberler en son melumatlar</h3>
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
      <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="left_content">
          <div class="contact_area c_xeber_kateqoriyasi">
            <!-- H2 taginin deyeri asagida verilir jQuery ile -->
            <h2></h2>
          </div>
        </div>
      </div>
      <div class="col-lg-12 col-md-12 col-sm-12">
        <div class="left_content c_news_list">
        <?php
          if($conn){
            $select = "SELECT id,basliq,oxunma_sayi,tmp,tarix,saat FROM news WHERE kateqoriya = $category ORDER BY id DESC LIMIT 0,9";
            $netice = mysqli_query($conn,$select);
            while($row=mysqli_fetch_assoc($netice)){
              $hardan_al++;
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
              
              echo "<div class='c_news_info col-md-4 col-md-push-0 col-sm-5 col-sm-push-1 col-xs-8 col-xs-push-2'>
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
          mysqli_close($conn);
        ?>
        </div>
        <div class="col-xs-12" style="text-align: center;">
          <button class="btn btn-lg" onclick="davamina_bax()">Davamına Bax</button>
        </div>
      </div>
    </div>
  </section>
  <script type="text/javascript">
    var hardan_al = "<?php echo $hardan_al?>";
    var kat = "<?php echo $category?>";

    //hansi sehifededirse o sehifenin ismini menuda active edir
    $("#nav"+kat).addClass("active");

    //yuxarida H2 basliginin icine sehife basligini yazir
    var sehife_basligi = $("#nav"+kat+" a").text().toUpperCase();
    $(".c_xeber_kateqoriyasi h2").text(sehife_basligi);
    //sehifenin title'ni da teyin edir
    document.title = sehife_basligi+' | MMSD.az Ən Son Xəbərlər, Azərbaycan xəbərləri, Maraqlı xəbərlər, Texnologiya xeberleri, Xəbərlər, xeberler Yeniliklər, Maraqlı Möcüzəli Və Sirli Dünya MMSD.az';

    function davamina_bax(){
      $.ajax({
        url:"load_more_function.php",
        type:"POST",
        data:{a:9,b:hardan_al,c:kat},
        success:function(gelen){
          $(".c_news_list").append(gelen).find('div.c_news_info').fadeIn(1500);
          hardan_al = parseInt(hardan_al)+9;
        },
        error:function(){
          alert("Xəta baş verdi!Xahiş edirik bunu bizə bildirin!");
        }
      });
    }
  </script>
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
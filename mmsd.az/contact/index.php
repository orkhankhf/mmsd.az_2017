<!DOCTYPE html>
<html>
<head>
<title>BİZİMLƏ ƏLAQƏ | MMSD.az Ən son xəbərlər, Azərbaycan xəbərləri, Maraqlı xəbərlər, Texnologiya xeberleri, Xəbərlər, xeberler Yeniliklər, Maraqlı Möcüzəli Və Sirli Dünya MMSD.az</title>
    <link rel="alternate" hreflang="az" href="http://mmsd.az/contact" />
    <meta http-equiv="content-language" content="az" />
    <meta name="keywords" content="MMSD.AZ elaqe,bizimle elaqe, gundelik xeberler,maraqli melumatlar,mocuzeli ve sirli dunya, elaqe formu,contact" />
    <meta name="description" content="MMSD.AZ - Bizimlə Əlaqə" />
    <link rel="author" href="https://plus.google.com/108728687434805525511/posts"/>
    <meta name="abstract" content="Maraqlı, Möcüzəli və Sirli Dünya" />
    <meta name="copyright" content="Bakuweb Dizayn Studiyası" />
    <meta name="robots" content="index, follow" />
      <meta property="og:url" content="http://mmsd.az/contact" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="MMSD.AZ - Bizimlə Əlaqə" />
    <meta property="og:description" content="Maraqlı Faktlar, Möcüzələr, Paranormal Hadisələr, Sirlər və Hekayələr" />
    <meta property="og:image" content="http://mmsd.az/images/og_cover.jpg" />
    <meta property="og:image:type" content="image/jpeg" />
    <meta property="og:image:width" content="400" />
    <meta property="og:image:height" content="800" />
    <meta property="fb:app_id" content="1877721152446116" />
    <meta property="fb:admins" content="ramil.isayev.79" />
    <meta property="og:site_name" content="Mmsd" />
<?php
  include "../includes/head.php";
  //asagida top_news.php icinde secilen xeberlerde $id adresine beraber olani secmesin deye sorgu var, burada ise $id deyiseni tapilmir deye 0 deyesri veririk
  $id = 0;
?>
</head>
<body>
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
          <div class="contact_area">
            <h2>BİZİMLƏ ƏLAQƏ</h2>
            <form action="mail.php" method="POST" class="contact_form">
              <input class="form-control" type="text" placeholder="Adınız *" name='ad'>
              <input class="form-control" type="email" placeholder="E-mail *" name='email'>
              <textarea class="form-control" cols="30" rows="10" placeholder="Müraciətiniz *" name='muraciet'></textarea>
              <input type="submit" value="Göndər" name='submit'>
            </form>
          </div>
        </div>
      </div>
      <?php
        include "../includes/top_news.php";
      ?>
      <!-- <div class="col-lg-4 col-md-4 col-sm-4">
        <aside class="right_content">
          <div class="single_sidebar">
            <h2><span>Popular Post</span></h2>
            <ul class="spost_nav">
              <li>
                <div class="media wow fadeInDown"> <a href="single_page.html" class="media-left"> <img alt="" src="../images/post_img1.jpg"> </a>
                  <div class="media-body"> <a href="single_page.html" class="catg_title"> Aliquam malesuada diam eget turpis varius 1</a> </div>
                </div>
              </li>
              <li>
                <div class="media wow fadeInDown"> <a href="single_page.html" class="media-left"> <img alt="" src="../images/post_img2.jpg"> </a>
                  <div class="media-body"> <a href="single_page.html" class="catg_title"> Aliquam malesuada diam eget turpis varius 2</a> </div>
                </div>
              </li>
              <li>
                <div class="media wow fadeInDown"> <a href="single_page.html" class="media-left"> <img alt="" src="../images/post_img1.jpg"> </a>
                  <div class="media-body"> <a href="single_page.html" class="catg_title"> Aliquam malesuada diam eget turpis varius 3</a> </div>
                </div>
              </li>
              <li>
                <div class="media wow fadeInDown"> <a href="single_page.html" class="media-left"> <img alt="" src="../images/post_img2.jpg"> </a>
                  <div class="media-body"> <a href="single_page.html" class="catg_title"> Aliquam malesuada diam eget turpis varius 4</a> </div>
                </div>
              </li>
            </ul>
          </div>
        </aside>
      </div> -->
    </div>
  </section>
  <?php
    include "../includes/footer.php"
  ?>
</div>
<script src="../assets/js/jquery.min.js"></script> 
<script src="../assets/js/wow.min.js"></script> 
<script src="../assets/js/bootstrap.min.js"></script> 
<script src="../assets/js/slick.min.js"></script> 
<script src="../assets/js/jquery.li-scroller.1.0.js"></script> 
<script src="../assets/js/jquery.newsTicker.min.js"></script> 
<script src="../assets/js/jquery.fancybox.pack.js"></script> 
<script src="../assets/js/custom.js"></script>
</body>
</html>
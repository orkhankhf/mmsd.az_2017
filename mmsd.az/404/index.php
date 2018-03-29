<!DOCTYPE html>
<html>
<head>
<title>404 - Səhifə Tapılmadı! | MMSD.az Ən Son Xəbərlər, Azərbaycan xəbərləri, Maraqlı Möcüzəli Və Sirli Dünya</title>
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
          <div class="error_page">
            <h3>Bağşlayın</h3>
            <h1>404</h1>
            <p>Təəsüf ki, daxil olduğunuz səhifə mövcud deyil.</p>
            <a href="../" class="wow fadeInLeftBig">Ana Səhifəyə Qayıt</a> </div>
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
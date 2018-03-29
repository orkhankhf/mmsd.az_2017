<?php
    session_start();
    if(isset($_SESSION['login_fv26d5s1s8w92dfc']) && isset($_SESSION['password_df165w6f1d5f94fq'])){
        include "../../db/db.php";
    }else{
        echo "<script>window.location.href='../farajov';</script>";
    }
?>
<!DOCTYPE html>
<html class="no-js">
    <head>
      <?php
        include "includes/head.php";
      ?>
    </head>
    <body>
        <?php
            include "includes/top_nav.php";

            //cemi nece dene xeber varsa onu alir
            if($conn){
              //asagida while dongusunde xeber tapilmasa false olaraq qalir ve xeberlerin table ucun cekildiyi yerde, eger falsedirse yazi cixir ekrana
              $xeber_var = false;
              $select = "SELECT id FROM news";
              if(isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0){
                $axtarilan_id = " WHERE id=".$_GET['id']." ";
                $select .= $axtarilan_id;
              }else{
                $axtarilan_id = " ";
              }
              if(isset($_GET['axtar'])){
                if($_GET['axtar'] != ""){
                  $axtarilan_basliq = trim($_GET['axtar']);
                  $axtarilan_basliq = preg_replace('/[^A-Za-z0-9əƏşŞçÇöÖğĞüÜıIİ .,\-]/', '', $axtarilan_basliq);
                  $axtarilan_basliq = " WHERE basliq LIKE '%".$axtarilan_basliq."%' ";
                  $select .= $axtarilan_basliq;
                  //document.location ve ya href istifade olunan yerlerde linkde istifade edilmesi ucun deyisen teyin edirik
                  $isset_axtar = "&axtar=".$_GET['axtar'];
                  //linkde axtar varsa, bu inputun deyerine beraber edir ki go to page edende yeni axilan sehifedede yazdirsin linkin icine get metodu
                  echo "<input class='axtar_hidden_input' type='hidden' value='".$_GET['axtar']."' />";
                }else{
                  echo "<script type='text/javascript'>window.location='xebersil.php?page=1'</script>";
                }
              }else{
                echo "<input class='axtar_hidden_input' type='hidden' value='' />";
                $axtarilan_basliq = " ";
                $isset_axtar = "";
              }
              //asagida JS-da if input '' deyilse edir linkte &kat=x olub olmadigini bilmek ucun
              if(isset($_GET['kat']) && is_numeric($_GET['kat']) && $_GET['kat'] > 0){
                //eger kateqoriya 10dan kicikdirse normal davam et deyilse kateqoriyani legv et
                if($_GET['kat'] < 10){
                  //eger linkde kat varsa asagida JS ile o selecti selected et bu deyisenle
                  $kat_selected = $_GET['kat'];
                  echo "<input class='kat_hidden_input' type='hidden' value='".$_GET['kat']."' />";
                  $add_to_select_sql_kat = " WHERE kateqoriya=".$_GET['kat']." ";
                  $select .= $add_to_select_sql_kat;
                  //document.location ve ya href istifade olunan yerlerde linkde istifade edilmesi ucun deyisen teyin edirik
                  $isset_kat = "&kat=".$_GET['kat'];
                }else{
                  echo "<script type='text/javascript'>alert('Kateqoriya dəyəri 8-dən çox ola bilməz! Sizi əsas səhifəyə yönləndiririk.')</script>";
                  echo "<script type='text/javascript'>window.location='xebersil.php?page=1'</script>";
                }
              }else{
                //eger linkde kat yoxdursa deyeri 1 edirik ki asagida JS ile valuesi 1 olan optionu selected edek
                $kat_selected = 0;
                //eger kat yoxdursa linkde,document.location ve ya href istifade olunan yerlerde bos qalir bu deyisen
                $isset_kat = "";
                //eger kat yoxdursa linkde, sqllere where elave etme
                $add_to_select_sql_kat = " ";
                echo "<input class='kat_hidden_input' type='hidden' value='' />";
              }

              $netice = mysqli_query($conn,$select);

              $cemi_xeber_sayi = 0;

              while($row = mysqli_fetch_assoc($netice)){
                //eger xeber varsa true olur ki, tableye xeber yoxdur bildirisi cixmasin asagida
                $xeber_var = true;
                $cemi_xeber_sayi++;
              }
              if(!$xeber_var){
                //eger xeber yoxdursa, bu deyisenin deyeri yuxarida 0 olaraq teyin olunub ve while dongusunde ++ olmadigi ucun burda 1 teyin edilir ki sehife 0 olaraq gorulub basa qaytarilmasin.
                $cemi_xeber_sayi = 1;
              }
            }
            if(isset($_GET['page']) && is_numeric($_GET['page']) && $_GET['page'] > 0){
              $page = $_GET['page'];
            }else{
              echo "<script type='text/javascript'>window.location='xebersil.php?page=1'</script>";
            }
            $sehife_basi_goster = 20;
            //eger sessionda reqem 20 deyilse o zaman hemen reqeme beraber edir sehife basi gosterilecek xeber sayisini
            if(isset($_SESSION['sehife_basi_goster'])){
              if($_SESSION['sehife_basi_goster'] != 20){
                $sehife_basi_goster = $_SESSION['sehife_basi_goster'];
              }
            }
            //siralama sessionu yoxdursa id DESC et, varsa siralamaya beraber et bu siralama, asagida select koduna elave edilir
            if(isset($_SESSION['siralama'])){
              $siralama = " ".$_SESSION['siralama']." ";
            }else{
              $siralama = ' id DESC ';
            }

            $cemi_sehife_sayi = ceil($cemi_xeber_sayi/$sehife_basi_goster);
            $hardan_al = ($page-1) * $sehife_basi_goster;

            if($_GET['page'] > $cemi_sehife_sayi){
              echo "<script type='text/javascript'>alert('Getmək istədiyiniz səhifə, mövcud səhifə sayından çoxdur. Son səhifəyə yönləndirilirsiniz.');window.location='xebersil.php?page=".$cemi_sehife_sayi.$isset_kat.$isset_axtar."'</script>";
            }
        ?>
        <div class="container-fluid">
            <div class="row-fluid">
                <?php
                  include "includes/left_menu.php";
                ?>
                <!--/span-->
                <div class="span9" id="content">
                    <div class="row-fluid">
                        <!-- block -->
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left">MMSD.AZ</div>
                            </div>
                            <p class="p_header_admin">Xəbər Sil
                              <?php
                                if($xeber_var){
                                  echo "<span>xəbər tapıldı.</span>
                                        <span class='badge badge-info'>".$cemi_xeber_sayi."</span>
                                        <span>Nəticələrə uyğun toplamda</span>";
                                }
                              ?>
                            </p>
                            <div class="block-content collapse in">
                                <div class="span12">
                                  <table class="table filter_table">
                                    <tbody>
                                      <tr>
                                        <td>
                                          <p>Səhifə Başı Göstər</p>
                                        </td>
                                        <td>
                                          <select class="span12 chzn-select sehife_basi_goster_select">
                                            <option value="20">20</option>
                                            <option value="50">50</option>
                                            <option value="100">100</option>
                                            <option value="300">300</option>
                                          </select>
                                        </td>
                                        <td>
                                          <button class="btn btn-success" onclick="pass_value_to_session()" >Yenilə</button>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td>
                                          <p>Kateqoriya Filter</p>
                                        </td>
                                        <td>
                                          <select class="span12 chzn-select change_category">
                                            <option value="0" disabled="" selected="">Kateqoriya Seçin</option>
                                            <option value="1">Gündəlik Hadisələr</option>
                                            <option value="2">Maraqlı Faktlar</option>
                                            <option value="3">Hekayələr</option>
                                            <option value="4">Paranormal</option>
                                            <option value="5">Rekordlar</option>
                                            <option value="6">Texnologiya</option>
                                            <option value="7">Möcüzələr və Sirlər</option>
                                            <option value="8">18+</option>
                                              <option value="9">Hazır Topaz Kuponları</option>
                                            <option value="hamisi">Bütün Kateqoriyadakı Xəbərlər</option>
                                          </select>
                                        </td>
                                        <td>
                                          <button class="btn btn-success" onclick="change_category()">Yenilə</button>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td>
                                          <p>Başlıq Axtar</p>
                                        </td>
                                        <td>
                                          <input class="span12 chzn-select axtarilan_basliq" type="text" />
                                        </td>
                                        <td>
                                          <button class="btn btn-success" onclick="axtarilan_basliq()">Axtar</button>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td>
                                          <p>ID Axtar</p>
                                        </td>
                                        <td>
                                          <input class="span12 chzn-select axtarilan_id_getir" type="number" />
                                        </td>
                                        <td>
                                          <button class="btn btn-success" onclick="axtarilan_id_getir()">Axtar</button>
                                        </td>
                                      </tr>
                                      <tr>
                                        <td>
                                          
                                        </td>
                                        <td>
                                          <button class="btn btn-primary filteri_bagla">Filteri Bağla</button>
                                        </td>
                                      </tr>
                                    </tbody>
                                  </table>
                                  <p class="btn btn-success filter_open">Filter</p>


                                  <table class="table siralama_table">
                                    <tbody>
                                      <tr>
                                        <td>
                                          <p>Sıralama</p>
                                        </td>
                                        <td>
                                          <select class="span12 chzn-select siralama_option">
                                            <option name='1' value="id DESC">Tarix Azalan</option>
                                            <option name='2' value="id ASC">Tarix Artan</option>
                                            <option name='3' value="basliq DESC">Başlıq Azalan</option>
                                            <option name='4' value="basliq ASC">Başlıq Artan</option>
                                            <option name='5' value="oxunma_sayi DESC">Baxış Sayı Azalan</option>
                                            <option name='6' value="oxunma_sayi ASC">Baxış Sayı Artan</option>
                                          </select>
                                        </td>
                                      </tr>
                                    </tbody>
                                  </table>
                                    <table class="table table-bordered table-hover xeber_sil_table">
                                      <thead>
                                        <tr>
                                          <th class="tb_esas_sekil">Əsas şəkil</th>
                                          <th class="tb_basliq">Başlıq</th>
                                          <th class="tb_kateqoriya">Kateqoriya</th>
                                          <th class="tb_tarix">Tarix</th>
                                          <th class="tb_oxunma_sayi"><i class="fa fa-eye" aria-hidden="true"></i></th>
                                          <th class="tb_id">ID</th>
                                          <th class="tb_id">Sil</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        <?php
                                          if($conn){
                                            $select = "SELECT id,basliq,oxunma_sayi,kateqoriya,tmp,tarix,saat FROM news ";
                                            $select .= $add_to_select_sql_kat;
                                            $select .= $axtarilan_id;
                                            $select .= $axtarilan_basliq;
                                            $select .= " ORDER BY ".$siralama." LIMIT $hardan_al,$sehife_basi_goster";

                                            $netice = mysqli_query($conn,$select);
                                            while($row = mysqli_fetch_assoc($netice)){
                                              $kat = $row['kateqoriya'];
                                              if($kat == '1'){
                                                $kat = "Gündəlik Hadisələr";
                                              }else if($kat == '2'){
                                                $kat = "Maraqlı Faktlar";
                                              }else if($kat == '3'){
                                                $kat = "Hekayələr";
                                              }else if($kat == '4'){
                                                $kat = "Paranormal";
                                              }else if($kat == '5'){
                                                $kat = "Rekordlar";
                                              }else if($kat == '6'){
                                                $kat = "Texnologiya";
                                              }else if($kat == '7'){
                                                $kat = "Möcüzələr və Sirlər";
                                              }else if($kat == '8'){
                                                $kat = "18+";
                                              }else if($kat == '9'){
                                                $kat = "Hazır Topaz Kuponları";
                                              }
                                              echo "<tr class='xeber_".$row['id']."'>
                                                      <td class='tb_esas_sekil'><img src='../../news_files/".$row['tmp']."/esas.jpg'></td>
                                                      <td class='tb_basliq'><a href='../../news?id=".$row['id']."' target='_blank' >".$row['basliq']."</a></td>
                                                      <td class='tb_kateqoriya'>".$kat."</td>
                                                      <td class='tb_tarix center'>".$row['tarix']."</td>
                                                      <td class='tb_oxunma_sayi center'>".$row['oxunma_sayi']."</td>
                                                      <td class='tb_id'>".$row['id']."</td>
                                                      <td class='tb_id'><button class='btn btn-info edit_btn' onclick='xeber_edit(this.id)' id='edit".$row['id']."'><i class='fa fa-pencil-square-o' aria-hidden='true'></i></button><button class='btn btn-danger delete_btn' id='".$row['id']."' onclick='xeber_sil(this.id)'><i class='fa fa-trash-o' aria-hidden='true'></i></button></td>
                                                    </tr>";
                                            }
                                            //eger xeber yoxdursa ekrana yazi cixart
                                            if(!$xeber_var){
                                              echo "<tr>
                                                      <td class='tb_esas_sekil'>Heç bir xəbər tapılmadı.</td>
                                                      <td class='tb_basliq'></td>
                                                      <td class='tb_kateqoriya'></td>
                                                      <td class='tb_tarix center'></td>
                                                      <td class='tb_oxunma_sayi center'></td>
                                                      <td class='tb_id'></td>
                                                      <td class='tb_id'></td>
                                                    </tr>";
                                            }
                                          }
                                        ?>
                                      </tbody>
                                    </table>
                                    <div class="pagination pagination-big pagination-centered">
                                      <ul>
                                        <?php
                                          if($cemi_sehife_sayi > 5){
                                            $sehife = $page;
                                            $bir = 1;
                                            $iki = 2;
                                            $uc = 3;
                                            $dord = 4;
                                            $bes = 5;

                                            $prev = $sehife-1;
                                            $next = $sehife+1;
                                            if($sehife == 1){
                                                echo "<li class='active'><a href='xebersil.php?page=".$bir.$isset_kat.$isset_axtar."'>".$bir."</a></li>";
                                                echo "<li><a href='xebersil.php?page=".$iki.$isset_kat.$isset_axtar."'>".$iki."</a></li>";
                                                echo "<li><a href='xebersil.php?page=".$uc.$isset_kat.$isset_axtar."'>".$uc."</a></li>";
                                                echo "<li><a href='xebersil.php?page=".$dord.$isset_kat.$isset_axtar."'>".$dord."</a></li>";
                                                echo "<li><a href='xebersil.php?page=".$bes.$isset_kat.$isset_axtar."'>".$bes."</a></li>";
                                                echo "<li><a href='xebersil.php?page=".$next.$isset_kat.$isset_axtar."'> > </a></li>";
                                            }else if($sehife == 2){
                                              echo "<li><a href='xebersil.php?page=".$prev.$isset_kat.$isset_axtar."'> < </a></li>";
                                                echo "<li><a href='xebersil.php?page=".$bir.$isset_kat.$isset_axtar."'>".$bir."</a></li>";
                                                echo "<li class='active'><a href='xebersil.php?page=".$iki.$isset_kat.$isset_axtar."'>".$iki."</a></li>";
                                                echo "<li><a href='xebersil.php?page=".$uc.$isset_kat.$isset_axtar."'>".$uc."</a></li>";
                                                echo "<li><a href='xebersil.php?page=".$dord.$isset_kat.$isset_axtar."'>".$dord."</a></li>";
                                                echo "<li><a href='xebersil.php?page=".$bes.$isset_kat.$isset_axtar."'>".$bes."</a></li>";
                                                echo "<li><a href='xebersil.php?page=".$next.$isset_kat.$isset_axtar."'> > </a></li>";
                                            }else if($sehife >= 3 && $sehife <= $cemi_sehife_sayi-2){
                                                $bir = $sehife-2;
                                                $iki = $sehife-1;
                                                $uc = $sehife;
                                                $dord = $sehife+1;
                                                $bes = $sehife+2;
                                                echo "<li><a href='xebersil.php?page=".$prev.$isset_kat.$isset_axtar."'> < </a></li>";
                                                echo "<li><a href='xebersil.php?page=".$bir.$isset_kat.$isset_axtar."'>".$bir."</a></li>";
                                                echo "<li><a href='xebersil.php?page=".$iki.$isset_kat.$isset_axtar."'>".$iki."</a></li>";
                                                echo "<li class='active'><a href='xebersil.php?page=".$uc.$isset_kat.$isset_axtar."'>".$uc."</a></li>";
                                                echo "<li><a href='xebersil.php?page=".$dord.$isset_kat.$isset_axtar."'>".$dord."</a></li>";
                                                echo "<li><a href='xebersil.php?page=".$bes.$isset_kat.$isset_axtar."'>".$bes."</a></li>";
                                                echo "<li><a href='xebersil.php?page=".$next.$isset_kat.$isset_axtar."'> > </a></li>";
                                            }else if($sehife == $cemi_sehife_sayi-1){
                                                $bir = $sehife-3;
                                                $iki = $sehife-2;
                                                $uc = $sehife-1;
                                                $dord = $sehife;
                                                $bes = $sehife+1;

                                                echo "<li><a href='xebersil.php?page=".$prev.$isset_kat.$isset_axtar."'> < </a></li>";
                                                echo "<li><a href='xebersil.php?page=".$bir.$isset_kat.$isset_axtar."'>".$bir."</a></li>";
                                                echo "<li><a href='xebersil.php?page=".$iki.$isset_kat.$isset_axtar."'>".$iki."</a></li>";
                                                echo "<li><a href='xebersil.php?page=".$uc.$isset_kat.$isset_axtar."'>".$uc."</a></li>";
                                                echo "<li class='active'><a href='xebersil.php?page=".$dord.$isset_kat.$isset_axtar."'>".$dord."</a></li>";
                                                echo "<li><a href='xebersil.php?page=".$bes.$isset_kat.$isset_axtar."'>".$bes."</a></li>";
                                                echo "<li><a href='xebersil.php?page=".$next.$isset_kat.$isset_axtar."'> > </a></li>";
                                            }else if($sehife == $cemi_sehife_sayi){
                                                $bir = $sehife-4;
                                                $iki = $sehife-3;
                                                $uc = $sehife-2;
                                                $dord = $sehife-1;
                                                $bes = $sehife;

                                                echo "<li><a href='xebersil.php?page=".$prev.$isset_kat.$isset_axtar."'> < </a></li>";
                                                echo "<li><a href='xebersil.php?page=".$bir.$isset_kat.$isset_axtar."'>".$bir."</a></li>";
                                                echo "<li><a href='xebersil.php?page=".$iki.$isset_kat.$isset_axtar."'>".$iki."</a></li>";
                                                echo "<li><a href='xebersil.php?page=".$uc.$isset_kat.$isset_axtar."'>".$uc."</a></li>";
                                                echo "<li><a href='xebersil.php?page=".$dord.$isset_kat.$isset_axtar."'>".$dord."</a></li>";
                                                echo "<li class='active'><a href='xebersil.php?page=".$bes.$isset_kat.$isset_axtar."'>".$bes."</a></li>";
                                            }

                                          }else{
                                              for($a=1; $a<=$cemi_sehife_sayi; $a++){ 
                                                  echo "<li id='sehife".$a."'><a href='xebersil.php?page=".$a.$isset_kat.$isset_axtar."'>".$a."</a></li>"; 
                                              };
                                              //hansi sehifededirse o sehifenin li sini active edir
                                              echo "<script type='text/javascript'>
                                                  document.getElementById('sehife'+'".$page."').setAttribute('class','active');
                                              </script>";
                                          }
                                        ?>
                                      </ul>
                                    </div>
                                    <div class="sehifeye_get_div">
                                      <input type="number" placeholder="Səhifəyə Get">
                                      <button onclick="go_to_page()" class="btn btn-info">Get</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /block -->
                    </div>
                </div>
            </div>
            <?php
                include "includes/footer.php";
                //siralama string oldugu ucun (meselen 'id asc') asagida siralanana uygun olaraq optionu selected etmek olmur, ona gore reqem edilir ve optionu bu nameye beraber olan selected edilir meselen name=1
                if($siralama==" id DESC "){
                  $siralama = 1;
                }else if($siralama==" id ASC "){
                  $siralama = 2;
                }else if($siralama==" basliq DESC "){
                  $siralama = 3;
                }else if($siralama==" basliq ASC "){
                  $siralama = 4;
                }else if($siralama==" oxunma_sayi DESC "){
                  $siralama = 5;
                }else if($siralama==" oxunma_sayi ASC "){
                  $siralama = 6;
                }
            ?>
        </div>
        <!--/.fluid-container-->
        <script src="vendors/jquery-1.9.1.min.js"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/scripts.js"></script>
        <script>
            $(".left_menu2").addClass("active");
            function xeber_sil(id){
              $.ajax({
                url:"functions/xeber_sil.php",
                data:{id:id},
                method:"POST",
                success:function(gelen){
                  if(gelen == "ok"){
                    $(".xeber_"+id).hide("slow");
                  }else if(gelen == "xeber_yoxdur"){
                    alert("Bu ID adresində xəbər yoxdur!");
                  }else{
                    alert("Xəta baş verdi! "+gelen);
                  }
                }
              });
            }
            function xeber_edit(id){
              var id = id;
              var n = id.lastIndexOf('t');
              var id = id.substring(n + 1);
              window.open("xeber_edit.php?id="+id, "_blank");
            }
            $(".filter_open").on('click',function(){
              $(".filter_table").show(600);
              $(".filter_open").hide();
            });
            $(".filteri_bagla").on('click',function(){
              $(".filter_table").hide(300);
              $(".filter_open").show();
            });
            //filterde sehife basi gostermeni deyisende, session teyin edir ve yeni acilan sehifelerde o sessiona esasen sehifede xeber gosterir
            function pass_value_to_session(){
              var select_val = $(".sehife_basi_goster_select").val();
              $.ajax({
                url:"functions/sehife_basi_goster_session.php",
                data:{sehife_basi_goster:select_val},
                method:"POST",
                success:function(){
                  //eger linkde kateqoriyada varsa o zaman yeni acilan linkede daxil et
                  kat = $('.kat_hidden_input').val();
                  if(kat != ""){
                    window.location='xebersil.php?page=1&kat='+kat;
                  }else{
                    window.location='xebersil.php?page=1';
                  }
                }
              });
            }
            //kateqoriyani deyisir
            function change_category(){
              var kat = $('.change_category').val();
              if(kat==null){
                alert("Kateqoriya seçin!");
              }else if(kat == 'hamisi'){
                window.location='xebersil.php?page=1';
              }else{
                window.location='xebersil.php?page=1&kat='+kat;
              }
            }
            //filterdeki basliq axtar bolumu
            function axtarilan_basliq(){
              var axtarilan_basliq = $('.axtarilan_basliq').val();
              if(!/^[a-zA-Z0-9əƏşŞçÇöÖğĞüÜıIİ .,]*$/g.test(axtarilan_basliq)){
                alert("Yalnız hərf və rəqəm axtara bilərsiniz.");
              }else{
                window.location='xebersil.php?page=1&axtar='+axtarilan_basliq;
              }
            }
            //filterde ID axtar buttonuna basanda bu funksiya ise dusur
            function axtarilan_id_getir(){
              var axtarilan_id = $('.axtarilan_id_getir').val();
              if(axtarilan_id > 0){
                window.location='xebersil.php?page=1&id='+axtarilan_id;
              }else{
                alert("ID adresi düzgün yazılmayıb.\n(ID adresi 0'dan böyük rəqəm olmalıdır.)");
              }
            }
            //siralama optionu deyisende deyeri (meselen 'id desc') oturur diger fayla ve session yaradir sehife yuklenendede sessiona esasen siralayir tableni
            $(".siralama_option").on('change',function(){
              var siralama = $(".siralama_option").val();
              $.ajax({
                url:"functions/siralamani_deyis_session.php",
                data:{siralama:siralama},
                method:"POST",
                success:function(){
                  location.reload();
                }
              });
            });
            $(document).ready(function(){
              $('.sehife_basi_goster_select option[value=<?php echo $sehife_basi_goster;?>]').attr('selected','selected');
              $('.change_category option[value=<?php echo $kat_selected;?>]').attr('selected','selected');
              $('.siralama_option option[name=<?php echo $siralama;?>]').attr('selected','selected');
            });
            function go_to_page(){
              var gedilecek_sehife = $('.sehifeye_get_div input').val();

              if(gedilecek_sehife != ""){
                var cemi_sehife_sayi = '<?php echo $cemi_sehife_sayi;?>';
                //cemi sehife sayini echo etdiyim deyisen string oldugu ucun parseInt edirem
                cemi_sehife_sayi = parseInt(cemi_sehife_sayi);

                if(gedilecek_sehife > cemi_sehife_sayi){
                  alert('Getmək istədiyiniz səhifə, mövcud səhifə sayından çoxdur. Son səhifə: '+cemi_sehife_sayi);
                }else{
                  //eger linkde kateqoriyada varsa o zaman yeni acilan linkede daxil et
                  kat = $('.kat_hidden_input').val();
                  axtar_hidden_input = $('.axtar_hidden_input').val();
                  if(kat != ""){
                    window.location='xebersil.php?page='+gedilecek_sehife+'&kat='+kat;
                  }else{
                    window.location='xebersil.php?page='+gedilecek_sehife;
                  }
                  if(axtar_hidden_input != ""){
                    window.location='xebersil.php?page='+gedilecek_sehife+'&axtar='+axtar_hidden_input;
                  }
                }
              }else{
                alert("Getmək istədiyiniz səhifəni daxil edin!");
              }
            }
        </script>
    </body>
</html>
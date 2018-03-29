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
              $select = "SELECT id FROM news WHERE slider = 1 ";
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
                            <p class="p_header_admin">Sliderdən Xəbər Sil
                              <?php
                                if($xeber_var){
                                  echo "<span>xəbər var.</span>
                                        <span class='badge badge-info'>".$cemi_xeber_sayi."</span>
                                        <span>Sliderdə </span>";
                                }
                              ?>
                            </p>
                            <div class="block-content collapse in">
                                <div class="span12">
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
                                            $select = "SELECT id,basliq,oxunma_sayi,kateqoriya,tmp,tarix FROM news WHERE slider=1 ORDER BY id DESC";

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
                                              }
                                              echo "<tr class='xeber_".$row['id']."'>
                                                      <td class='tb_esas_sekil'><img src='../../news_files/".$row['tmp']."/esas.jpg'></td>
                                                      <td class='tb_basliq'><a href='../../news?id=".$row['id']."' target='_blank' >".$row['basliq']."</a></td>
                                                      <td class='tb_kateqoriya'>".$kat."</td>
                                                      <td class='tb_tarix center'>".$row['tarix']."</td>
                                                      <td class='tb_oxunma_sayi center'>".$row['oxunma_sayi']."</td>
                                                      <td class='tb_id'>".$row['id']."</td>
                                                      <td class='tb_id'><button class='btn btn-danger edit_btn slider_add_btn' onclick='add_to_slider(this.id)' id='edit".$row['id']."'><i class='fa fa-times' aria-hidden='true'></i></button></td>
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
                                </div>
                            </div>
                        </div>
                        <!-- /block -->
                    </div>
                </div>
            </div>
            <?php
                include "includes/footer.php";
            ?>
        </div>
        <!--/.fluid-container-->
        <script src="vendors/jquery-1.9.1.min.js"></script>
        <script src="bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/scripts.js"></script>
        <script>
            $(".left_menu7").addClass("active");
            function add_to_slider(id){
              var id = id;
              var n = id.lastIndexOf('t');
              var id = id.substring(n + 1);
              $.ajax({
                url:"functions/remove_from_slider.php",
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
        </script>
    </body>
</html>
<?php
    session_start();
    if(isset($_SESSION['login_fv26d5s1s8w92dfc']) && isset($_SESSION['password_df165w6f1d5f94fq'])){
        include "../../db/db.php";

        //linkdeki xeberin id adresini alir
        if(isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0){
          $id = $_GET['id'];
          //bele bir xeberin db da olub olmamagini yoxlayir
          $select = "SELECT id FROM news WHERE id = $id";
          $netice = mysqli_query($conn,$select);
          while($row = mysqli_fetch_assoc($netice)){
            $db_xeber_var = true;
          }
          if(!isset($db_xeber_var)){
            echo "<script>alert('Bu ID adresinə uyğun xəbər tapılmadı!');</script>";
            echo "<script>window.location.href='xebersil.php';</script>";
            exit();
          }
        }else{
          echo "<script>alert('Seçdiyiniz xəbərin ID adresində səhvlik var!');</script>";
          echo "<script>window.location.href='admin.php';</script>";
        }
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
                            <div class="block-content collapse in">
                                <div class="span12">
                                    <form class="form-horizontal xeber_elave_et_formu" action="functions/edit_xeber.php" method='post' enctype="multipart/form-data">
                                      <fieldset>
                                        <legend>Xəbər Redaktə Et</legend>
                                        <?php
                                          if($conn){
                                            $select = "SELECT id,basliq,basliq_iki,metn,kateqoriya,tmp,tarix,saat FROM news WHERE id = $id";
                                            $netice = mysqli_query($conn,$select);
                                            while($row = mysqli_fetch_assoc($netice)){
                                              $kat = $row['kateqoriya'];
                                              $tmp = $row['tmp'];
                                              echo "
                                                  <div class='control-group'>
                                                    <label class='control-label' for='typeahead'>Əsas Başlıq (max. 100)<span class='vacib_bolme'>*</span></label>
                                                    <div class='controls'>
                                                      <input type='hidden' name='id' value='".$row['id']."'>
                                                      <input type='hidden' name='img_tmp' value='".$tmp."'>
                                                      <input type='text' class='span6 edit_inputs' id='typeahead' maxlength='100' required='' name='basliq' value='".$row['basliq']."'>
                                                    </div>
                                                  </div>
                                                  <div class='control-group'>
                                                    <label class='control-label' for='typeahead'>Açıqlama Başlığı (max. 100)</label>
                                                    <div class='controls'>
                                                      <input type='text' class='span6 edit_inputs' id='typeahead' maxlength='100' name='basliq_iki' value='".$row['basliq_iki']."' >
                                                    </div>
                                                  </div>
                                                  <div class='control-group'>
                                                    <label class='control-label' for='select01'>Kateqoriya</label>
                                                    <div class='controls'>
                                                      <select id='select01' class='span6 chzn-select' name='kateqoriya' required>
                                                        <option value='1'>Gündəlik Hadisələr</option>
                                                        <option value='2'>Maraqlı Faktlar</option>
                                                        <option value='3'>Hekayələr</option>
                                                        <option value='4'>Paranormal</option>
                                                        <option value='5'>Rekordlar</option>
                                                        <option value='6'>Texnologiya</option>
                                                        <option value='7'>Möcüzələr və Sirlər</option>
                                                        <option value='8'>18+</option>
                                                        <option value='9'>Hazır Topaz Kuponları</option>
                                                      </select>
                                                    </div>
                                                  </div>
                                                  <div class='control-group my_CKeditor_div'>
                                                    <label class='control-label' for='typeahead'>Xəbərin Mətni<span class='vacib_bolme'>*</span></label>
                                                    <div class='controls'>
                                                      <textarea id='ckeditor_full' name='metn' cols='80'>".$row['metn']."</textarea>
                                                    </div>
                                                  </div>";
                                            }
                                          }
                                          echo "<div class='block-content collapse in'>
                                                  <div class='row-fluid padd-bottom'>
                                                    <div class='span12 sekiller_div'>";
                                          $select_ph = "SELECT * FROM photos WHERE tmp = '$tmp' ORDER BY CASE WHEN image LIKE 'esas%' THEN 0 ELSE 1 END ASC, image ASC";
                                          $netice_ph = mysqli_query($conn,$select_ph);
                                          $img_server = 0;
                                          $main_is_templated = false;
                                          while($row=mysqli_fetch_assoc($netice_ph)){
                                            if($main_is_templated == false){
                                              echo "<div><span class='esas_sekil_yazisi'>Xəbərin Əsas Şəkli</span><img src='../../news_files/".$tmp."/".$row['image']."'></div>";
                                            }else{
                                              echo "<div><button type='button' id='".$row['id']."' onclick='delete_imgs(this.id)'><i class='fa fa-trash-o' aria-hidden='true'></i></button><img src='../../news_files/".$tmp."/".$row['image']."'></div>";
                                            }
                                            $img_server++;
                                            $main_is_templated = true;
                                          }
                                          echo "</div>
                                                      </div>";
                                        ?>
                                        
                                        <div class="control-group">
                                          <label class="control-label" for="fileInput">Şəkillər (max. <span class="nece_img_secmek_olar">15</span> şəkil)</label>
                                          <div class="controls">
                                            <input type="hidden" name="silinecek_sekiller" value="">
                                            <input class="input-file uniform_on custom-file-input" id="fileInput" type="file" multiple="" name="image[]">
                                            <span class="how_many_img"></span>
                                            <p class="sekil_bildiris">1. Əsas şəkli seçmədən öncə əsas şəkilin adını 'esas' qoyun.</p>
                                            <p class="sekil_bildiris">2. Şəkillərin eni 1920px-dən çox olmamalıdır.</p>
                                            <p class="sekil_bildiris">3. Şəkillərin adları 10 simvoldan uzun olmamalıdır!!! (numune-ad.jpg)</p>
                                          </div>
                                        </div>
                                        <div class="form-actions">
                                          <input type="submit" class="btn btn-primary" name="submit" value="Yadda Saxla" />
                                        </div>
                                      </fieldset>
                                    </form>

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
        <script src="vendors/ckeditor/ckeditor.js"></script>
        <script src="vendors/ckeditor/adapters/jquery.js"></script>
        <script>
            $(function(){
                // Ckeditor standard
                $( 'textarea#ckeditor_full' ).ckeditor();
            });
            //sekiller silindikce sayi deyisir asagida
            var can_choose = '<?php echo 15-$img_server;?>';

            $(document).ready(function(){
              $('#select01 option[value=<?php echo $kat;?>]').attr('selected','selected');
            })
            //nece sekil secile biler
            function how_many_can_choose(){
              $(".nece_img_secmek_olar").text(can_choose);
              toplam_foto = $('#fileInput').get(0).files.length;
              $(".how_many_img").text(toplam_foto+' Şəkil seçildi.');
              if(toplam_foto > can_choose){
                alert("Ən çox "+can_choose+" şəkil əlavə oluna bilər!");
                $('#fileInput').val('');
                $(".how_many_img").text('0 Şəkil seçildi.');
              }
            }
            how_many_can_choose();

            //sekil secilende yoxla limiti kecmeyib
            $('#fileInput').change(function(){
              how_many_can_choose();
            });

            $(".xeber_elave_et_formu").submit(function(){
              var xeber_metni = $("#ckeditor_full").val();
              if(xeber_metni == ""){
                alert("Xəbərin mətnini daxil edin!");
                return false;
              }
            });
            //sekillere klik edende silinecek sekillerin adlarini hidden inputa elave et
            function delete_imgs(id){
              //hidden inputun deyeri alinir (eger deyeri varsa (x, x-x, x-x-x) o zaman onlarin ardina -x elave edecek)
              var silinecek_sekiller =  $('input[name="silinecek_sekiller"]').val();
              //deyeri bosdursa sadece id reqemi beraber et
              if(silinecek_sekiller==""){
                $('input[name="silinecek_sekiller"]').val(id);
              }else{
                //deyeri varsa meselen 1 o zaman 1 reqemine -x elave et olsun 1-2 veya 1-3 veya 1-5
                $('input[name="silinecek_sekiller"]').val(silinecek_sekiller+"-"+id);
              }
              //silinen sekilin divini yox et (sekil heleki serverden silinmir)
              $("#"+id).parent().hide(700);
              can_choose = parseInt(can_choose) + 1;
              how_many_can_choose();
            }
        </script>
    </body>

</html>
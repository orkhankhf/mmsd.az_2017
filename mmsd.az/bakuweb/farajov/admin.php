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
                                    <form class="form-horizontal xeber_elave_et_formu" action="functions/xeber_elave_et.php" method='post' enctype="multipart/form-data">
                                      <fieldset>
                                        <legend>Xəbər Əlavə Et</legend>
                                        <div class="control-group">
                                          <label class="control-label" for="typeahead">Əsas Başlıq<span class="vacib_bolme">*</span></label>
                                          <div class="controls">
                                            <input type="text" class="span6" id="typeahead" maxlength="100" required="" name="basliq" placeholder="Max. 100">
                                          </div>
                                        </div>
                                        <div class="control-group">
                                          <label class="control-label" for="typeahead">Açıqlama Başlığı</label>
                                          <div class="controls">
                                            <input type="text" class="span6" id="typeahead" maxlength="100" name="basliq_iki" placeholder="Max. 100">
                                          </div>
                                        </div>
                                        <div class="control-group">
                                          <label class="control-label" for="select01">Kateqoriya<span class="vacib_bolme">*</span></label>
                                          <div class="controls">
                                            <select id="select01" class="span6 chzn-select" name="kateqoriya" required>
                                              <option value="" disabled="" selected="">Kateqoriya Seçin</option>
                                              <option value="1">Gündəlik Hadisələr</option>
                                              <option value="2">Maraqlı Faktlar</option>
                                              <option value="3">Hekayələr</option>
                                              <option value="4">Paranormal</option>
                                              <option value="5">Rekordlar</option>
                                              <option value="6">Texnologiya</option>
                                              <option value="7">Möcüzələr və Sirlər</option>
                                              <option value="8">18+</option>
                                              <option value="9">Hazır Topaz Kuponları</option>
                                            </select>
                                          </div>
                                        </div>
                                        <div class="control-group my_CKeditor_div">
                                          <label class="control-label" for="typeahead">Xəbərin Mətni<span class="vacib_bolme">*</span></label>
                                          <div class="controls">
                                            <textarea id="ckeditor_full" name="metn" cols="80"></textarea>
                                          </div>
                                        </div>
                                        <div class="control-group">
                                          <label class="control-label" for="fileInput">Şəkillər (max. 15 şəkil)<span class="vacib_bolme">*</span></label>
                                          <div class="controls">
                                            <input class="input-file uniform_on custom-file-input" id="fileInput" type="file" multiple="" name="image[]" required="">
                                            <span class="how_many_img"></span>
                                            <p class="sekil_bildiris">1. Şəkilləri seçmədən öncə əsas şəkilin adını 'esas' qoyun.</p>
                                            <p class="sekil_bildiris">2. Şəkillərin eni 1920px-dən çox olmamalıdır.</p>
                                            <p class="sekil_bildiris">3. Şəkillərin adları 10 simvoldan uzun olmamalıdır!!! (numune-ad.jpg)</p>
                                          </div>
                                        </div>
                                        <div class="form-actions">
                                          <input type="submit" class="btn btn-primary" name="submit" value="Əlavə et" />
                                          <button type="reset" class="btn" onclick="reset_textarea()">Sıfırla</button>
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
            $(".left_menu1").addClass("active");
            $(function(){
                // Ckeditor standard
                $( 'textarea#ckeditor_full' ).ckeditor();
            });
            $('#fileInput').change(function(){
              var esas_sekil_secildi = false;
              for(var i = 0; i < this.files.length; i++){
                if(this.files[i].name == "esas.jpg"){
                  esas_sekil_secildi = true;
                }
              }
              if(esas_sekil_secildi != true){
                alert("Əsas şəkil seçilməyib! Əsas şəkli seçmək üçün,\nadını esas.jpg qoyun və şəkilləri yenidən seçin.");
                $("#fileInput").val('');
              }
              toplam_foto = this.files.length;
              if(toplam_foto>15){
                alert("Ən çox 15 şəkil əlavə oluna bilər!");
                $('#fileInput').val('');
                $(".how_many_img").text('');
              }else{
                $(".how_many_img").text(toplam_foto+' Şəkil seçildi.');
              }
            });
            function reset_textarea(){
              $("#ckeditor_full").val('');
              $(".how_many_img").text('');
            }
            $(".xeber_elave_et_formu").submit(function(){
              var xeber_metni = $("#ckeditor_full").val();
              if(xeber_metni == ""){
                alert("Xəbərin mətnini daxil edin!");
                return false;
              }
            });
        </script>
    </body>

</html>
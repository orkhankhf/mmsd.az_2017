<?php
    session_start();
    if(isset($_SESSION['login_fv26d5s1s8w92dfc']) && isset($_SESSION['password_df165w6f1d5f94fq'])){
        include "../../db/db.php";
    }else{
        echo "<script>window.location.href='../farajov';</script>";
    }
    if($_SESSION['rutbe'] == "redaktor"){
        echo "<script>alert('Bu səhifəyə giriş icazəniz yoxdur!');</script>";
        echo "<script>window.location.href='../farajov/admin.php';</script>";
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
                                    <form class="form-horizontal xeber_elave_et_formu" action="functions/rdktr_elave_et.php" method='post'>
                                      <fieldset>
                                        <legend>Redaktor Əlavə Et</legend>
                                        <div class="control-group">
                                          <label class="control-label" for="ad">Ad<span class="vacib_bolme">*</span></label>
                                          <div class="controls">
                                            <input type="text" class="span6" id="ad" maxlength="15" required="" name="ad" placeholder="Max. 15 (Xəbər səhifəsində yazılan ad)">
                                          </div>
                                        </div>
                                        <div class="control-group">
                                          <label class="control-label" for="lgn">Birdəfəlik Login<span class="vacib_bolme">*</span></label>
                                          <div class="controls">
                                            <input type="text" class="span6" id="lgn" maxlength="25" required="" name="birdefelik_login" placeholder="Max. 25">
                                          </div>
                                        </div>
                                        <div class="control-group">
                                          <label class="control-label" for="sfr">Birdəfəlik Şifrə<span class="vacib_bolme">*</span></label>
                                          <div class="controls">
                                            <input type="text" class="span6" id="sfr" maxlength="25" required="" name="birdefelik_sifre" placeholder="Max. 25">
                                          </div>
                                        </div>
                                        <div class="form-actions">
                                          <input type="submit" class="btn btn-primary" name="submit" value="Təsdiqlə" />
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
        <script>
            $(".left_menu3").addClass("active");
        </script>
    </body>

</html>
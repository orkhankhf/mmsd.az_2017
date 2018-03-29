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
<!-- BU SEHIFE BASQA SEHIFEDEN COPY OLUNDUGU UCUN BEZI CLASS ADLARI DIGER SEHIFELERE AID OLA BILER -->
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
                <!-- BU SEHIFE BASQA SEHIFEDEN COPY OLUNDUGU UCUN BEZI CLASS ADLARI DIGER SEHIFELERE AID OLA BILER -->
                <div class="span9" id="content">
                    <div class="row-fluid">
                        <!-- block -->
                        <div class="block">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left">MMSD.AZ</div>
                            </div>
                            <p class="p_header_admin">Redaktor Sil
                              <span> redaktor mövcuddur.</span>
                              <span class='badge badge-info toplam_redaktor_sayi'></span>
                              <span>Saytda toplamda </span>
                            </p>
                            <div class="block-content collapse in">
                                <div class="span12">
                                    <!-- BU SEHIFE BASQA SEHIFEDEN COPY OLUNDUGU UCUN BEZI CLASS ADLARI DIGER SEHIFELERE AID OLA BILER -->
                                    <table class="table table-bordered table-hover xeber_sil_table redaktor_sil_table">
                                      <thead>
                                        <tr>
                                          <th>ID</th>
                                          <th>Ad</th>
                                          <th>Rütbə</th>
                                          <th>Yazdığı Xəbər Sayı</th>
                                          <th>Toplam Oxunma</th>
                                          <th>Status</th>
                                          <th>Sil</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                        <?php
                                          if($conn){
                                            $select = "SELECT id,ad,rutbe,aktiv,xeber_sayi FROM bakuweb_admin";
                                            $netice = mysqli_query($conn,$select);
                                            $toplam_redaktor_sayi = 0;
                                            while($row = mysqli_fetch_assoc($netice)){
                                              $toplam_redaktor_sayi++;
                                              $id = $row['id'];
                                              $netice_to = mysqli_query($conn,"SELECT SUM(oxunma_sayi) AS total_oxunma FROM news WHERE muellif = '$id'");
                                              $total = mysqli_fetch_assoc($netice_to);
                                              if($total['total_oxunma'] == null){
                                                $total['total_oxunma'] = 0;
                                              }

                                              if($row['aktiv'] == 1){
                                                $status = "Aktiv";
                                              }else{
                                                $status = "Passiv";
                                              }
                                              if($row['rutbe'] == "redaktor"){
                                                $rutbe = "Redaktor";
                                                $delete_btn = "<button class='btn btn-danger editor_delete_btn' id='".$row['id']."' onclick='redaktor_sil(this.id)'><i class='fa fa-trash-o' aria-hidden='true'></i></button>";
                                              }else{
                                                $rutbe = "Baş Admin";
                                                $delete_btn = "<button disabled class='btn btn-danger editor_delete_btn'><i class='fa fa-trash-o' aria-hidden='true'></i></button>";
                                              }
                                              echo "<tr class='redaktor".$row['id']."'>
                                                      <td>".$row['id']."</td>
                                                      <td>".$row['ad']."</td>
                                                      <td>".$rutbe."</td>
                                                      <td>".$row['xeber_sayi']."</td>
                                                      <td>".$total['total_oxunma']."</td>
                                                      <td>".$status."</td>
                                                      <td>".$delete_btn."</td>
                                                    </tr>";
                                            }
                                          }
                                        ?>
                                      </tbody>
                                    </table>
                                    <!-- BU SEHIFE BASQA SEHIFEDEN COPY OLUNDUGU UCUN BEZI CLASS ADLARI DIGER SEHIFELERE AID OLA BILER -->
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
        <!-- BU SEHIFE BASQA SEHIFEDEN COPY OLUNDUGU UCUN BEZI CLASS ADLARI DIGER SEHIFELERE AID OLA BILER -->
        <script>
            $(".left_menu4").addClass("active");
            $(".toplam_redaktor_sayi").text("<?php echo $toplam_redaktor_sayi; ?>");
            function redaktor_sil(id){
              $.ajax({
                url:"functions/editor_sil.php",
                data:{id:id},
                method:"POST",
                success:function(gelen){
                  if(gelen == "ok"){
                    $(".redaktor"+id).hide("slow");
                    var yeni_redaktor_sayi = $(".toplam_redaktor_sayi").text()-1;
                    $(".toplam_redaktor_sayi").text(yeni_redaktor_sayi);
                  }else{
                    alert("Xəta baş verdi! "+gelen);
                  }
                }
              });
            }
        </script>
    </body>
</html>
<!-- BU SEHIFE BASQA SEHIFEDEN COPY OLUNDUGU UCUN BEZI CLASS ADLARI DIGER SEHIFELERE AID OLA BILER -->
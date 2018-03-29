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
    date_default_timezone_set("Asia/Baku");
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
                        <div class="block statistika_main">
                            <div class="navbar navbar-inner block-header">
                                <div class="muted pull-left">MMSD.AZ</div>
                            </div>
                            <div class="block-content collapse in">
                                <h5>İllik Statistika</h5>
                                <div class="span12">
				                    <div class="block-content collapse in">
				                        <div class="span12">
                                            <div class="statistika_basliqlari">
                                                <p>Gündəlik Hadisələr</p>
                                                <p>Maraqlı Faktlar</p>
                                                <p>Hekayələr</p>
                                                <p>Paranormal</p>
                                                <p>Rekordlar</p>
                                                <p>Texnologiya</p>
                                                <p>Möcüzələr Və Sirlər</p>
                                                <p>18+</p>
                                                <p>Hazır Topaz Kuponları</p>
                                            </div>
				                            <div id="hero-graph" style="height: 230px;"></div>
				                        </div>
				                    </div>
                                </div>
                            </div>
                            <div class="block-content collapse in">
                                <div class="span6 chart">
                                    <h5>Son 7 Günün Ümumi Statistikası</h5>
                                    <div id="hero-bar" style="height: 250px;"></div>
                                </div>
                                <div class="span5 chart">
                                    <h5>Bu Günün Statistikası</h5>
                                    <div id="hero-donut" style="height: 250px;"></div>    
                                </div>
                            </div>
                            <?php
                                //grafiklerde il olaraq ili sececek
                                $il = date("Y");
                                $all_statics = array();
                                for($b=1;$b<10;$b++){
                                    $category_array = array();
                                    for($a=1; $a<=12; $a++){
                                        if($a != 12){
                                            $date_from = $il."/".$a."/1";
                                            $select_by_month = mysqli_query($conn,"SELECT SUM(oxunma_sayi) AS total_oxunma FROM news WHERE kateqoriya = '$b' and tarix between '$date_from' and '".$il."/".($a+1)."/1'");
                                            $total = mysqli_fetch_assoc($select_by_month);
                                            if($total['total_oxunma'] == null){
                                                $total['total_oxunma'] = 0;
                                            }
                                            array_push($category_array, array('ay'=>$date_from,'statistik_netice'=>$total['total_oxunma']));
                                        }else{
                                            $date_from = $il."/12/1";
                                            $select_by_month = mysqli_query($conn,"SELECT SUM(oxunma_sayi) AS total_oxunma FROM news WHERE kateqoriya = '$b' and tarix between '$date_from' and '".$il."/12/31'");
                                            $total = mysqli_fetch_assoc($select_by_month);
                                            if($total['total_oxunma'] == null){
                                                $total['total_oxunma'] = 0;
                                            }
                                            array_push($category_array, array('ay'=>$date_from,'statistik_netice'=>$total['total_oxunma']));
                                        }
                                    }
                                    array_push($all_statics, $category_array);
                                }

                                //heftelik trafiki hesablayir
                                $heftelik = array();
                                for($i=1; $i<=7; $i++){
                                    $last_7_days = date('Y-m-d',strtotime('-'.$i.' day'));
                                    $select_by_week = mysqli_query($conn,"SELECT SUM(oxunma_sayi) AS total_oxunma FROM news WHERE tarix = '$last_7_days'");
                                    $total = mysqli_fetch_assoc($select_by_week);
                                    if($total['total_oxunma'] == null){
                                        $total['total_oxunma'] = 0;
                                    }
                                    array_push($heftelik, $total['total_oxunma']);
                                }

                                //gundelik trafiki hesablayir
                                $bugun = date("Y-m-d");
                                $today_static = array();
                                for($b=1;$b<10;$b++){
                                    $select_today = mysqli_query($conn,"SELECT SUM(oxunma_sayi) AS total_oxunma FROM news WHERE kateqoriya = '$b' and tarix = '$bugun'");
                                    $total = mysqli_fetch_assoc($select_today);
                                    if($total['total_oxunma'] == null){
                                        $total['total_oxunma'] = 0;
                                    }
                                    array_push($today_static, $total['total_oxunma']);
                                }

                            ?>
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
        <link rel="stylesheet" href="vendors/morris/morris.css">        
        <script src="vendors/jquery.knob.js"></script>
        <script src="vendors/raphael-min.js"></script>
        <script src="vendors/morris/morris.min.js"></script>
        <script src="vendors/flot/jquery.flot.js"></script>
        <script src="vendors/flot/jquery.flot.categories.js"></script>
        <script src="vendors/flot/jquery.flot.pie.js"></script>
        <script src="vendors/flot/jquery.flot.time.js"></script>
        <script src="vendors/flot/jquery.flot.stack.js"></script>
        <script src="vendors/flot/jquery.flot.resize.js"></script>

        <script src="assets/scripts.js"></script>
        <script>
            $(".left_menu5").addClass("active");
            //yuxarida php arrayindan js arrayina cevirir
            <?php
                $all_statics = json_encode($all_statics);
                echo "var all_statics = ". $all_statics . ";\n";

                $today_static = json_encode($today_static);
                echo "var today_static = ". $today_static . ";\n";

                $heftelik = json_encode($heftelik);
                echo "var heftelik = ". $heftelik . ";\n";
            ?>

            // Morris Line Chart
        	var tax_data = [
	            {"period": "<?php echo $il; ?>-12", "gundelik_hadiseler": 1, "maraqli_faktlar": 2, "hekayeler": 3,"paranormal":4,"rekordlar":5,"texnologiya":6,"mocuzeler_ve_sirler":7,"18_plus":8,"topaz_kuponlari":9},
                {"period": "<?php echo $il; ?>-11", "gundelik_hadiseler": 1, "maraqli_faktlar": 2, "hekayeler": 3,"paranormal":4,"rekordlar":5,"texnologiya":6,"mocuzeler_ve_sirler":7,"18_plus":8,"topaz_kuponlari":9},
                {"period": "<?php echo $il; ?>-10", "gundelik_hadiseler": 1, "maraqli_faktlar": 2, "hekayeler": 3,"paranormal":4,"rekordlar":5,"texnologiya":6,"mocuzeler_ve_sirler":7,"18_plus":8,"topaz_kuponlari":9},
                {"period": "<?php echo $il; ?>-09", "gundelik_hadiseler": 1, "maraqli_faktlar": 2, "hekayeler": 3,"paranormal":4,"rekordlar":5,"texnologiya":6,"mocuzeler_ve_sirler":7,"18_plus":8,"topaz_kuponlari":9},
                {"period": "<?php echo $il; ?>-08", "gundelik_hadiseler": 1, "maraqli_faktlar": 2, "hekayeler": 3,"paranormal":4,"rekordlar":5,"texnologiya":6,"mocuzeler_ve_sirler":7,"18_plus":8,"topaz_kuponlari":9},
                {"period": "<?php echo $il; ?>-07", "gundelik_hadiseler": 1, "maraqli_faktlar": 2, "hekayeler": 3,"paranormal":4,"rekordlar":5,"texnologiya":6,"mocuzeler_ve_sirler":7,"18_plus":8,"topaz_kuponlari":9},
                {"period": "<?php echo $il; ?>-06", "gundelik_hadiseler": 1, "maraqli_faktlar": 2, "hekayeler": 3,"paranormal":4,"rekordlar":5,"texnologiya":6,"mocuzeler_ve_sirler":7,"18_plus":8,"topaz_kuponlari":9},
                {"period": "<?php echo $il; ?>-05", "gundelik_hadiseler": 1, "maraqli_faktlar": 2, "hekayeler": 3,"paranormal":4,"rekordlar":5,"texnologiya":6,"mocuzeler_ve_sirler":7,"18_plus":8,"topaz_kuponlari":9},
                {"period": "<?php echo $il; ?>-04", "gundelik_hadiseler": 1, "maraqli_faktlar": 2, "hekayeler": 3,"paranormal":4,"rekordlar":5,"texnologiya":6,"mocuzeler_ve_sirler":7,"18_plus":8,"topaz_kuponlari":9},
                {"period": "<?php echo $il; ?>-03", "gundelik_hadiseler": 1, "maraqli_faktlar": 2, "hekayeler": 3,"paranormal":4,"rekordlar":5,"texnologiya":6,"mocuzeler_ve_sirler":7,"18_plus":8,"topaz_kuponlari":9},
                {"period": "<?php echo $il; ?>-02", "gundelik_hadiseler": 1, "maraqli_faktlar": 2, "hekayeler": 3,"paranormal":4,"rekordlar":5,"texnologiya":6,"mocuzeler_ve_sirler":7,"18_plus":8,"topaz_kuponlari":9},
                {"period": "<?php echo $il; ?>-01", "gundelik_hadiseler": 1, "maraqli_faktlar": 2, "hekayeler": 3,"paranormal":4,"rekordlar":5,"texnologiya":6,"mocuzeler_ve_sirler":7,"18_plus":8,"topaz_kuponlari":9},
	        ];
            var necenci_ay = 1;
            var hansi_ay = 0;
            for(a=0; a<12; a++){
                tax_data[a]['period'] = '<?php echo $il; ?>-'+necenci_ay;
                tax_data[a]['gundelik_hadiseler'] = all_statics[0][hansi_ay]['statistik_netice'];
                tax_data[a]['maraqli_faktlar'] = all_statics[1][hansi_ay]['statistik_netice'];
                tax_data[a]['hekayeler'] = all_statics[2][hansi_ay]['statistik_netice'];
                tax_data[a]['paranormal'] = all_statics[3][hansi_ay]['statistik_netice'];
                tax_data[a]['rekordlar'] = all_statics[4][hansi_ay]['statistik_netice'];
                tax_data[a]['texnologiya'] = all_statics[5][hansi_ay]['statistik_netice'];
                tax_data[a]['mocuzeler_ve_sirler'] = all_statics[6][hansi_ay]['statistik_netice'];
                tax_data[a]['18_plus'] = all_statics[7][hansi_ay]['statistik_netice'];
                tax_data[a]['topaz_kuponlari'] = all_statics[8][hansi_ay]['statistik_netice'];
                necenci_ay++;
                hansi_ay++;
            }
            
	        Morris.Line({
	            element: 'hero-graph',
	            data: tax_data,
	            xkey: 'period',
	            xLabels: "month",
	            ykeys: ['gundelik_hadiseler', 'maraqli_faktlar', 'hekayeler','paranormal','rekordlar','texnologiya','mocuzeler_ve_sirler','18_plus','topaz_kuponlari'],
	            labels: ['Gündəlik Hadisələr', 'Maraqlı Faktlar', 'Hekayələr','Paranormal','Rekordlar','Texnologiya','Möcüzələr Və Sirlər','18+','Hazır Topaz Kuponları']
	        });
	        // Morris Bar Chart
	        Morris.Bar({
	            element: 'hero-bar',
	            data: [
	                {device: 'Dünən', sells: heftelik[0]},
	                {device: '-2 Gün', sells: heftelik[1]},
	                {device: '-3 Gün', sells: heftelik[2]},
	                {device: '-4 Gün', sells: heftelik[3]},
	                {device: '-5 Gün', sells: heftelik[4]},
	                {device: '-6 Gün', sells: heftelik[5]},
                    {device: '-7 Gün', sells: heftelik[6]}
	            ],
	            xkey: 'device',
	            ykeys: ['sells'],
	            labels: ['Baxılma'],
	            barRatio: 0.4,
	            xLabelMargin: 10,
	            hideHover: 'auto',
	            barColors: ["#3d88ba"]
	        });
	        // Morris Donut Chart
	        Morris.Donut({
	            element: 'hero-donut',
	            data: [
	                {label: 'Gündəlik Hadisələr', value: today_static[0] },
	                {label: 'Maraqlı Faktlar', value: today_static[1] },
	                {label: 'Hekayələr', value: today_static[2] },
	                {label: 'Paranormal', value: today_static[3] },
	                {label: 'Rekordlar', value: today_static[4] },
	                {label: 'Texnologiya', value: today_static[5] },
	                {label: 'Möcüzələr və Sirlər', value: today_static[6] },
	                {label: '18+', value: today_static[7] },
                    {label: 'Hazır Topaz Kuponları', value: today_static[8] }
	            ],
	            colors: ["#30a1ec", "#76bdee", "#c4dafe"],
	            formatter: function (y) { return y }
	        });
        </script>
    </body>

</html>
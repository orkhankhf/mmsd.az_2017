<div class="span3" id="sidebar">
                    <ul class="nav nav-list bs-docs-sidenav nav-collapse collapse">
                        <li class="left_menu1">
                            <a href="admin.php"><i class="icon-chevron-right"></i> Xəbər Əlavə Et</a>
                        </li>
                        <li class="left_menu2">
                            <a href="xebersil.php"><i class="icon-chevron-right"></i> Xəbər Sil / Redaktə Et</a>
                        </li>
                        <li class="left_menu6">
                            <a href="slider_add.php"><i class="icon-chevron-right"></i> Sliderə Xəbər Əlavə Et</a>
                        </li>
                        <li class="left_menu7">
                            <a href="slider_dlt.php"><i class="icon-chevron-right"></i> Sliderdən Xəbər Sil</a>
                        </li>
                        <?php
                            if(isset($_SESSION['rutbe']) && $_SESSION['rutbe'] == "bas_admin"){
                                echo "<li class='left_menu3'>
                                        <a href='redaktor_elave_et.php'><i class='icon-chevron-right'></i> Redaktor Təyin Et</a>
                                    </li>
                                    <li class='left_menu4'>
                                        <a href='redaktor_sil.php'><i class='icon-chevron-right'></i> Redaktor Sil</a>
                                    </li>
                                    <li class='left_menu5'>
                                        <a href='statistika.php'><i class='icon-chevron-right'></i> Saytın Statistikası</a>
                                    </li>";
                            }
                        ?>
                    </ul>
                </div>
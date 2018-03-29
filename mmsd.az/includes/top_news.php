<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12">
        <a href="http://qadingeyimleri.az/" target="_blank">
          <img class="qadingeyimleri_ad" src="../images/qadingeyimleri.gif" width="100%">
        </a>
        <aside class="right_content">
          <div class="latest_post_container xeber_lenti_3">
            <h2 class="news_page_xeber_lenti_h2"><span>Xəbər Lentİ</span></h2>
            <ul class="">
              <?php
                $select = "SELECT id,basliq,tmp,tarix,saat FROM news ORDER BY id DESC LIMIT 5";
                $netice = mysqli_query($conn,$select);
                while($row = mysqli_fetch_assoc($netice)){
                  if($row['tarix'] == date('Y-m-d')){
                    $tarix = "Bu Gün";
                  }else if($row['tarix'] == date('Y-m-d',strtotime('-1 day'))){
                    $tarix = "Dünən";
                  }else{
                    $tarix = $row['tarix'];
                  }
                  echo "<li>
                          <div class='media'><span class='index_cat_news_date'>".$tarix." &nbsp; <span>".$row['saat']."</span></span><a href='../news/?id=".$row['id']."' class='media-left'> <img alt='".$row['basliq']."' src='../news_files/".$row['tmp']."/thumb.jpg'> </a>
                            <div class='media-body'><a href='../news/?id=".$row['id']."' class='catg_title xeber_lenti_basligi'>".$row['basliq']."</a></div>
                          </div>
                        </li>";
                }
              ?> 
            </ul>
          </div>
          <div class="single_sidebar two_reklam_main_div">
            <ul class="nav nav-tabs" role="tablist">
              <li role="presentation" class="active ytb_reklam_video_h"><a href="#reklam_img" aria-controls="profile" role="tab" data-toggle="tab">Burada Sizin Reklamınız Ola Bilər!</a></li>
            </ul>
            <div class="tab-content">
              <div role="tabpanel" class="tab-pane active" id="reklam_img">
                <div class="single_sidebar wow fadeInDown">
                  <a class="sideAdd" href="#"><img src="../images/add_img.jpg" alt=""></a>
                </div>
              </div>
            </div>            
          </div>
          <div class="latest_post">
            <div class="latest_post_container xeber_lenti_3">
              <ul class="">
                <?php
                  $select = "SELECT id,basliq,tmp,tarix,saat FROM news ORDER BY id DESC LIMIT 5,30";
                  $netice = mysqli_query($conn,$select);
                  while($row = mysqli_fetch_assoc($netice)){
                    if($row['tarix'] == date('Y-m-d')){
                      $tarix = "Bu Gün";
                    }else if($row['tarix'] == date('Y-m-d',strtotime('-1 day'))){
                      $tarix = "Dünən";
                    }else{
                      $tarix = $row['tarix'];
                    }
                    echo "<li>
                            <div class='media'><span class='index_cat_news_date'>".$tarix." &nbsp; <span>".$row['saat']."</span></span><a href='../news/?id=".$row['id']."' class='media-left'> <img alt='".$row['basliq']."' src='../news_files/".$row['tmp']."/thumb.jpg'> </a>
                              <div class='media-body'><a href='../news/?id=".$row['id']."' class='catg_title'>".$row['basliq']."</a></div>
                            </div>
                          </li>";
                  }
                ?> 
              </ul>
            </div>
          </div>
        </aside>
      </div>
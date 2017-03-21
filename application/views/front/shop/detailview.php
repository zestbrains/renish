<div class="spacer-small"></div>

<!-- PAGEBODY -->

<div class="container detail_container">

  <div class="row detail_row_container">

    <div class="col-lg-12 header_container">

      <div class="image_container" style="background-image:url('<?php echo DOMAIN_URL.'/'.$GarageData['vCoverImage']; ?>')">

        <div class="col-lg-12 garage_info">

          <div class="col-lg-1 garage_info_image"> <img src="<?php echo DOMAIN_URL.$GarageData['vProfileImage']; ?>"/> </div>

          <div class="col-lg-5 garage_info_name">

            <div class="garage_info_title"><?php echo $GarageData['vGarageName'] ? $GarageData['vGarageName'] : 'title' ; ?></div>

            <?php

                     $city= $GarageData['vCityName'] ? $GarageData['vCityName'] : 'city';

                     $state=$GarageData['vState'] ? $GarageData['vState'] : 'state';

                     $country=$GarageData['vCountry'] ? $GarageData['vCountry'] : 'country';

                     ?>

            <div class="garage_info_location"><span class="location"> <i class="fa fa-map-marker"></i> <?php echo $city.','.$state.','.$country; ?></span> </div>

            <span class="star-reviews-customer"> <i class="fa fa-star"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i><i class="fa fa-star-o"></i> </span> </div>

          <div class="col-lg-6">

            <div class="col-lg-9">

              <div class="garage_icons">

                <ul>

                  <li class="forsell col-sm-6 col-md-6 col-lg-6 col-xs-12"><a href="javascript:;"><span>0</span>Total sell</a></li>

                  <li class="foreview col-sm-6 col-md-6 col-lg-6 col-xs-12"><a href="javascript:;"><span>0</span>Total Review</a></li>

                  <!--                           <li><a href="javascript:;"><i class="fa fa-map-marker garage-icon"></i><br><span>Review</span></a></li>-->

                </ul>

              </div>

            </div>

            <div class="col-lg-3 book-now-container">

              <?php if($GarageData['iPercentage']!='0'){ ?>

              <h3> <?php echo $GarageData['iPercentage'] ? $GarageData['iPercentage'] : '0' ; ?>% Discount <br>

                <span>on upto <?php echo $GarageData['vAmountForCoupon'] ? $GarageData['vAmountForCoupon'] : '0' ; ?>$</span> </h3>

              <div class="book-now-btn"> <a href="<?php echo DOMAIN_URL; ?>/order/summary/<?php echo $iGarageId; ?>" class="btn btn-primary">Buy Coupon</a> </div>

              <?php } else { ?>

              <h3>No Discount</h3>

              <div class="book-now-btn"> <a href="<?php echo DOMAIN_URL; ?>/order/summary/<?php echo $iGarageId; ?>" class="btn btn-primary">Buy Coupon</a> </div>

              <?php } ?>

            </div>

          </div>

        </div>

      </div>

    </div>

  </div>

</div>

<div class="container gardetail">

  <div class="row">

    <div class="col-lg-12 detail_container1 fsttresec"> 

      <!--xxx-->

      <div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">

        <div class="panel panel-default">

          <div class="panel-heading profile-small-title">

            <h3>Schedule</h3>

          </div>

          <div class="panel-body">

            <div class="working-days">

              <?php

                       if(isset($GarageData['tWorkingHour'])){

                        $workingHours=json_decode($GarageData['tWorkingHour'],true);

                       }else{

                           $workingHours='';

                       }

                      // pre($workingHours);

                        $dayMap = array('sun', 'mon', 'tue', 'wed', 'thu', 'fri', 'sat');

                        $dayFull = array('Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday');

                        for($i=0;$i<count($dayMap);$i++){

                            

                         $dayshort=$dayMap[$i];  

                         $dayfull=$dayFull[$i];  

                         

                         $start_time=$dayshort.'_start_time';

                         $end_time=$dayshort.'_end_time';

                         $working_day=$dayshort.'_working_day';

                        

                         

                    ?>

              <div class="col-lg-12 days">

                <div class="col-lg-4 days text-center">

                  <label><?php echo $dayfull; ?></label>

                </div>

                <?php if(isset($workingHours[$i]['start']) && $workingHours[$i]['start']!='0:00'){ ?>

                <div class="col-lg-4 days">

                  <h6 class="detail_time"><?php echo $workingHours[$i]['start']; ?></h6>

                </div>

                <div class="col-lg-4 days">

                  <h6 class="detail_time"><?php echo $workingHours[$i]['end']; ?></h6>

                </div>

                <?php }else{ ?>

                <div class="col-lg-8 days">

                  <h6 class="detail_time depend"><b>Closed</b></h6>

                </div>

                <?php } ?>

              </div>

              <?php } ?>

            </div>

          </div>

        </div>

      </div>

      <!--xxx-->

      

      <div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">

        <div class="panel panel-default">

          <div class="panel-heading profile-small-title">

            <h3>Address</h3>

          </div>

          <div class="panel-body">

            <div class="col-lg-12 about-garage">

              <ul>

                <?php

                        if($GarageData['vGarageType']==1){

                            $garageType='Repair Auto shop';

                        }else if($GarageData['vGarageType']==2){

                            $garageType='Repair Body shop';

                        }else if($GarageData['vGarageType']==3){

                            $garageType='Repair Auto & Body shop';

                        }else{

                            $garageType='General';

                        }

                        

                        ?>

                <li><i class="fa fa-car"></i><span>Shop Type:</span>

                  <div class="break-l">

                  <?php echo $garageType; ?>

                  <div>

                </li>

                <li><i class="fa fa-map-marker"></i><span>Address:</span>

                  <div class="break-l"><?php echo $GarageData['vAddress'] ? $GarageData['vAddress'] : '-' ; ?>.</div>

                </li>

<!--                <li><i class="fa fa-wrench"></i><span>Total Mechanic:</span><?php //echo $GarageData['iTotalMechanic'] ? $GarageData['iTotalMechanic'] : 0 ; ?></li>-->

                <li><i class="fa fa-globe"></i><span>Zip Code:</span><?php echo $GarageData['vZipCode'] ? $GarageData['vZipCode'] : '-' ; ?></li>

                <li><i class="fa fa-mobile"></i><span>Mobile:</span><?php echo $GarageData['vMobile'] ? $GarageData['vMobile'] : '-' ; ?></li>

                <li><i class="fa fa-phone"></i><span>Office Mobile:</span><?php echo $GarageData['vOffice_mobile'] ? $GarageData['vOffice_mobile'] : '-' ; ?></li>

              </ul>

            </div>

          </div>

        </div>

      </div>

      

      <!--xxx-->

      <div class="col-sm-4 col-md-4 col-lg-4 col-xs-12">

        <div class="panel panel-default">

          <div class="panel-heading profile-small-title">

            <h3>Location</h3>

          </div>

          <div class="panel-body">

            <div id="map"></div>

          </div>

        </div>

      </div>

    </div>

    <div class="col-lg-12 about_container">

      <div class="panel panel-default">

        <div class="panel-heading profile-small-title">

          <h3>About:</h3>

        </div>

        <div class="panel-body details-mainn">

          <div class="col-sm-4 col-md-4 col-lg-4 col-xs-12 detdescc">

            <p><?php echo $GarageData['tDescription'] ? $GarageData['tDescription'] : 'Description' ; ?></p>
	<span class="rreadmoree"></span>
          </div>

          <div class="col-sm-4 col-md-4 col-lg-4 col-xs-12 detsocial"> <img src="<?php echo ASSETS_URL; ?>/uploads/facebookk.jpg"> </div>

          <div class="col-sm-4 col-md-4 col-lg-4 col-xs-12 detmechanic">

            <div class="formechanic">

              <div class="foricon">

                <div class="mech-certifi"> <img src="<?php echo ASSETS_URL; ?>/uploads/certifi.png"> </div>

                <img src="<?php echo ASSETS_URL; ?>/uploads/userimg.png" class="usericnn"></div>

              <div class="mech-name">Mechanic name</div>

              <div class="mech-address">1, Los angles</div>

              <div style="clear:both"></div>

            </div>

            <div class="formechanic">

              <div class="foricon">

                <div class="mech-certifi"> <img src="<?php echo ASSETS_URL; ?>/uploads/certifi.png"> </div>

                <img src="<?php echo ASSETS_URL; ?>/uploads/userimg.png" class="usericnn"></div>

              <div class="mech-name">Mechanic name</div>

              <div class="mech-address">1, Los angles</div>

              <div style="clear:both"></div>

            </div>

            <div class="formechanic">

              <div class="foricon">

                <div class="mech-certifi"> <img src="<?php echo ASSETS_URL; ?>/uploads/certifi.png"> </div>

                <img src="<?php echo ASSETS_URL; ?>/uploads/userimg.png" class="usericnn"></div>

              <div class="mech-name">Mechanic name</div>

              <div class="mech-address">1, Los angles</div>

              <div style="clear:both"></div>

            </div>

          </div>

        </div>

      </div>

    </div>

    <div class="col-lg-12">

      <div class="panel panel-default">

        <div class="panel-heading profile-small-title">

          <h3>More Repair Shop Photos</h3>

        </div>

        <div class="panel-body">

          <div class="isotope-grid gallery-container style-column-3">

            <?php

                            if(!empty($GarageImages)){ 

                                for($i=0;$i<count($GarageImages);$i++) {

                        ?>

            <div class="isotope-item"> <a href="javascript:;" class="thumb-overlay" data-rel="lightcase:gallery1"> <img src="<?php echo DOMAIN_URL.'/'.$GarageImages[$i]['vImage']; ?>" alt="Gagrage Photo"/> </a> </div>

            <?php } }else{ ?>

            <div class="isotope-item depend"><b>No More Repair Shop Photos</b></div>

            <?php } ?>

          </div>

        </div>

      </div>

    </div>

    <div class="col-lg-8 detail-review">

      <div class="panel panel-default">

        <div class="panel-heading profile-small-title">

          <h3>Reviews:</h3>

        </div>

        <?php  if($comment_count>0){ ?>

        <div class="panel-body">

          <div class="col-sm-6">

            <div class="rating-block">

              <h4>Average rating</h4>

              <h2 class="bold padding-bottom-7"><?php echo $GarageRatting['avg_ratting'] ? $GarageRatting['avg_ratting'] : '0'; ?> <small>/ 5</small></h2>

              <span class="star-reviews-customer">

              <?php

                                $star_av='';

                                for($av=1;$av<=5;$av++){

                                    if($av<=$GarageRatting['avg_ratting']){

                                        $star_av.='<i class="fa fa-star"></i>';

                                    }else{

                                        $star_av.='<i class="fa fa-star-o"></i>';

                                    }                                                

                                }

                                echo $star_av;

                             ?>

              </span> </div>

          </div>

          <div class="col-sm-6 avrage-ratings">

            <h4>Rating breakdown</h4>

            <div class="pull-left">

              <div class="pull-left" style="width:35px; line-height:1;">

                <div style="height:9px; margin:5px 0;">5 <span class="fa fa-star"></span> </div>

              </div>

              <div class="pull-left" style="width:180px;">

                <div class="progress" style="height:9px; margin:8px 0;">

                  <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 100%"> <span class="sr-only">80% Complete (danger)</span> </div>

                </div>

              </div>

              <div class="pull-right" style="margin-left:10px;"><?php echo $GarageRatting['star'][0] ? $GarageRatting['star'][0] : 0; ?></div>

            </div>

            <div class="pull-left">

              <div class="pull-left" style="width:35px; line-height:1;">

                <div style="height:9px; margin:5px 0;">4 <span class="fa fa-star"></span> </div>

              </div>

              <div class="pull-left" style="width:180px;">

                <div class="progress" style="height:9px; margin:8px 0;">

                  <div class="progress-bar progress-bar-primary" role="progressbar" aria-valuenow="4" aria-valuemin="0" aria-valuemax="5" style="width: 80%"> <span class="sr-only">80% Complete (danger)</span> </div>

                </div>

              </div>

              <div class="pull-right" style="margin-left:10px;"><?php echo $GarageRatting['star'][1] ? $GarageRatting['star'][1] : 0; ?></div>

            </div>

            <div class="pull-left">

              <div class="pull-left" style="width:35px; line-height:1;">

                <div style="height:9px; margin:5px 0;">3 <span class="fa fa-star"></span> </div>

              </div>

              <div class="pull-left" style="width:180px;">

                <div class="progress" style="height:9px; margin:8px 0;">

                  <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="3" aria-valuemin="0" aria-valuemax="5" style="width: 60%"> <span class="sr-only">80% Complete (danger)</span> </div>

                </div>

              </div>

              <div class="pull-right" style="margin-left:10px;"><?php echo $GarageRatting['star'][2] ? $GarageRatting['star'][2] : 0; ?></div>

            </div>

            <div class="pull-left">

              <div class="pull-left" style="width:35px; line-height:1;">

                <div style="height:9px; margin:5px 0;">2 <span class="fa fa-star"></span> </div>

              </div>

              <div class="pull-left" style="width:180px;">

                <div class="progress" style="height:9px; margin:8px 0;">

                  <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="2" aria-valuemin="0" aria-valuemax="5" style="width: 40%"> <span class="sr-only">80% Complete (danger)</span> </div>

                </div>

              </div>

              <div class="pull-right" style="margin-left:10px;"><?php echo $GarageRatting['star'][3] ? $GarageRatting['star'][3] : 0; ?></div>

            </div>

            <div class="pull-left">

              <div class="pull-left" style="width:35px; line-height:1;">

                <div style="height:9px; margin:5px 0;">1 <span class="fa fa-star"></span> </div>

              </div>

              <div class="pull-left" style="width:180px;">

                <div class="progress" style="height:9px; margin:8px 0;">

                  <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="1" aria-valuemin="0" aria-valuemax="5" style="width: 20%"> <span class="sr-only">80% Complete (danger)</span> </div>

                </div>

              </div>

              <div class="pull-right" style="margin-left:10px;"><?php echo $GarageRatting['star'][4] ? $GarageRatting['star'][4] : 0; ?></div>

            </div>

          </div>

        </div>

        <div class="row ">

          <div class="col-sm-12">

            <hr>

            <div class="review-block" id="commentlisting"> <?php echo $comment_listing; ?> </div>

            <?php  if($comment_count==LIMIT){ ?>

            <div class="col-lg-12 align-center load-more-block">

              <button class="btn btn-primary" name="1" id="load_more_comments">Load More</button>

            </div>

            <?php } ?>

          </div>

        </div>

        <?php } else { ?>

        <div class="panel-body">

          <div class="isotope-grid gallery-container style-column-3">

            <div class="isotope-item depend"><b>No comments yet</b></div>

          </div>

        </div>

        <?php } ?>

      </div>

    </div>

    <!-- -->

    <div class="forblogg col-sm-4 col-md-4 col-lg-4 col-xs-12">

      <div class="panel panel-default">

        <div class="panel-heading profile-small-title">

          <h3>Related Blogs</h3>

        </div>

        <div class="panel-body">

          <div class="main-blogg"> <a href="#"> <img src="http://localhost/sureorless/assets/files/uploads/blogitemimg.jpg"> </a>

            <div class="blogg-name">blog name</div>

            <div class="blogg-date">Mar 9 2017</div>

            <div class="blogg-desc">There is no one who loves pain itself, who seeks after it and wants to have it, simply because it is pain.There is no one who loves pain itself, who seeks after it and wants to have it, simply because it is pain...</div>

          </div>

          <div class="sub-blogg">

            <div class="sub-blog-inner">

              <div class="sub-blogg-img col-sm-6 col-md-6 col-lg-6 col-xs-12"> <a href="#"> <img src="http://localhost/sureorless/assets/files/uploads/blogitemimg.jpg"> </a> </div>

              <div class="sub-blogg-desc col-sm-6 col-md-6 col-lg-6 col-xs-12"> <a href="#">blog name</a>

                <div class="sub-blogg-date">Mar 9 2017</div>

              </div>

              <div style="clear:both"></div>

            </div>

            <div class="sub-blog-inner">

              <div class="sub-blogg-img col-sm-6 col-md-6 col-lg-6 col-xs-12"> <a href="#"> <img src="http://localhost/sureorless/assets/files/uploads/blogitemimg.jpg"> </a> </div>

              <div class="sub-blogg-desc col-sm-6 col-md-6 col-lg-6 col-xs-12"> <a href="#">blog name</a>

                <div class="sub-blogg-date">Mar 9 2017</div>

              </div>

              <div style="clear:both"></div>

            </div>

          </div>

        </div>

      </div>

    </div>

    <!-- --> 

  </div>

</div>

<script>

 $(document).ready(function(){

   $("body").on('click', "#load_more_comments", function (e) {

                e.preventDefault();

                var page = $(this).attr('name');

                var iGarageId='<?php echo $iGarageId; ?>';

                

                var URL='<?php echo DOMAIN_URL; ?>/garage/more_comments/';

                $.ajax({

                    url: URL,

                    type: 'POST',

                    data: {'page': page,'iGarageId': iGarageId},

                    beforeSend: function() {

                       $("#loading-image").show();

                    },

                    success: function (data) {

                         //console.log(data);

                        if ($.trim(data)!='') {

                            $('#commentlisting').append(data);                           

                            $("#load_more_comments").show();

                            page = parseInt(page) + 1;

                            $("#load_more_comments").attr('name', page);

                           

                            $("#loading-image").hide();

                        } else {

                            $(".load-more-block").hide();

                            $("#loading-image").hide();

                               

                        }

                    },

                    error: function (e) {

                       $("#loading-image").hide();

                    }

                });

            });

        

});   





      function initMap() {

        var myLatLng = {lat: <?php echo $GarageData['lattitude'] ? $GarageData['lattitude'] : '40.7128' ; ?>, lng: <?php echo $GarageData['longitude'] ? $GarageData['longitude'] : '74.0059' ; ?>};



        var map = new google.maps.Map(document.getElementById('map'), {

          zoom: 4,

          center: myLatLng

        });



        var marker = new google.maps.Marker({

          position: myLatLng,

          map: map,

          title: 'Hello World!'

        });

      }

    </script> 

<script type="text/javascript" src="http://maps.google.com/maps/api/js?key=AIzaSyAQG7ZCYf4HIK3L2znRJowB8LI-Vw--Hrk&callback=initMap">

 </script> 


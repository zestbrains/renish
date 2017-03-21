<div class="spacer-small"></div>
<!-- PAGEBODY -->
<div class="listtt forightmap col-sm-8 col-md-8 col-lg-8 col-xs-12">
  <div class="row ">
    <div class="panel panel-default unqlistsearch">
      <div class="panel-heading profile-small-title">
        <h3>Search:</h3>
      </div>
      <div class="col-lg-12 filter_container_main" id="filter_container_main">
        <div class="row">
          <div class="col-sm-5 col-md-5 col-lg-5 col-xs-12">
            <input type="text" name="search" id="search" class="form-control profile-field" placeholder="Search by zipcode or name" tabindex="2" value="<?php echo $search ? $search : '' ?>">
          </div>
          <div class="col-sm-5 col-md-5 col-lg-5 col-xs-12">
            <div class="form-group">
              <select id="vCouponDiscount" name="vCouponDiscount" class="form-control" >
                <option value="">Select Discount</option>
                <?php foreach ($discouts as $discount) {  $selected = ($GarageData['vCouponDiscount'] != '' ? ($discount['iDiscountId'] == $GarageData['vCouponDiscount']) ? 'selected="selected"' : '' : '');?>
                <option value="<?php echo $discount['iDiscountId']; ?>" <?php echo $selected; ?>><?php echo $discount['iPercentage']; ?>%</option>
                <?php }?>
              </select>
            </div>
          </div>
          <div class="col-sm-2 col-md-2 col-lg-2 col-xs-12">
            <button class="btn btn-primary"  id="apply_filter">Apply Filter</button>
          </div>
        </div>
      </div>
    </div>
    <div id="loading-image"  style="display: none;">
      <div id="overlay"> <img id="loading" src="<?php echo IMAGES_URL; ?>/loading.gif"></div>
    </div>
    <?php if($list_html!=''){ ?>
    <div class="col-lg-12">
      <ul class="listing" id="listing">
        <?php echo $list_html; ?>
      </ul>
      <div class="col-lg-12 align-center"> <a class="btn btn-primary loadmore" name="1" href="javascript:;">Load More</a> </div>
      <div class="col-lg-12 align-center" id="retrive_msg"></div>
    </div>
    <?php } else { ?>
    <div class="col-lg-12">
      <ul class="listing" id="listing">
      <h4 class="depend"> We are working to establish our network in your area Please try searching zipcode <b><?php echo $search; ?></b> again in near future </h4>
       <!-- <h4 class="depend"> <strong>Sorry, but we were unable to find the zipcode or name <b><?php //echo $search; ?></b></strong> </h4>
        Please make sure you entered everything correctly and if so, try to finding in our all data by <a href="<?php //echo DOMAIN_URL; ?>/shop/lists/<?php //echo $page_type; ?>">Clicking here</a> -->
      </ul>
    </div>
      <?php } ?>
   
  </div>
  </div>
  <?php if($list_html!=''){ ?>
    <div class="forlistmapp col-sm-4 col-md-4 col-lg-4 col-xs-12">
         <div id="map"></div>
   </div>
  <?php } ?>  

</div>
<!-- PAGEBODY -->
<div class="spacer-big"></div>
<script>
 $(document).ready(function(){
   $("body").on('click', "#apply_filter", function (e) {
                e.preventDefault();
                var search =$('#search').val();
                var vCouponDiscount =$('#vCouponDiscount').val();
                var page =0;
                var dataByType='filter';
                var Limit='<?php echo LIMIT; ?>';
                
                var URL='<?php echo DOMAIN_URL; ?>/shop/lists/<?php echo $page_type; ?>';
                $.ajax({
                    url: URL,
                    type: 'POST',
                    data: {'page': page,'search':search,'discount':vCouponDiscount,'dataByType':dataByType},
                    beforeSend: function() {
                       $("#loading-image").show();
                    },
                    success: function (data) {
                         //console.log(data);
                        if ($.trim(data)!='') {
                            $('#listing').html(data);
                            if ($('#listing li').length >=Limit) {
                                $(".loadmore").show();
                                page = parseInt(page) + 1;
                                $(".loadmore").attr('name', page);
                            }   
                            $("#loading-image").hide();
                        } else {
                            $(".loadmore").hide();
                            $("#loading-image").hide();
                            if(search!=''){
								
                                $("#listing").html('<h4 class="depend"> We are working to establish our network in your area Please try searching zipcode <b>'+search+'</b> again in near future </h4>');
                            }else{
                                var discountText=$("#vCouponDiscount option:selected").text();
                                $("#listing").html('<h4 class="depend"> We are working to establish our network in your area Please try searching discount <b>'+discountText+'</b> again in near future </h4>');
                            }    
                        }
                    },
                    error: function (e) {
                       $("#loading-image").hide();
                    }
                });
            });
   $("body").on('click', ".loadmore", function (e) {
                e.preventDefault();
                var search =$('#search').val();
                var vCouponDiscount =$('#vCouponDiscount').val();
                var page = $(this).attr('name');
                var dataByType='loadmore';
                
               // alert(page);
                var URL='<?php echo DOMAIN_URL; ?>/shop/lists/<?php echo $page_type; ?>';
                $.ajax({
                    url: URL,
                    type: 'POST',
                    data: {'page': page,'search':search,'discount':vCouponDiscount,'dataByType':dataByType},
                    beforeSend: function() {
                       $("#loading-image").show();
                    },
                    success: function (data) {
                        // console.log(data);
                        if ($.trim(data)!='') {
                            $('#listing').append(data);
                            page = parseInt(page) + 1;
                            $(".loadmore").attr('name', page);
                            $("#loading-image").hide();
                        } else {
                            $(".loadmore").hide();
                            $("#loading-image").hide();                            
                        }
                    },
                    error: function (e) {
                       $("#loading-image").hide();
                    }
                });
            });         
});   
</script>
<script>
function myMap() {
var mapProp= {
    center:new google.maps.LatLng(40.7128,74.0059),
    zoom:5,
	scrollwheel: false
};
var map=new google.maps.Map(document.getElementById("map"),mapProp);
}
</script>

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAQG7ZCYf4HIK3L2znRJowB8LI-Vw--Hrk&callback=myMap"></script>

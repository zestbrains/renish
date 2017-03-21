<div class="portlet-title">
   <div class="caption">
      <i class="fa fa-car font-green-sharp"></i>
      <span class="caption-subject font-green-sharp bold uppercase"><?php echo $headTitle; ?></span>
      <span class="caption-helper">manage records...</span>
   </div>
   <div class="clearfix"></div>
   <?php echo $bradcrumb; ?>
</div>
<div class="portlet-body">
   <div class="row">
                  <div class="col-md-12 blog-page">
                     <div class="row">
                        <div class="col-md-12 article-block">
                           <h3 style="margin-top:0;"><?php echo $garage['vGarageName'];?></h3>
                           <div class="blog-tag-data">
                              <img src="<?php echo $garage['vCoverImage'];?>" class="img-responsive" style="width:100%" alt="">
                              <div class="row">
                                 <div class="col-md-6">
                                    <ul class="list-inline blog-tags" style="margin-top: 10px;">
                                       <li>
                                          <i class="fa fa-tags"></i>
                                          <a href="javascript:;">
                                          Technology </a>
                                          <a href="javascript:;">
                                          Education </a>
                                          <a href="javascript:;">
                                          Internet </a>
                                       </li>
                                    </ul>
                                 </div>
                                 <div class="col-md-6 blog-tag-data-inner">
                                    <ul class="list-inline" style="float: right;margin-top: 10px;">
                                       <li>
                                          <i class="fa fa-calendar"></i>
                                          April 16, 2013
                                       </li>
                                       <li>
                                          <i class="fa fa-comments"></i>
                                          <?php echo $garage['iTotalLikes'];?> Likes
                                       </li>
                                       <li>
                                          <i class="fa fa-comments"></i>
                                          <?php echo $garage['iTotalFavourite'];?> Favourites
                                       </li>
                                    </ul>
                                 </div>
                              </div>
                           </div>
                           <!--end news-tag-data-->
                           <div>
                              <p>
                                 <?php echo $garage['tDescription'];?>
                              </p>
                           </div>
                           <hr>
                           
                           
                        </div>
                        
                     </div>
                  </div>
               </div>
</div>
<!-- BEGIN CONTENT -->
<div class="page-content-wrapper">
   <div class="page-content">
      <!-- BEGIN PAGE HEAD -->
      <div class="page-head">
         <!-- BEGIN PAGE TITLE -->
         <div class="page-title">
            <h1>Dashboard <small>statistics & reports</small></h1>
         </div>
         <!-- END PAGE TITLE -->
      </div>
      <!-- END PAGE HEAD -->
      <!-- BEGIN PAGE BREADCRUMB -->
      <ul class="page-breadcrumb breadcrumb hide">
         <li>
            <a href="javascript:;">Home</a><i class="fa fa-circle"></i>
         </li>
         <li class="active">
            Dashboard
         </li>
      </ul>
      <!-- END PAGE BREADCRUMB -->
      <!-- BEGIN PAGE CONTENT INNER -->
      <div class="row margin-top-10">

        <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <a href="<?php echo base_url() . ADM_URL; ?>users">
               <div class="dashboard-stat2">
                  <div class="display">
                     <div class="number">
                        <h3 class="font-blue-sharp"><?php echo $counts['user']; ?></h3>
                        <small>Website Users</small>
                     </div>
                     <div class="icon">
                        <i class="fa fa-users"></i>
                     </div>
                  </div>
                  <div class="progress-info">
                     <div class="progress">
                     </div>
                  </div>
               </div>
            </a>
         </div>

         <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <a href="<?php echo base_url() . ADM_URL; ?>users/adminUser">
               <div class="dashboard-stat2">
                  <div class="display">
                     <div class="number">
                        <h3 class="font-blue-sharp"><?php echo $counts['admin']; ?></h3>
                        <small>Admin Users</small>
                     </div>
                     <div class="icon">
                        <i class="fa fa-users"></i>
                     </div>
                  </div>
                  <div class="progress-info">
                     <div class="progress">
                     </div>
                  </div>
               </div>
            </a>
         </div>

         <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <a href="<?php echo base_url() . ADM_URL; ?>country">
               <div class="dashboard-stat2">
                  <div class="display">
                     <div class="number">
                        <h3 class="font-blue-sharp"><?php echo $counts['country']; ?></h3>
                        <small>Total Countries</small>
                     </div>
                     <div class="icon">
                        <i class="fa fa-flag"></i>
                     </div>
                  </div>
                  <div class="progress-info">
                     <div class="progress">
                     </div>
                  </div>
               </div>
            </a>
         </div>

         <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <a href="<?php echo base_url() . ADM_URL; ?>state">
               <div class="dashboard-stat2">
                  <div class="display">
                     <div class="number">
                        <h3 class="font-blue-sharp"><?php echo $counts['state']; ?></h3>
                        <small>Total States</small>
                     </div>
                     <div class="icon">
                        <i class="fa fa-flag"></i>
                     </div>
                  </div>
                  <div class="progress-info">
                     <div class="progress">
                     </div>
                  </div>
               </div>
            </a>
         </div>

         <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
            <a href="<?php echo base_url() . ADM_URL; ?>city">
               <div class="dashboard-stat2">
                  <div class="display">
                     <div class="number">
                        <h3 class="font-blue-sharp"><?php echo $counts['city']; ?></h3>
                        <small>Total Cities</small>
                     </div>
                     <div class="icon">
                        <i class="fa fa-flag"></i>
                     </div>
                  </div>
                  <div class="progress-info">
                     <div class="progress">
                     </div>
                  </div>
               </div>
            </a>
         </div>

      </div>
      <!-- END PAGE CONTENT INNER -->
   </div>
</div>
<!-- END CONTENT -->
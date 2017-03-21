



<div class="page-sidebar-wrapper">
   <div class="page-sidebar navbar-collapse collapse">
      <ul class="page-sidebar-menu " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
         <?php

if ($menus['sec_rows'] > 0) {

	foreach ($menus['sec_results'] as $sections) {
		$sec_pages = explode(',', $sections->vPageName);
		$sec_title = explode(',', $sections->vTitle);

		if (count($sec_pages) > 1) {
			?>
                         <li>
                            <a href="javascript:;">
                            <i class="<?php echo $sections->vImage; ?>"></i>
                            <span class="title"><?php echo $sections->vSectionName; ?></span>
                            <span class="arrow "></span>
                            </a>
                            <ul class="sub-menu">
                               <?php
for ($i = 0; $i < count($sec_pages); $i++) {if ($this->session->userdata('ADMINUSERTYPE') != 'super_admin' && $sec_title[$i] == 'Admin Users') {continue;}?>
                                       <li>
                                          <a href="<?php echo base_url() . ADM_URL . $sec_pages[$i]; ?>">
                                             <!-- <i class="icon-home"></i> -->
                                             <?php echo $sec_title[$i]; ?>
                                          </a>
                                       </li>
                               <?php }?>
                            </ul>
                         </li>
                    <?php
} else {?>
                        <li class="start">
                            <a href="<?php echo base_url() . ADM_URL . $sec_pages[0]; ?>">
                            <i class="<?php echo $sections->vImage; ?>"></i>
                            <span class="title"><?php echo $sections->vSectionName; ?></span>
                            </a>
                         </li>
                    <?php }
	}
}?>

            <li class="start">
                <a href="<?php echo base_url() . ADM_URL; ?>logout">
                <i class="fa fa-sign-out"></i>
                <span class="title">Logout</span>
                </a>
             </li>
      </ul>
      <!-- END SIDEBAR MENU -->
   </div>
</div>
<!-- END SIDEBAR -->
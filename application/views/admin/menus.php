<div class="page-content-wrapper">
	<div class="page-content">
		<div class="row">
			<div class="col-md-12">

					<!-- Begin: life time stats -->
					<div class="portlet light">
						<div class="portlet-title">
							<div class="caption">
								<img src="<?php echo base_url() . SITE_IMG . 'languages/' . $admin_lang . '.png'; ?>" alt="">
								<span class="caption-subject font-green-sharp bold uppercase"><?php echo $headTitle; ?></span>
								<span class="caption-helper">manage records...</span>
							</div>
							<div class="clearfix"></div>
							<?php echo $bradcrumb; ?>
						</div>

						<div class="portlet-body portlet-toggler">
							<table class="table table-striped table-bordered table-hover " id="example"></table>
						</div>
						<div class="portlet-body portlet-toggler pageform" style="display:none;"></div>
						<div class="clearfix"></div>
					</div>
				<!-- End: life time stats -->
			</div>
		</div>
	</div>
</div>
<script>
$(document).ready(function(){
	OTable = $('#example').dataTable({
		bProcessing: true,
		bServerSide: true,
		responsive: true,
		sAjaxSource: AJAX_URL+"/<?php echo $menutype; ?>",
		"order": [[0, "asc"]] ,
		fnServerData: function (sSource, aoData, fnCallback){
			$.ajax({
			   dataType: 'json',
			   type: "POST",
			   url: sSource,
			   data: aoData,
			   success: fnCallback
			});
		 },
		 aoColumns: [
		 	{ sName: "sequence", sTitle : 'Sequence',bVisible:false},
		 	{ sName: "language", sTitle : 'flag',bSearchable:false,bSortable:false},
		 	{ sName: "sys_flag", sTitle : 'System Title'},
			{ sName: "title", sTitle : 'Title'},
			{ sName: "pagename", sTitle : 'Pagename'},
			{ sName: "link", sTitle : 'Link'},
			{ sName: "pagegroup", sTitle : 'Page Group'},
			{ sName: "isactive", sTitle : 'Status', bSearchable:false},
			{ sName: "operation", sTitle : 'Operation' ,bSortable:false,bSearchable:false}
		],
		fnServerParams: function(aoData){setTitle(aoData, this)},
		fnDrawCallback: function( oSettings ) {
			$('.status-switch').bootstrapSwitch();
			$('.status-switch').bootstrapSwitch('setOnClass', 'success');
			$('.status-switch').bootstrapSwitch('setOffClass', 'danger');
		}
	});
});
$(document).on('change','#pageid',function(){
	var pageid = $(this).val();
	var url = SITE_URL+'admin/changepage';
	$.post(url,{pageid:pageid},function(r){
            $('#form_menu #link').val(r.link);
        },'json');
});
</script>

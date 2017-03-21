<div class="page-content-wrapper">
	<div class="page-content">
		<div class="row">
			<div class="col-md-12">
					<!-- Begin: life time stats -->
					<div class="portlet light portlet-toggler">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-flag font-green-sharp"></i>
								<span class="caption-subject font-green-sharp bold uppercase"><?php echo $headTitle; ?></span>
								<span class="caption-helper">manage records...</span>
							</div>
							<div class="actions">
                <a href="javascript:void(0);" data-id="0" title="Add City" class="btn btn-circle btn-default btnEdit" data-type="form" data-url="<?php echo base_url(ADM_URL . strtolower($class)); ?>">
									<i class="fa fa-plus"></i>
									<span class="hidden-480">Add </span>
								</a>
							</div>
							<div class="clearfix"></div>
							<?php echo $bradcrumb; ?>
						</div>
            <a date-url="<?php echo base_url(ADM_URL . strtolower($class)); ?>" name="del_select" id="del_select" class="btn btn-sm btn-danger delete_all_link">Delete Selected</a>
						<div class="portlet-body">

							<table class="table table-striped table-bordered table-hover" id="listResults">
                            <thead class="cf">
                                <tr>
                                    <th><input type="checkbox" class="all_select"></th>
                                    <th>Sr. No.</th>
                                    <th>Name</th>
                                    <th>State</th>
                                    <th>Country</th>
                                    <th>Status</th>
                                    <th>Operation</th>
                                  </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
						<div class="clearfix"></div>
						</div>
					</div>
					<div class="portlet light portlet-body portlet-toggler pageform" style="display:none;">
					</div>
				<!-- End: life time stats -->
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
  $(document).ready(function() {
    oTable = $('#listResults').DataTable( {
        "processing": true,
        "serverSide": true,
        "order": [[ 1, "ASC" ]],
        "ajax": "<?php echo base_url(ADM_URL . 'city/lists'); ?>",
        "columns": [
            { "data": "checkbox", searchable: false, sortable: false },
            { "data": "iCityId", searchable:false, sortable: false },
            { "data": "vCity" },
            { "data": "vState" },
            { "data": "vCountry" },
            { "data": "status", searchable: false, sortable: false },
            { "data": "action", searchble: false, sortable:false }
        ],
        drawCallback: function( oSettings ) {
          $('.status-switch').bootstrapSwitch();
          $('.status-switch').bootstrapSwitch('setOnClass', 'success');
          $('.status-switch').bootstrapSwitch('setOffClass', 'danger');
        }
    } );

$(document).on('submit','#frmCity', function(e){
    $("#frmCity").validate({
    rules: {
      iCountryId:{required:true},
      iStateId:{required:true},
      vCity:{required:true, minlength:1,alphaonly:true,
      remote:{
           url: SITE_URL+"admin/city",
           type: "post",
           async:false,
           data: {vCity: function() {return $("#frmCity #vCity").val();},iCityId:function() {return $("#frmCity #iCityId").val();},iCountryId:function() {return $("#frmCity #iCountryId").val();},iStateId:function() {return $("#frmCity #iStateId").val();},action:'check_city'},
             complete: function(data){
              return data;
             }
         }
      }
    },
    messages: {
      iCountryId:{required:"Please select country"},
      iStateId:{required:"Please select state"},
      vCity:{
        required:"Please enter city name.",
        alphaonly:"Please enter only alphabates.",
        remote:"city already exists."
      }
    },
    errorClass: 'help-block',
    errorElement: 'span',
    highlight: function (element) {
       $(element).closest('.form-group').addClass('has-error');
    },
    unhighlight: function (element) {
       $(element).closest('.form-group').removeClass('has-error');
    },
    errorPlacement: function (error, element) {
      if (element.attr("type") == "radio") {
          error.appendTo('.a');

    }else{
       if (element.attr("data-error-container")) {
          error.appendTo(element.attr("data-error-container"));
       } else {
          error.insertAfter(element);
       }
    }
  }
    });
    if($("#frmCity").valid()){
      var data = new FormData($('#frmCity')[0]);
      addOverlay();
      $.ajax({
        type: 'post',
        data: data,
        dataType:"json",
        url: "<?php echo base_url(ADM_URL . strtolower($class)); ?>",
        cache: false,
        contentType: false,
        processData: false,
        success: function(r)
        {
          if(r.status == 200)
          {
             sType = getStatusText(r.status);
             sText = r.message;
             Custom.myNotification(sType,sText);
             $('.portlet-toggler').toggle();
             oTable.draw();
             return false;

          }
          else
          {
             sType = getStatusText(r.status);
             sText = r.message;
             Custom.myNotification(sType,sText);

          }
        },
        complete:removeOverlay
      });
       return false;
     }else{
        return false;
    }

  });

});

</script>

var Custom = function () {

    // private functions & variables

    var dispMessage = function(sType,sText) {
        toastr[sType.toLowerCase()](sText, sType);
    }

    // public functions
    return {

        //main function
        init: function () {
            //initialize here something.            
        },

        //some helper function
        myNotification: function (sType,sText) {
            dispMessage(sType,sText);
        }

    };

}();
$(function () {
    var url = window.location;
    $('.page-sidebar-menu  a[href="' + url + '"]').parent('li').addClass('active');
    $('.page-sidebar-menu a').filter(function () {
        return this.href == url;
    }).parent('li').addClass('active').parent('ul').parent('li').addClass('active open');
});

function setTitle( aoData,a ) {
    aoTitles = []; // this array will hold title-based sort info
    oSettings = a.fnSettings();  // the oSettings will give us access to the aoColumns info
    i = 0;
    for (ao in aoData) {
        name = aoData[ao].name;
        value = aoData[ao].value;

        if (name.substr(0,"iSortCol_".length) == "iSortCol_") {
            // get the column number from "ao"
            iCol = parseInt(name.replace("iSortCol_", ""));
            sName = "";
            if (oSettings.aoColumns[value]) sName = oSettings.aoColumns[value].sName;
            // create an entry in aoTitles (which will later be appended to aoData) for this column
            aoTitles.push( { name: "iSortTitle_"+iCol, value: sName});
            i++;
        }
         
    }
 
    // for each entry in aoTitles, push it onto aoData
     for (ao in aoTitles)   aoData.push( aoTitles[ao] );
}

//Change record status start
$(document).on('switch-change','.status-switch', function(event, state) {
        
    $(this).prop('checked', state.value);
    var customAct = typeof $(this).data('getaction') != 'undefined' ? $(this).data('getaction') : '';
    var val = state.value ? 'y' : 'n';
    var url = $(this).data('url');
    var id = $(this).data('id');
    var table = $(this).data('table');
    var action =  customAct != '' ? customAct : 'change_status'; 
    
    $.ajax({
    	url: url,
    	type: 'POST',
    	beforeSend: addOverlay,
    	dataType: 'json',
    	data: {action:action, table:table,value:val,id:id},
    	success:function(r){
    		sType = getStatusText(r.status);
	        sText = r.message;
	        Custom.myNotification(sType,sText);
            oTable.draw();
    	},
        complete:removeOverlay
    });
});
//Change record status end

$(document).on('click','.btnInnerDelete', function(event, state) 
{   
    var customAct = typeof $(this).data('getaction') != 'undefined' ? $(this).data('getaction') : '';
    $this = $(this);
    $this.attr("disabled", "disabled");
    bootbox.confirm("Are you sure you want to delete this?", function(result) {
    if(result)
    {
            var url = $this.data('url');
            var id = $this.data('id');
            $.ajax({
                url: url,
                type: 'POST',
                beforeSend: addOverlay,
                dataType: 'json',
                data: {action:customAct,id:id},
                success:function(r){
                      if(r.status == 200)
                      {
                        sType = getStatusText(r.status);
                        sText = r.message;
                        Custom.myNotification(sType,sText);
                        if(customAct == 'delete_compaign_user')
                          oTableinner.draw();
                        else
                          oTableinnerStore.draw();
                      }
                      else{
                          sText = r.message;
                          Custom.myNotification('Error',sText);
                      } 
                },
                complete:removeOverlay
            }); 
        }
        $this.removeAttr("disabled");
    });
    
});
//Delete single record start
$(document).on('click','.btnDelete', function(event, state) 
{
    $this = $(this);
    $this.attr("disabled", "disabled");
    bootbox.confirm("Are you sure you want to delete this?", function(result) {
        if(result)
        {

            var url = $this.data('url');
            var id = $this.data('id');

            $.ajax({
                url: url,
                type: 'POST',
                beforeSend: addOverlay,
                dataType: 'json',
                data: {action:'delete',id:id},
                success:function(r){
                    sType = getStatusText(r.status);
                    sText = r.message;
                    Custom.myNotification(sType,sText);
                    oTable.draw();
                },
                complete:removeOverlay
            }); 
        }
        $this.removeAttr("disabled");
    });
    
});
//Delete single record end


//start campaign assignment process
$(document).on('click','.btnAssign', function(e, state) 
{
    e.preventDefault();
    var $this = $(this);
    var id = $this.data('id');
    var type = $this.data('type');
    var bookLink = '';
    var title='';
    if(type == 'user'){
      var bookLink = $(this).data('url')+'/assign/'+type;
      title = 'User List';
    }else if(type== 'store'){
      var bookLink = $(this).data('url')+'/assign/'+type;
      title = 'Store List';
    }
    $.ajax({
        url: bookLink,
        type: 'POST',
        beforeSend: addOverlay,
        dataType: 'json',
        data: {id:id},
        success:function(r){
            if(r.status == 200){
                var cls="btn-success";
                if(r.showButton==false){
                      cls="hidden";
                }
                bootbox.dialog({
                    title: title,
                    message: r.html,
                    buttons: {
                            success: {
                              label: "Assign",
                              className: cls,
                              callback: function() {
                                        var vType = $("#vType").val();
                                        if(vType == 'user'){
                                          var users = $("#iUsers").val();
                                          users = users.replace(/^,/,'');
                                          $("#iUsers").val(users);
                                          var data = new FormData($('#form_assign')[0]);
                                          var checked = $("#iUsers").val().split(',');                                       
                                        }else{
                                          var stores = $("#iStores").val();
                                          stores = stores.replace(/^,/,'');
                                          $("#iUsers").val(stores);
                                          var data = new FormData($('#form_store_assign')[0]);
                                          var checked = $("#iStores").val().split(',');                                       
                                        }
                                        $.ajax({
                                              type: 'post',
                                              data: data,
                                              dataType:"json",
                                              beforesend: addOverlay,
                                              url: ADMIN_URL+'campaigns/assign_campaign/'+type,
                                              cache: false,
                                              contentType: false,
                                              processData: false,
                                              async:false,

                                              success: function(r)
                                              {
                                                if(r.status == 200)
                                                {
                                                   sType = getStatusText(r.status);
                                                   sText = r.message;
                                                   Custom.myNotification(sType,sText);
                                                   oTable.draw();
                                                }
                                                else{
                                                    sText = r.message;
                                                    Custom.myNotification('Error',sText);
                                                } 
                                                removeOverlay;
                                                return false;
                                              }
                                        });
                                    }
                                }
                            }
                    });
            }
            else{
                sText = r.msg;
                Custom.myNotification('Error',sText);
            }        
        },
        complete:removeOverlay
    });
    
    
});
//end campaign assignment process


function getStatusText(code)
{
    sText = "";
    if(code !== undefined)
    {
        switch(code)
        {
            case 200:{ sText = 'Success';break;}
            case 404:{ sText = 'Error';break;}
            case 403:{ sText = 'Error';break;}
            case 500:{ sText = 'Error';break;}
            default:{sText = 'Error';}
            
        }
    }
    return sText;
}

function scrollToElement(e){$('html, body').animate({scrollTop:$(e).offset().top - 100},'slow');}

$(document).on('click','.btnEdit,.btnView',function(e){
    e.preventDefault();
    var $this = $(this);
    var id = $this.data('id');
    var type = $this.data('type');
    var editLink = $(this).data('url');
   
    $.ajax({
        url: editLink,
        type: 'POST',
        beforeSend: addOverlay,
        dataType: 'json',
        data: {id:id,type:type},
        success:function(r){
            if(r.status == 200){
                $(".pageform").html(r.html);
                $('.portlet-toggler').toggle();
                scrollToElement(".page-content");
            }
            else{
                sText = r.msg;
                Custom.myNotification('Error',sText);
            }        
        },
        complete:removeOverlay
    });
});

$(document).on('click', '.btnViewCampaign', function (e){   
    e.preventDefault();
    var $this = $(this);
    var id = $this.data('id');
    var type = $this.data('type');
    var url = $(this).data('url');

    $.ajax({
        url: url,
        type: 'POST',
        beforeSend: addOverlay,
        dataType: 'json',
        data: {type:type,id:id},
        success: function (r) {
            if (r.status == 200) {
                $(".pageform").html(r.html);
                $('.portlet-toggler').toggle();
                scrollToElement(".page-content");
                campaignUserData(id);
            }
            else {
                sText = r.msg;
                Custom.myNotification('Error', sText);
            }
        },
        complete: removeOverlay
    });
});

//Campaign archive/current filteration
$(document).on("change","#toggle-trigger",function(e) {
    var $this = $(this);
    var url = $(this).data('url');
    typeof $(this).data('getaction') != 'undefined' ? $(this).data('getaction') : '';
    var type = typeof $this.data('type') != 'undefined' ? $this.data('type') : 'normal';
    if(type == 'archive'){
      if($this.parent().hasClass("off")){
        bootbox.confirm("Are you sure you want switch ?", function(result) {
          if(result){
              window.location.replace(url);
          }else{
              $this.bootstrapToggle('on');
          }
        });
      }
    }else if(type== 'normal'){
      if(!$this.parent().hasClass("off")){
        bootbox.confirm("Are you sure you want switch ?", function(result) {
          if(result){
              window.location.replace(url);
          }else{
              $this.bootstrapToggle('off');
          }
        });
      }
    }else if(type == 'country'){
      oTable.destroy();
      if($this.parent().hasClass("off")){
        load_country('InActive');
      }else{
        load_country('Active');
      }
    }
}); 
//Campaign archive/current filteration ends

function campaignUserData($iCampaignId){
    var $iCampaignId = (typeof ($iCampaignId) != "undefined" && $iCampaignId != "") ? $iCampaignId : "";
    $.ajax({
        url: ADMIN_URL + "campaigns/fullView/",
        type: 'POST',
        beforeSend: addOverlay,
        dataType: 'json',
        data: {iCampaignId: $iCampaignId},
        success: function (data) {
            $("#userData").html(data.html);
        },
        complete: removeOverlay
    });
}

$(document).on('click','.btn-toggler',function(e){
    e.preventDefault();
    $('.portlet-toggler').toggle();
});

//start select all and delete records
$(document).on('click', '.all_select', function () {
  if ($(this).hasClass('allChecked')) {
      $('#listResults tbody input[class="small-chk"]').prop('checked', false);
  } else {
      $('#listResults tbody input[class="small-chk"]').prop('checked', true);
  }
  $(this).toggleClass('allChecked');
});

$(document).on('click', '#listResults tbody input[class=small-chk]', function () {
  var numberOfChecked = $('#listResults tbody input[class="small-chk"]:checked').length;
  var totalCheckboxes = $('#listResults tbody input[class="small-chk"]').length;

  if(numberOfChecked > 0){
      if(numberOfChecked == totalCheckboxes){
          $('.all_select').prop('indeterminate',false);
          $('.all_select').prop('checked', true);
      }else{
          $('.all_select').prop('indeterminate',true);
      }
  }
  else{
      $('.all_select').prop('indeterminate',false);
      $('.all_select').prop('checked', false);
  }
});

$(document).on("click",".delete_all_link", function (e) {
    $(".delete_all_link").attr("disabled", "disabled");
    e.preventDefault();
    var url = $(this).data('url');
    var searchIDs =[];
    $("#listResults tbody input[class='small-chk']:checked").each(function() {
        searchIDs.push($(this).val());
    });
    if(searchIDs.length > 0){
        var ids = searchIDs.join();
        bootbox.confirm("Are you sure you want to delete selected records?", function(result) {
            if(result)
            {
                $.ajax({
                    url: url,
                    type: 'POST',
                    beforeSend: addOverlay,
                    dataType: 'json',
                    data: {action:'delete_all',ids:ids},
                    success:function(r){
                        sType = getStatusText(r.status);
                        sText = r.message;
                        Custom.myNotification(sType,sText);
                        oTable.draw();
                        setTimeout(function(){ $('.all_select').prop('indeterminate',false);$('.all_select').prop('checked', false); }, 2000);
                        
                    },
                    complete:removeOverlay
                }); 
            }
            $(".delete_all_link").removeAttr("disabled");
        });
    }else{
        bootbox.alert('please select at-least one record',function(){ $('.all_select').prop('indeterminate',false);$(".delete_all_link").removeAttr("disabled"); });
    }

});
//end select all and delete records

function image_crop(width,ratio,minX,minY,maxX,maxY)
{
  var w1 = width;
  var h1 = (ratio)*w1;
  jQuery(function($){
    var jcrop_api,boundx,boundy;
    $('#crop_image').Jcrop({
      boxWidth:width,
      onChange: updateCoords,
      onSelect: updateCoords,
      setSelect: [ 0, 0, w1, h1 ],
      minSize:[minX,minY],
      maxSize:[maxX,maxY],
      aspectRatio: ratio      
    },function(){
      // Use the API to get the real image size
      var bounds = this.getBounds();
      boundx = bounds[0];
      boundy = bounds[1];
      // Store the API in the jcrop_api variable
      jcrop_api = this;
      // Move the preview into the jcrop container for css positioning      
    });
    function updateCoords(c)
    {
       $('#x').val(c.x);
        $('#y').val(c.y);
      $('#w').val(c.w);
      $('#h').val(c.h);
    };

  });
} 
function web_email_status(module,email_status,id)
{
  $.post(SITE_URL+'user/web_email_status',{module:module,email_status:email_status,id:id},function(r){
    sType = getStatusText(r.status);
    sText = r.message;
    Custom.myNotification(sType,sText);
  },'json');
}
function web_delete(module,id)
{
  $.post(SITE_URL+'user/web_delete',{module:module,id:id},function(r){
    
    if(r.status == 200)
    {
      $('#row_'+id).remove();
    }
    sType = getStatusText(r.status);
    sText = r.message;
    Custom.myNotification(sType,sText);
  },'json');
}
function web_finding(id,action,url)
{
    $.post(SITE_URL+url,{action:action,id:id},function(r){
        $('.portlet-toggler.pageform').html(r.html);
        $('.portlet-toggler').toggle();
        return false;
  },'json');    

}
function unbind_back_portlet(this1){
    console.log(this1);
    $("#"+this1).unbind('submit');
    back_portlet();
}
function back_portlet()
{
  $('.portlet-toggler').toggle();  
}

function add_btn_overlay()
{
  $('button:submit').attr("disabled", true);
}
function remove_btn_overlay()
{
  $('button:submit').attr("disabled", false);
}
function addOverlay(){$('<div id="overlayDocument"><img src="'+SITE_IMG+'loading.gif" /></div>').appendTo(document.body);}
function removeOverlay(){$('#overlayDocument').remove();}
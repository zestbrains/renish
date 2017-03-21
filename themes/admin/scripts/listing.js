function listing(url,refid,sorCol, sortOrd)
{   
        var colms = new Array();
        $(refid+' th').each(function () 
        {
            var bSort = (typeof $(this).data('sortable') != 'undefined' ? $(this).data('sortable') : "true");
            var bSearch = (typeof $(this).data('searchable') != 'undefined' ? $(this).data('searchable') : "true");
            colms.push({'sTitle' : $(this).html() ,bSortable:Boolean(bSort),bSearchable:Boolean(bSearch)});
        });

        oTable = $(refid).dataTable({
        bProcessing: true,
        bServerSide: true,
        responsive: true,
        order: [[ (typeof sortCol != "undefined" ? sortCol : 0), (typeof sortOrd != "undefined" ? sortOrd : "ASC") ]],
        sAjaxSource: url,
        aoColumns: colms,
        fnServerData: function (sSource, aoData, fnCallback){
            $.ajax({
               dataType: 'json',
               type: "POST",
               url: sSource,
               data: aoData,
               success: fnCallback
            });
         },       
        "fnServerParams": function(aoData){setTitle(aoData, this);},
        fnDrawCallback: function( oSettings ) {
            $('.make-switch').bootstrapSwitch();
            $('.make-switch').bootstrapSwitch('setOnClass', 'success');
            $('.make-switch').bootstrapSwitch('setOffClass', 'danger');
        }
        
    });
   
}
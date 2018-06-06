$.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
$(':button[name!="restore"][type!="submit"]').click(function () {
    var post_id=$(this).attr('post-id');
    var status=$(this).attr('post-action-status');
    var url="/admin/posts/"+post_id+'/status';
     status==3?url="/admin/posts/"+post_id+'/del':url;
    $.ajax({
       url: url,
       method:'post',
        data:{'status':status},
        dataType:'json',
       success: function (data) {
           if(data.error){
               alert(data.message);
               return;
           }
           alert(data.message);
           $('#'+post_id).remove();
       },
       error:function (data) {
           alert('系统异常');
       }
   });
});
$(":button[name='restore'][type!='submit']").click(function () {
    var post_id=$(this).attr('post-id');
    var url="/admin/posts/"+post_id+'/restore';
    $.ajax({
        url: url,
        method:'post',
        dataType:'json',
        success: function (data) {
            if(data.error){
                alert(data.message);
                return;
            }
            alert(data.message);
            $('#'+post_id).remove();
        },
        error:function (data) {
            alert('系统异常');
        }
    });
});
$(".resource-delete").click(function () {
    if(confirm('确定要删除么？')==false){
        return;
    }
    var url=$(this).attr('delete-url');
    var topic_id=$(this).attr('topic_id');
    $.ajax({
        url: url,
        method:'delete',
        dataType:'json',
        success: function (data) {
            if(data.error){
                alert(data.message);
                return;
            }
            alert(data.message);
            $('#'+topic_id).remove();
        },
        error:function (data) {
            alert('系统异常');
        }
    });
});
$('#reservation').daterangepicker({
    locale:{
        applyLabel: '确认',
        cancelLabel: '取消',
        fromLabel: '从',
        toLabel: '到',
        weekLabel: 'W',
        customRangeLabel: 'Custom Range',
        daysOfWeek:["日","一","二","三","四","五","六"],
        monthNames: ["一月","二月","三月","四月","五月","六月","七月","八月","九月","十月","十一月","十二月"],
    }
});
$.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
$(':button[name!="restore"]').click(function () {
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
$(":button[name='restore']").click(function () {
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
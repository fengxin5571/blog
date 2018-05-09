$.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
$(':button').click(function () {
    var post_id=$(this).attr('post-id');
    var status=$(this).attr('post-action-status');
    $.ajax({
       url: "/admin/posts/"+post_id+'/status',
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
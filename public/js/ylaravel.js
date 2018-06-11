$.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
$(".like-button").click(function (event) {
    target = $(event.target);
    var current_like = target.attr("like-value");
    var user_id = target.attr("like-user");
    //var _token = target.attr("_token");
    // 已经关注了
    if (current_like == 1) {
        // 取消关注
        $.ajax({
            url: "/users/user/" + user_id + "/unfan",
            method: "POST",
            //data: {"_token": _token},
            dataType: "json",
            success: function success(data) {
                if (data.error != 0) {
                    alert(data.msg);
                    return;
                }

                target.attr("like-value", 0);
                target.text("关注");
            }
        });
    } else {
        // 取消关注
        $.ajax({
            url: "/users/user/" + user_id + "/fan",
            method: "POST",
            //data: {"_token": _token},
            dataType: "json",
            success: function success(data) {
                if (data.error != 0) {
                    alert(data.msg);
                    return;
                }

                target.attr("like-value", 1);
                target.text("取消关注");
            }
        });
    }
});

var editor = new wangEditor('content');

editor.config.uploadImgUrl = '/posts/image/upload';

// 设置 headers（举例）
editor.config.uploadHeaders = {
    'X-CSRF-TOKEN' : $('meta[name="csrf-token"]').attr('content')
};

editor.create();

function seckill(good_id,active_id,st_data) {
    if(!good_id){
        return ;
    }
    $.ajax({
        url:'/seckill/buy',
        method:"post",
        data:{'goods':{0:{'id':good_id,'num':1}},'active_id':active_id,'st_data':st_data},
        dataType:'json',
        success:function (data) {
            if(data.error){
                alert(data.text);
                return;
            }
            alert(data.text);
        }
    });
}
function check(good_id,active_id) {
    $.ajax({
        url:'/seckill/check',
        method:"post",
        data:{aid:active_id,gid:good_id},
        dataType:'json',
        success:function (data) {
            if(data.error){
                alert(data.text);
                return;
            }
            var st_data=data.data;
            seckill(good_id,active_id,st_data);
        }
    });
}
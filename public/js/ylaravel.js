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

function get_question(good_id,active_id,st_data) {
    if(!good_id){
        return ;
    }
    $.ajax({
        url:'/seckill/question',
        method:'post',
        dataType:'json',
        success:function (data) {
            if(data.error){
                alert(data.text);
                return;
            }
            var html="";
            $.each(data.data.answers,function(i,v){
                html += '<label><input type="radio" value="' + v.id+ '" name="answer" /> ' + v.question_answer+ '</label><br/>';
            });
            var obj=JSON.stringify(st_data);
            $("#question_info").html('<div class="modal-body">' + data.data.title + '[' + data.data.ask + ']</div>'
                + '<div class="modal-body">' + html + '</div>'
                + '<div class="modal-footer"><input type="button" value="提交订单" onclick=\'seckill('+good_id+','+active_id+','+obj+')\'/></div>');
            $('#myModal').modal();
        }
    });

}
function seckill(good_id,active_id,st_data){
    var answer_id=$('input[name="answer"]:checked').val();
    if(!answer_id){
        return ;
    }
    $.ajax({
        url:'/seckill/buy',
        method:"post",
        data:{'goods':{0:{'id':good_id,'num':1}},'active_id':active_id,'st_data':st_data,'answer_id':answer_id},
        dataType:'json',
        success:function (data) {
            if(data.error){
                alert(data.text);
                return;
            }
            alert(data.text);
        }
    });
    $('#myModal').modal('hide');
}
//秒杀购买
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
            get_question(good_id,active_id,st_data);
        }
    });
}
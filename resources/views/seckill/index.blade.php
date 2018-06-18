@extends('layouts.default')
@section('title','秒杀')
@section('content')
<div class="col-sm-8 blog-main">
    <div class="container-fluid">
        @foreach($goods as $good)
        <div class="span4">
            <img src="{{$good->img}}" style="width:200px"/>
            <br>
            @if($good->active&&$good->active->status==1)
            活动：{{$good->active->title}}<br>
            优惠价：{{$good->price_discount}}<br>
            <a href="javascrip:;" onclick="check({{$good->id}},{{$good->active->id}})">立即抢购</a> <br/>
            @endif
            商品：{{$good->title}}<br/>
            原价：{{$good->price_normal}}<br/>
            库存:{{$good->num_total}}<br/>
            <a>加入购物车</a>
        </div>
        @endforeach
    </div>
</div>
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">

                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">秒杀问答</h4>
                </div>
                <div id="question_info">
                </div>

        </div>
    </div>
</div>
@stop
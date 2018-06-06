@extends('layouts.default')
@section('title','秒杀')
@section('content')

<div class="col-sm-8 blog-main">
    <div class="container-fluid">
        @foreach($goods as $good)
        <div class="span4">
            <img src="{{$good->img}}" style="width:200px"/>
            <br>
            商品：{{$good->title}}<br/>
            原价：{{$good->price_normal}}<br/>
            库存:{{$good->num_total}}
        </div>
        @endforeach
    </div>
</div>

@stop
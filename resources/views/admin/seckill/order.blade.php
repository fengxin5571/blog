@extends('admin.layouts.default')
@section('title','订单管理')
@section('content')
    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-10 col-xs-6">
                <div class="box">

                    <div class="box-header with-border">
                        <h3 class="box-title">订单管理</h3>
                    </div>

                    <!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-bordered">
                            <tbody><tr>
                                <th style="width: 10px">#</th>
                                <th>秒杀名称</th>
                                <th>用户名称</th>
                                <th>数量</th>
                                <th>订单价格</th>
                                <th>订单时间</th>
                                <th>商品详情</th>
                                <th>创建时间</th>
                                <th>ip</th>
                                <th>状态</th>
                                <th>操作</th>
                            </tr>
                            @foreach($orders as $order)
                            <tr>
                                <td>{{$order->id}}</td>
                                <td>{{$order->active->title}}</td>
                                <td>{{$order->user->name}}</td>
                                <td>{{$order->num_total}}</td>
                                <td>原价：{{$order->price_total}}<br/>
                                    优惠价：{{$order->price_discount}}
                                </td>
                                <td>
                                    确认：<br />
                                    支付：<br/>
                                    过期：<br/>
                                    取消：<br/>
                                </td>
                                <td>
                                    @foreach(json_decode($order->goods_info) as $good)

                                        <li>
                                            <label>{{$good->good->title}}</label><br>
                                            <img src="/{{$good->good->img}}" style="width:150px"><br>
                                            数量：{{$good->count}}
                                        </li>
                                    @endforeach
                                </td>
                                <td>{{$order->created_at}}</td>
                                <td>{{$order->ip}}</td>
                                <td>{{$order->getStatus()[$order->status]}}</td>
                            </tr>
                            @endforeach

                            </tbody></table>
                    </div>
                       {{$orders->render()}}
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
@stop
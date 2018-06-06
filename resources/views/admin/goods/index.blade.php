@extends('admin.layouts.default')
@section('title','商品列表')
@section('content')
    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-10 col-xs-6">
                <div class="box">

                    <div class="box-header with-border">
                        <h3 class="box-title">商品列表</h3>
                    </div>
                    <a type="button" class="btn " href="{{route('admin.goods.add')}}" >增加商品</a>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-bordered">
                            <tbody><tr>
                                <th style="width: 10px">#</th>
                                <th>商品名称</th>
                                <th>单价</th>
                                <th>库存</th>
                                <th>状态</th>
                            </tr>
                            @foreach($goods as $good)
                                <tr>
                                    <td>{{$good->id}}</td>
                                    <td>{{$good->title}}</td>
                                    <td>{{$good->price_normal}}</td>
                                    <td>{{$good->num_total}}</td>
                                    <td>
                                        @switch($good->status)
                                            @case(0)
                                                未上线
                                            @break
                                            @case(1)
                                                已上线
                                            @break
                                            @case(2)
                                                已下线
                                            @break
                                        @endswitch
                                    </td>
                                </tr>
                            @endforeach
                            </tbody></table>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
@stop
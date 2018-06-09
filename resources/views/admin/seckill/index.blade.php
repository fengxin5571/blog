@extends('admin.layouts.default')
@section('title','秒杀管理')
@section('content')
    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-10 col-xs-6">
                <div class="box">

                    <div class="box-header with-border">
                        <h3 class="box-title">秒杀信息</h3>
                    </div>
                    <a type="button" class="btn " href="{{route('admin.seckill.setting')}}" >秒杀设置</a>
                    <a type="button" class="btn " href="{{route('admin.seckill.add')}}" >新增秒杀</a>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-bordered">
                            <tbody><tr>
                                <th style="width: 10px">#</th>
                                <th>名称</th>
                                <th>值</th>
                            </tr>
                            <tr>
                                <td>1</td>
                                <td>秒杀总时间</td>
                                <td>
                                   {{implode("-",Cache::get('seckill'))}}
                                </td>
                            </tr>
                            <tr>
                                <td colspan="3">秒杀活动</td>
                            </tr>
                            @foreach($actives as $active)
                            <tr>
                                <td>{{$active->id}}</td>
                                <td>{{$active->title}}</td>
                                <td>状态：
                                @switch($active->status)
                                    @case (0)
                                    未上线
                                    @break
                                    @case (1)
                                    已上线
                                    @break
                                    @case (2)
                                    已下线
                                    @break
                                @endswitch
                                </td>
                                <td>开始时间：{{date('Y-m-d',$active->time_begin)}} - 结束时间：{{date('Y-m-d',$active->time_end)}}</td>
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
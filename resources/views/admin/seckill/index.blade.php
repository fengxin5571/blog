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

                            </tbody></table>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
@stop
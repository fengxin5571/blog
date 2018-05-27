@extends('admin.layouts.default')
@section('title','专题管理')
@section('content')

    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-10 col-xs-6">
                <div class="box">

                    <div class="box-header with-border">
                        <h3 class="box-title">专题列表</h3>
                    </div>
                    <a type="button" class="btn " href="{{route('admin.topics.add')}}" >增加专题</a>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-bordered">
                            <tbody><tr>
                                <th style="width: 10px">#</th>
                                <th>专题名称</th>
                                <th>操作</th>
                            </tr>
                            @foreach($topics as $topic)
                            <tr id="{{$topic->id}}">
                                <td>{{$topic->id}}</td>
                                <td>{{$topic->name}}</td>
                                <td>
                                    <a type="button" class="btn resource-delete" topic_id="{{$topic->id}}" delete-url="{{route('admin.topics.del',$topic)}}" href="javascript:;" >删除</a>
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
@extends('admin.layouts.default')
@section('title','已删除文章')
@section('content')
    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-10 col-xs-6">
                <div class="box">
                    <div class="box-header with-border">
                        <h3 class="box-title">文章列表</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-bordered">
                            <tbody><tr>
                                <th style="width: 10px">#</th>
                                <th>文章标题</th>
                                <th>操作</th>
                            </tr>
                            @foreach($posts as $post)
                                <tr id="{{$post->id}}">
                                    <td>{{$post->id}}.</td>
                                    <td>{{$post->title}}</td>
                                    <td>
                                        <button type="button" class="btn btn-block btn-default post-audit" post-id="{{$post->id}}" name="restore" >恢复</button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody></table>

                    </div>
                    <div class="box-body">

                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- /.content -->
    @stop
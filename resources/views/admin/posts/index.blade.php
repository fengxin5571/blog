@extends('admin.layouts.default')
@section('title','文章管理')
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
                                    @switch($flag)
                                    @case(0)
                                        <button type="button" class="btn btn-block btn-default post-audit" post-id="{{$post->id}}" post-action-status="1" >通过</button>
                                        <button type="button" class="btn btn-block btn-default post-audit" post-id="{{$post->id}}" post-action-status="2" >拒绝</button>
                                        @break
                                    @case(1)
                                        <button type="button" class="btn btn-block btn-default post-audit" post-id="{{$post->id}}" post-action-status="0" >未处理</button>
                                        <button type="button" class="btn btn-block btn-default post-audit" post-id="{{$post->id}}" post-action-status="2" >拒绝</button>
                                        @break
                                    @case(3)
                                        <button type="button" class="btn btn-block btn-default post-audit" post-id="{{$post->id}}" post-action-status="0" >未处理</button>
                                        <button type="button" class="btn btn-block btn-default post-audit" post-id="{{$post->id}}" post-action-status="1" >通过</button>
                                        @break
                                    @endswitch
                                </td>
                            </tr>
                            @endforeach
                            </tbody></table>

                    </div>
                    <div class="box-body">
                        <div class="col-sm-7">{{$posts->render()}}</div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- /.content -->
    @stop

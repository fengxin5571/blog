@extends('admin.layouts.default')
@section('title','秒杀问答')
@section('content')
    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-10 col-xs-6">
                <div class="box">

                    <div class="box-header with-border">
                        <h3 class="box-title">秒杀问答</h3>
                    </div>
                    <a type="button" class="btn " href="{{route('admin.seckill.question.add')}}" >新增描述</a>
                    <a type="button" class="btn " href="{{route('admin.seckill.add')}}" >新增问答</a>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <table class="table table-bordered">
                            <tbody><tr>
                                <th style="width: 10px">#</th>
                                <th>问题描述</th>

                            </tr>
                            @foreach($quesions as $question)
                            <tr>
                                <td>{{$question->id}}</td>
                                <td>{{$question->question}}</td>
                                <td></td>
                            </tr>
                            <tr>
                                <th colspan="2">问题答案项</th>
                            </tr>
                                @forelse($question->question_answers as $answer)
                                    <tr>
                                        <td>{{$answer->id}}</td>
                                        <td>{{$answer->question_title}}</td>
                                        <td>{{$answer->question_answer}}</td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="3">暂无答案项</td>
                                    </tr>
                                @endforelse


                           @endforeach

                            </tbody></table>
                    </div>

                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
@stop
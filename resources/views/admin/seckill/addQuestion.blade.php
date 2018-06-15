@extends('admin.layouts.default')
@section('title','新增问答描述')
@section('content')
    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-10 col-xs-6">
                <div class="box">

                    <!-- /.box-header -->
                    <div class="box box-primary">
                        <div class="box-header with-border">
                            <h3 class="box-title">增加问题描述</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form role="form" action="{{route('admin.seckill.question.add')}}" method="POST">
                            {{csrf_field()}}
                            <div class="box-body">
                                <div class="form-group @if($errors->first('question'))has-error @endif">
                                    <label for="exampleInputEmail1">问题</label>
                                    <input type="text" class="form-control" name="question">
                                    @if($errors->first('question'))
                                        <label for="inputError">
                                            <i class="fa fa-times-circle-o"></i>
                                            {{$errors->first('question')}}
                                        </label>
                                    @endif
                                </div>


                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer">
                                <button type="submit" class="btn btn-primary">提交</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- /.content -->
@stop
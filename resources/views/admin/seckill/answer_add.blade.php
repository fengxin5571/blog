@extends('admin.layouts.default')
@section('title','新增问题答案')
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
                            <h3 class="box-title">增加问题答案</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form role="form" action="{{route('admin.seckill.answer.add')}}" method="POST">
                            {{csrf_field()}}
                            <div class="box-body">
                                <div class="form-group @if($errors->first('question'))has-error @endif">
                                    <label for="exampleInputEmail1">问题</label>
                                    <select name="question">
                                        <option value="">-请选择-</option>
                                        @foreach($questions as $question)

                                            <option value="{{$question->id}}">{{$question->question}}</option>
                                        @endforeach
                                    </select>
                                    @if($errors->first('question'))
                                        <label for="inputError">
                                            <i class="fa fa-times-circle-o"></i>
                                            {{$errors->first('question')}}
                                        </label>
                                    @endif
                                </div>

                                @for($i=1;$i<=4;$i++)
                                <div class="form-group @if($errors->first('answers.'.$i.'.question_title'))has-error @endif">
                                    <label for="exampleInputEmail1">问题{{$i}}：</label>
                                    <input type="text" class="form-control" name="answers[{{$i}}][question_title]" value="{{old('answers['.$i.'][question_title]')}}" />
                                    @if($errors->first('answers.'.$i.'.question_title'))
                                        <label for="inputError">
                                            <i class="fa fa-times-circle-o"></i>
                                            {{$errors->first('answers.'.$i.'.question_title')}}
                                        </label>
                                    @endif
                                </div>
                                <div class="form-group @if($errors->first('answers.'.$i.'.question_answer'))has-error @endif">
                                    <label for="exampleInputEmail1">答案{{$i}}：</label>
                                    <input type="text" class="form-control" name="answers[{{$i}}][question_answer]" value="{{old('answers['.$i.'][question_answer]')}}"/>
                                    @if($errors->first('answers.'.$i.'.question_answer'))
                                        <label for="inputError">
                                            <i class="fa fa-times-circle-o"></i>
                                            {{$errors->first('answers.'.$i.'.question_answer')}}
                                        </label>
                                    @endif
                                </div>
                                @endfor
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
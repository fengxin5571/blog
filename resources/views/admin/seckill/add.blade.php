@extends('admin.layouts.default')
@section('title','新增秒杀')
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
                            <h3 class="box-title">增加秒杀</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form role="form" action="{{route('admin.seckill.add')}}" method="POST">
                            {{csrf_field()}}
                            <div class="box-body">
                                <div class="form-group @if($errors->first('title'))has-error @endif">
                                    <label for="exampleInputEmail1">活动名称</label>
                                    <input type="text" class="form-control" name="title">
                                    @if($errors->first('title'))
                                        <label for="inputError">
                                            <i class="fa fa-times-circle-o"></i>
                                            {{$errors->first('title')}}
                                        </label>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label>秒杀时间:</label>

                                    <div class="input-group @if($errors->first('date'))has-error @endif">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input type="text" class="form-control pull-right" id="reservation" name="date">
                                    </div>
                                    @if($errors->first('date'))
                                        <label for="inputError">
                                            <i class="fa fa-times-circle-o"></i>
                                            {{$errors->first('date')}}
                                        </label>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">优惠价格</label>
                                    <input type="text" class="form-control" name="price_discount">
                                </div>
                                <div class="form-group @if($errors->first('status'))has-error @endif">
                                    <label for="exampleInputEmail1">状态</label>
                                    <select class="form-control" name="status">
                                        <option value="0">未上线</option>
                                        <option value="1">已上线</option>
                                        <option value="2">已下线</option>
                                    </select>

                                    @if($errors->first('status'))
                                        <label for="inputError">
                                            <i class="fa fa-times-circle-o"></i>
                                            {{$errors->first('status')}}
                                        </label>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">所属商品</label>
                                    <div class="timeline-body">
                                      @foreach($goods as $good)
                                        <img src="/{{$good->img}}" alt="{{$good->title}}" class="margin" style="width:150px"><br>
                                          <input type="checkbox"  name='goods[]' value="{{$good->id}}"/> {{$good->title}}
                                      @endforeach
                                    </div>
                                    @if($errors->first('goods'))
                                        <label for="inputError">
                                            <i class="fa fa-times-circle-o"></i>
                                            {{$errors->first('goods')}}
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
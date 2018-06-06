@extends('admin.layouts.default')
@section('title','增加商品')
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
                            <h3 class="box-title">增加商品</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form role="form" action="{{route('admin.goods.add')}}" method="POST" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="box-body">
                                <div class="form-group @if($errors->first('title'))has-error @endif">
                                    <label for="exampleInputEmail1">商品名称</label>
                                    <input type="text" class="form-control" name="title">
                                    @if($errors->first('title'))
                                    <label for="inputError">
                                        <i class="fa fa-times-circle-o"></i>
                                        {{$errors->first('title')}}
                                    </label>
                                    @endif

                                </div>
                                <div class="form-group @if($errors->first('num_total'))has-error @endif">
                                    <label for="exampleInputEmail1">库存</label>
                                    <input type="text" class="form-control" name="num_total">
                                    @if($errors->first('num_total'))
                                        <label for="inputError">
                                            <i class="fa fa-times-circle-o"></i>
                                            {{$errors->first('num_total')}}
                                        </label>
                                    @endif
                                </div>
                                <div class="form-group @if($errors->first('img'))has-error @endif">
                                    <label for="exampleInputEmail1">商品图</label>
                                    <input type="file" class="form-control" name="img">
                                    @if($errors->first('img'))
                                        <label for="inputError">
                                            <i class="fa fa-times-circle-o"></i>
                                            {{$errors->first('img')}}
                                        </label>
                                    @endif
                                </div>
                                <div class="form-group @if($errors->first('price_normal'))has-error @endif">
                                    <label for="exampleInputEmail1">单价</label>
                                    <input type="text" class="form-control" name="price_normal">
                                    @if($errors->first('price_normal'))
                                        <label for="inputError">
                                            <i class="fa fa-times-circle-o"></i>
                                            {{$errors->first('price_normal')}}
                                        </label>
                                    @endif
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">商品状态</label>
                                    <select class="form-control" name="status">
                                        <option value="0">未上线</option>
                                        <option value="1">已上线</option>
                                        <option value="2">已下线</option>
                                    </select>

                                </div>
                                <div class="form-group">
                                    <label for="exampleInputEmail1">商品描述</label>
                                    <textarea id="content"  style="height:400px;max-height:500px;" name="description" class="form-control" placeholder="商品描述">{{old('description')}}</textarea>
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

@extends('admin.layouts.default')
@section('title','新增权限')
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
                            <h3 class="box-title">增加权限</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form role="form" action="{{route('admin.permission.add')}}" method="POST">
                             {{csrf_field()}}
                            <div class="box-body">
                                <div class="form-group">
                                    <label >权限名</label>
                                    <input type="text" class="form-control" name="name">
                                </div>
                                @if($errors->first('name'))
                                    <div class="alert alert-danger" role="alert">
                                        {{$errors->first('name')}}
                                    </div>
                                @endif
                            </div>
                            <div class="box-body">
                                <div class="form-group">
                                    <label>描述</label>
                                    <input type="text" class="form-control" name="description">
                                </div>
                                @if($errors->first('description'))
                                    <div class="alert alert-danger" role="alert">
                                        {{$errors->first('description')}}
                                    </div>
                                @endif
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
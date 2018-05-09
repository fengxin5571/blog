@extends('admin.layouts.default')
@section('title','增加用户')
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
                            <h3 class="box-title">增加用户</h3>
                        </div>
                        <!-- /.box-header -->
                        <!-- form start -->
                        <form role="form" action="{{route('admin.users.add')}}" method="POST">
                            {{csrf_field()}}
                            <div class="box-body">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">用户名</label>
                                    <input type="text" class="form-control" name="name">
                                    @if($errors->first('name'))
                                    <div class="alert alert-danger" role="alert">
                                        {{$errors->first('name')}}
                                    </div>
                                        @endif
                                </div>
                                <div class="form-group">
                                    <label for="exampleInputPassword1">密码</label>
                                    <input type="password" class="form-control" placeholder="Password" name="password">
                                    @if($errors->first('password'))
                                        <div class="alert alert-danger" role="alert">
                                            {{$errors->first('password')}}
                                        </div>
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
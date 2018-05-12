@extends('admin.layouts.default')
@section('title','用户角色管理')
@section('content')
    <!-- Main content -->
    <section class="content">
        <!-- Small boxes (Stat box) -->
        <div class="row">
            <div class="col-lg-10 col-xs-6">
                <div class="box">

                    <div class="box-header with-border">
                        <h3 class="box-title">角色列表</h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                        <form action="{{route('admin.users.role',$admin)}}" method="POST">
                            {{csrf_field()}}
                            <div class="form-group">
                                @foreach($roles as $role)
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="roles[]"
                                               @if($admin->isInroles($role))
                                                       checked
                                                       @endif
                                               value="{{$role->id}}">
                                        {{$role->name}}
                                    </label>
                                </div>
                               @endforeach
                            </div>
                               @if($errors->first('roles'))
                                <div class="alert alert-danger" role="alert">
                                    {{$errors->first('roles')}}
                                </div>
                               @endif
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
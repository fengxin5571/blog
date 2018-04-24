@extends('layouts.default')
@section("title",'添加文章')
@section('content')

        <div class="row">

            <div class="col-sm-8 blog-main">
                <form action="{{route('posts.add')}}" method="POST">
                   {{csrf_field()}}
                    <div class="form-group">
                        <label>标题</label>
                        <input name="title" type="text" class="form-control" placeholder="这里是标题" value="{{old('title')}}">
                        <p class='text-danger '>{{$errors->first('title')}}</p>
                    </div>
                    <div class="form-group">
                        <label>内容</label>
                        <textarea id="content"  style="height:400px;max-height:500px;" name="content" class="form-control" placeholder="这里是内容">{{old('content')}}</textarea>
                    </div>
                    <button type="submit" class="btn btn-default">提交</button>
                </form>
                <br>

            </div><!-- /.blog-main -->



            @include('layouts.sidebar')
        </div>    </div><!-- /.row -->
@stop
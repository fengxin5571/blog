@extends("layouts.default")
@section("title",$post->title)
@section("content")
    <div class="row">
    <div class="col-sm-8 blog-main">
        <div class="blog-post">
            <div style="display:inline-flex">
                <h2 class="blog-post-title">{{$post->title}}</h2>

                <a style="margin: auto" href="/posts/{{$post->id}}/edit">
                    <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                </a>


                <a style="margin: auto" href="/posts/{{$post->id}}/delete">
                    <span class="glyphicon glyphicon-remove" aria-hidden="true"></span>
                </a>

            </div>

            <p class="blog-post-meta"> by <a href="#"></a></p>

            <p>{!! $post->content !!}</p>
            <div>

                <a href="/posts/{{$post->id}}/unzan" type="button" class="btn btn-default btn-lg">取消赞</a>

                <a href="/posts/{{$post->id}}/zan" type="button" class="btn btn-primary btn-lg">赞</a>


            </div>
        </div>

        <div class="panel panel-default">
            <!-- Default panel contents -->
            <div class="panel-heading">评论</div>

            <!-- List group -->
            <ul class="list-group">

                <li class="list-group-item">
                    <h5> by </h5>
                    <div>

                    </div>
                </li>

            </ul>
        </div>

        <div class="panel panel-default">
            <!-- Default panel contents -->
            <div class="panel-heading">发表评论</div>

            <!-- List group -->
            <ul class="list-group">
                <form action="/posts/comment" method="post">
                    {{csrf_field()}}
                    <input type="hidden" name="post_id" value="{{$post->id}}"/>
                    <li class="list-group-item">
                        <textarea name="content" class="form-control" rows="10"></textarea>
                        <button class="btn btn-default" type="submit">提交</button>
                    </li>
                </form>

            </ul>
        </div>

    </div><!-- /.blog-main -->
    @include('layouts.sidebar')
    </div>
@stop
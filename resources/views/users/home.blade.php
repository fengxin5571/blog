
@extends('layouts.default')
@section('title',$user->name.'- 用户中心')
@section('content')
    <div class="col-sm-8">
        <blockquote>
            <p><img src="/{{$user->avatar}}" alt="" class="img-rounded" style="border-radius:500px; height: 40px"> {{$user->name}}
            </p>


            <footer>关注：{{$user->stars_count}}｜粉丝：{{$user->fans_count}}｜文章：{{$user->posts_count}}</footer>
            <div>
                @if(Auth::user()->id!=$user->id)
                @if(Auth::user()->isFan($user->id))
                <button class="btn btn-default like-button" like-value="1" like-user="{{$user->id}}" _token="{{csrf_token()}}" type="button">取消关注</button>
                @else
                <button class="btn btn-default like-button" like-value="0" like-user="{{$user->id}}" _token="{{csrf_token()}}" type="button">关注</button>
                @endif
                @endif
            </div>
        </blockquote>
    </div>
    <div class="col-sm-8 blog-main">
        <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
                <li class="active"><a href="#tab_1" data-toggle="tab" aria-expanded="true">文章</a></li>
                <li class=""><a href="#tab_2" data-toggle="tab" aria-expanded="false">关注</a></li>
                <li class=""><a href="#tab_3" data-toggle="tab" aria-expanded="false">粉丝</a></li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="tab_1">
                    @foreach($posts as $post)
                    <div class="blog-post" style="margin-top: 30px">
                        <p class=""><a href="/user/5">{{$post->user->name}}</a> {{$post->created_at->diffForHumans()}}</p>
                        <p class=""><a href="{{route('posts.info',$post)}}" >{{$post->title}}</a></p>


                        <p><p>{!! str_limit($post->content,100)!!}</p>
                    </div>
                    @endforeach
                    {{$posts->render()}}
                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane" id="tab_2">
                    @foreach($stars as $star)
                    <div class="blog-post" style="margin-top: 30px">
                        <p class="">{{$star->name}}</p>
                        <p class="">关注：{{$star->stars->count()}} | 粉丝：{{$star->fans->count()}}｜ 文章：{{$star->posts->count()}}</p>

                        <div>
                            <button class="btn btn-default like-button" like-value="1" like-user="{{$star->id}}" _token="MESUY3topeHgvFqsy9EcM916UWQq6khiGHM91wHy" type="button">取消关注</button>
                        </div>

                    </div>
                   @endforeach
                </div>
                <!-- /.tab-pane -->
                <div class="tab-pane" id="tab_3">
                    @foreach($fans as $fan)
                        <div class="blog-post" style="margin-top: 30px">
                            <p class="">{{$fan->name}}</p>
                            <p class="">关注：{{$fan->stars->count()}} | 粉丝：{{$fan->fans->count()}}｜ 文章：{{$fan->posts->count()}}</p>

                            <div>
                                @if(Auth::user()->isFan($fan->id))
                                    <button class="btn btn-default like-button" like-value="1" like-user="{{$fan->id}}" _token="MESUY3topeHgvFqsy9EcM916UWQq6khiGHM91wHy" type="button">取消关注</button>
                                @else
                                <button class="btn btn-default like-button" like-value="0" like-user="{{$fan->id}}" _token="MESUY3topeHgvFqsy9EcM916UWQq6khiGHM91wHy" type="button">关注</button>
                               @endif
                            </div>

                        </div>
                    @endforeach
                </div>
                <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
        </div>


    </div><!-- /.blog-main -->
@stop

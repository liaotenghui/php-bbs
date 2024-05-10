@extends('layouts.app')

@section('title', $topic->title)
@section('description', $topic->excerpt)

@section('content')

  <div class="row">

    <div class="col-lg-3 col-md-3 hidden-sm hidden-xs author-info">
      <div class="card ">
        <div class="card-body">
          <div class="text-center">
            作者：{{$topic->user->name}}
          </div>
          <hr>
          <div class="media">
            <div align="center">
              {{-- 点击图片进入用户信息页面 --}}
              <a href="{{route('users.show',Auth::user()->id)}}">
                <img class="thumbnail img-fluid" src="{{$topic->user->avatar}}" width="300px" height="300px">
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 topic-content">
      <div class="card ">
        <div class="card-body">
          <h1 class="text-center mt-3 mb-3">
            {{$topic->title}}
            {{-- 帖子题目 --}}
          </h1>

          <div class="article-meta text-center text-secondary">
            {{ $topic->created_at->diffForHumans() }}
            ⋅
            <i class="far fa-comment"></i>
            {{$topic->reply_count}}
            {{-- 回复数量 --}}
          </div>

          <div class="topic-body mt-4 mb-4">
            {!!$topic->body!!}
            {{-- 帖子内容 --}}
          </div>
          <div class="operate">
            <hr>
            <a href="{{route("topics.edit",$topic->id)}}" class="btn btn-outline-secondary btn-sm" role="button">
              <i class="far fa-edit"></i> 编辑
            </a>
            {{-- <a href="{{route("topics.destroy",$topic->id)}}" class="btn btn-outline-secondary btn-sm" role="button">
              <i class="far fa-trash-alt"></i> 删除
            </a> --}}
            <a href="{{ route('topics.destroy', $topic->id) }}" class="btn btn-outline-secondary btn-sm" role="button" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $topic->id }}').submit();">
              删除
          </a>
       
          <form id="delete-form-{{ $topic->id }}" action="{{ route('topics.destroy', $topic->id) }}" method="POST" style="display: none;">
              @csrf
              @method('DELETE')
          </form>
          </div>

        </div>
      </div>
    </div>
  </div>
@stop

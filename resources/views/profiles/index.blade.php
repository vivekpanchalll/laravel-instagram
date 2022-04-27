@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="row">
            <div class="col-3 p-5">
                <img src="{{$user->profile->profileImage()}}" height="150" weight="150" class="rounded-circle" alt="">
            </div>
            <div class="col-9 pt-5">
                <div class="d-flex justify-content-between align-items-baseline" style="padding-left:50px">
                    <div class="d-flex align-items-center pb-3">
                        <div class="h4">{{$user->username}}</div>
                        <follow-button user-id="{{$user->id}}" follow="{{ $follow }}"></follow-button>
                    </div>

                    @can('update',$user->profile)
                        <a href="/p/create">Add New Post</a>
                    @endcan
                </div>  
                <div style="padding-left:50px">
                    @can('update',$user->profile)
                        <a href="/profile/{{$user->id}}/edit">Edit Post</a>
                    @endcan
                </div>
                <div class="d-flex" style="padding-left:50px">
                    <div style="margin-right:15px"><strong>{{ $postCount }}</strong> post</div>
                    <div style="margin-right:15px"><strong>{{ $followerCount }}</strong>followers</div>
                    <div style="margin-right:7px"><strong>{{ $followingCount }}</strong>following</div>
                </div> 
                <div class="fw-bold pl-50">{{$user->profile->title}}</div>
                <div class="pl-50">{{$user->profile->description}}</div> 
                <div class="pl-50"><a href="{{$user->profile->url}}">{{$user->profile->url ?? 'N/A'}}</a></div>
            </div>
        </div>
        <div class="row pt-5">
            @foreach($user->posts as $post)
                <div class="col-4">
                    <a href="/p/{{$post->id}}">
                        <img  src="/storage/{{$post->image}}" height="200" weight="200" alt="">
                    </a>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection


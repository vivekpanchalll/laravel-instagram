@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-8">
            <img src="/storage/{{$post->image}}" alt="" class="w-100">
        </div>
        <div class="col-4">
            <div>
                <div class="d-flex align-items-center">
                    <div class="pr-20">
                        <img src="{{$post->user->profile->profileImage()}}" class="rounded-circle w-100" style="max-width:75px" alt="">
                    </div>
                    <div>
                        <div class="fw-bold">
                            <a href="/profile/{{$post->user->id}}">
                                <span class="text-dark">{{$post->user->username}}</span>
                            </a> |
                            <a href="#" class="pl-20">Follow</a>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
            <p> <span class="fw-bold">
                <a href="/profile/{{$post->user->id}}">
                    <span class="text-dark pr-20">{{$post->user->username}}</span>
                </a>
                </span>{{$post->caption}}
            </p>
        </div>
    </div>  
</div>
@endsection


@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <form action="/profile/{{$user->id}}" enctype="multipart/form-data" method="post">
            @csrf
            @method('PATCH')
            <div class="row justify-content-center">
                <div class="row">
                    <div class="col-8 offset-4">
                        <div class="">
                            <h1>Edit Post</h1>
                        </div>
                        <div class="col-md-6">
                            <label for="title" class="col-md-4 col-form-label"> title</label>
                            <input  id="title"
                                    type="title"
                                    class="form-control @error('title') is-invalid @enderror"
                                    name="title" 
                                    value="{{ old('title') ?? $user->profile->title }}" autocomplete="title">

                            @error('title')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="description" class="col-md-4 col-form-label"> Description</label>
                            <input  id="description"
                                    type="description"
                                    class="form-control @error('description') is-invalid @enderror"
                                    name="description" 
                                    value="{{ old('description') ?? $user->profile->description }}" autocomplete="description">

                            @error('description')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="urls" class="col-md-4 col-form-label"> urls</label>
                            <input  id="urls"
                                    type="urls"
                                    class="form-control @error('urls') is-invalid @enderror"
                                    name="url" 
                                    value="{{ old('urls') ?? $user->profile->url }}">

                            @error('urls')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="row">
                            <label for="caption" class="col-md-4 col-form-label">Profile Image</label>
                            <input type="file" class="form-control-file" id="image" name="image">
                        
                            @error('image')
                                    <strong>{{ $message }}</strong>
                            @enderror
                        </div>
                        <div class="pt-4">
                            <button class="btn btn-primary">Save Profile</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection


<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Models\User;
use Intervention\Image\Facades\Image;
class ProfileController extends Controller
{
    public function index(User $user){
        $follow = (auth()->user()) ? auth()->user()->following->contains($user->id) : false;
        
        $postCount = Cache::remember(
            'count.posts.' . $user->id,
            now()->addSecond(30),
            function() use ($user){
                return $user->posts()->count(); 
            }
        );
        
        $followerCount = $user->profile->follower->count();
        $followingCount = $user->following->count();
        return view('profiles.index',compact('user','follow','postCount','followerCount','followingCount'));
    }

    public function edit(User $user){
        $this->authorize('update',$user->profile);
        return view('profiles.edit',compact('user'));
    }

    public function update(User $user){
        $this->authorize('update',$user->profile);
        $data = request()->validate([
            'title' => 'required', 
            'description' => 'required', 
            'url' => 'url',
            'image' => '',
        ]);

        if(request('image')){
            $imagePath = request('image')->store('profile','public');
            $image = Image::make(public_path("storage/{$imagePath}"))->fit(1000,1000);
            $image->save();

            $imageArray =   ['image'=>$imagePath ];
        }

        auth()->user()->profile->update(array_merge(
            $data,
            $imageArray ?? []
        ));
        return redirect('profile/'.$user->id);
    }
}

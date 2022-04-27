<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use App\Models\Post;

class PostsController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $user = auth()->user()->following()->pluck('profiles.user_id');
        
        $posts = Post::whereIn('user_id',$user)->with('user')->latest()->paginate(5);
        
        return view('posts.index',compact('posts'));
    }

    public function create(){
        return view('posts.create');
    }

    public function store(Request $request){
       
        $data = request()->validate([
            'caption' => 'required',
            'image' => ['required','image']
        ]);
        $imagePath = request('image')->store('uploads','public');

        $image = Image::make(public_path("storage/{$imagePath}"))->fit(1200,1200);
        $image->save();
        //save authentic user usin relationship
        auth()->user()->posts()->create([
            'caption' => $data['caption'],
            'image' => $imagePath
        ]);
        return redirect('/profile/' .auth()->user()->id);
    }

    public function show(Post $post){
        return view('posts.show',compact('post'));
    }
}

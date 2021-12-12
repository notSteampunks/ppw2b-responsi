<?php

namespace App\Http\Controllers;

use App\Homestay;
use Illuminate\Http\Request;
use App\Post;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }
    public function komentar(Request $request, $id)
    {
    $homestay = Homestay::find($id);

    $post               = new Post;
    $post->user_id      = Auth::user()->id;
    $post->id_homestay  = $homestay->id;
    $post->comment      = $request->comment;
    $post->save();
    return back();
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Tag;
use Carbon\Carbon;
use App\Services\PostService;
use App\Services\RssFeed;
use App\Services\SiteMap;

class BlogController extends Controller
{
    //
    public function index(Request $request)
    {
        /* $posts = Post::where('published_at','<=',Carbon::now())
                ->OrderBy('published_at','desc')
                ->paginate(Config('blog.posts_per_page'));
        return view('blog.index',compact('posts'));  */
        $tag = $request->get('tag');
        $postService = new PostService($tag);
        $data = $postService->lists();
        $layout = $tag ? Tag::layout($tag) : 'blog.layouts.index';
        return view($layout ,$data);
    }
    //
    public function showPost($slug,Request $request)
    {
        /* $post = Post::where('slug',$slug)->firstOrFail();
        return view('blog.post',['post'=>$post]); */
        $post = Post::with('tags')->where('slug',$slug)->firstOrFail();
        $tag = $request->get('tag');
        if($tag) {
            $tag = Tag::where(['tag'=>$tag])->firstOrFail();
        }
        return view($post->layout,compact('post','tag'));
    }
    /**
     * 
     */
    public function rss(RssFeed $feed)
    {
        $rss = $feed->getRss();
        return response($rss)->header('Content-type','application/rss+xml');
    }
    /**
     * 
     */
    public function siteMap(SiteMap $siteMap)
    {
        $map = $siteMap->getSiteMap();
        return response($map)->header('Content-type','text/xml');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Tag;
use App\Http\Requests\TagCreateRequest;
use App\Http\Requests\TagUpdateRequest;
use Illuminate\Support\Arr;

class TagController extends Controller
{
    protected $fields = [
        'tag' => '',
        'title' => '',
        'subtitle' => '',
        'meta_description' => '',
        'page_image' => '',
        'layout' => 'blog.layouts.index',
        'reverse_direction' => 0
    ];
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $tagModel = Tag::all();
        // return view('admin.tag.index')->withTags($tagModel);
        return view('admin.tag.index',['tags'=>$tagModel]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $data = [];
        foreach ($this->fields as $field => $default) {
            $data[$field] = old($field,$default);
        }
        return view('admin.tag.create',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TagCreateRequest $request)
    {
        $tagModel = new Tag;
        foreach (array_keys($this->fields) as $field) 
        {
            $tagModel->$field = $request->get($field);    
        }
        $tagModel->save();
        return redirect('/admin/tag')->with('success',"标签[{$tagModel->tag}]创建成功");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tag = Tag::findOrFail($id);
        $data = ['id'=>$id];
        foreach (array_keys($this->fields) as $field) 
        {
            $data[$field] = old($field , $tag->$field);
        }
        return view('admin.tag.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TagUpdateRequest $request, $id)
    {
        $tag = Tag::findOrFail($id);
        foreach (array_keys(Arr::except($this->fields,['tag'])) as $field) 
        {
            $tag->$field = $request->get($field);
        }
        $tag->save();
        return redirect("/admin/tag/$id/edit")->with("success","修改成功");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tag = Tag::findOrFail($id);
        $tag->delete();

        return redirect("/admin/tag")->with('success',"标签[{$tag->tag}]已被删除");
    }
}

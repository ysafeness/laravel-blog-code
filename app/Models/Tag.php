<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tag extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'tag','title','subtitle','page_image','meta_description','reverse_direction'
    ];


    public function posts()
    {
        return $this->belongsToMany(Post::class,'post_tag_pivot');
    }

    /**
     * 创建标签
     */
    public static function addNeededTags(array $tags)
    {
        if(count($tags) === 0) return "";

        $found = static::whereIn('tag',$tags)->get()->pluck('tag')->all();
        
        foreach (array_diff($tags,$found) as $tag) 
        {
            static::create([
                'tag' => $tag,
                'title' => $tag,
                'subtitle' => 'Subtitle for '.$tag,
                'page_image' => '',
                'meta_description' => '',
                'reverse_description' => false
            ]);
        }
    }
    /**
     * 
     */
    public static function layout($tag,$default = 'blog.index')
    {
        $layout = static::where('tag',$tag)->get()->pluck('layout')->first();
        return $layout ?: $default;
    }
}

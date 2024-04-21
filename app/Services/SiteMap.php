<?php
namespace App\Services;

use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Arr;

/**
 * 站点地图服务
 */
class SiteMap
{
    public function getSiteMap()
    {
        if(Cache::has('site-map'))
        {
            return Cache::get('site-map');
        }
        $siteMap = $this->buildSiteMap();
        Cache::add('site-map',$siteMap,120);
        return $siteMap;
    }

    protected function buildSiteMap()
    {
        $postsInfo = $this->getPostsInfo();
        $dates = array_values($postsInfo);
        sort($dates);
        $lastmod = Arr::last($dates);
        $url = trim(url('/'),'/')."/";

        $xml = [];
        $xml[] = '<?xml version="1.0" encoding="UTF-8"?'.'>';
        $xml[] = '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">';
        $xml[] = ' <url>';
        $xml[] = " <loc>$url</loc>";
        $xml[] = " <lastmod>$lastmod</lastmod>";
        $xml[] = " <changefreq>daily</changefreq>";
        $xml[] = " <priority>$url</priority>";
        $xml[] = " </url>";

        foreach ($postsInfo as $slug => $lastmod) 
        {
            $xml[] = " <url>";
            $xml[] = " <loc>{$url}blog/$slug</loc>";
            $xml[] = " <lastmod>$lastmod</lastmod>";
            $xml[] = " </url>";
        }
        $xml[] = "</urlset>";
        return join("\n",$xml);
    }


    protected function getPostsInfo()
    {
        return Post::where('published_at','<=',Carbon::now())
                ->where('is_draft',0)
                ->orderBy('published_at','desc')
                ->pluck('updated_at','slug')
                ->all();
    }
}